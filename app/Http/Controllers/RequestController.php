<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Models\RequestItem;
use App\Services\RequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\support\Facades\Storage;

class RequestController extends Controller
{
    public function __construct(protected RequestService $requestService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = \App\Models\Request::query()->get()
            ->sortByDesc('created_at');


        // Calculate summary counts
        $summary = [
            'Pending' => $requests->where('status', 'Pending')->count(),
            'In Progress' => $requests->where('status', 'In Progress')->count(),
            'Completed' => $requests->where('status', 'Completed')->count(),
            'Cancelled' => $requests->where('status', 'Cancelled')->count(),
        ];
        // $breadcrumbs[] = ['name' => 'Custom Page', 'url' => url()->current()];

        return view('requests.index', compact('requests', 'summary'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = \App\Models\Service::query()->select('id', 'name')->get();
        $serviceProviders = \App\Models\ServiceProvider::query()->select('id', 'name')->get();
        $embassies = \App\Models\Embassy::query()->select('id', 'name')->get();
        $countries = \App\Models\Country::query()->select('id', 'name')->whereNotNull('embassy_id')->get();
        $members = \App\Models\Member::query()->select('id', 'name')->get();
        return view('requests.create', compact('services', 'serviceProviders', 'embassies', 'countries', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestRequest $request)
    {
        try {
            $data = $request->validated();

            $country = $this->requestService->getCountry($data['country_id']);

            $accountId = \App\Models\Account::query()->where('embassy_id', $country->embassy_id)->first()->id;
            if (!$accountId) {
                if ($request->ajax() || $request->wantsJson()) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Account not found for the specified embassy.'
                    ]);
                }
                return redirect()->back()->withInput()->withErrors(['embassy_id' => 'Account not found for the specified embassy.']);
            }
            $this->requestService->setAccountId($country->id);
            $requestModel = $this->requestService->createRequest($data);
            $invoice = $this->requestService->createInvoice($requestModel);
            $this->requestService->addRequestedItems($requestModel, $data['request_items'], $data['price']);
            $this->requestService->addInvoiceItems($invoice, $requestModel->requestItems);
            $this->requestService->notifyMember($invoice, $requestModel);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Request created successfully!',
                    'redirect' => route('requests.index')
                ]);
            }

            return redirect()->route('requests.index')->with('success', 'Request created successfully!');
        } catch (\Exception $e) {
            Log::error('Request creation error: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create request: ' . $e->getMessage()
                ]);
            }

            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create request: ' . $e->getMessage()]);
        }
    }

    public function getPrice(Request $request)
    {
        // dd($request->all());

        $countryId = $request->country_id;


        $billableItem = \App\Models\BillableItem::where('country_id', $countryId)
            ->first();

        if ($billableItem) {
            return response()->json([
                'success' => true,
                'price' => number_format($billableItem->price, 2),
                'currency' => $billableItem->currency
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No price found.']);
    }


    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Request $request)
    {
        $request->load('requestItems.serviceProvider', 'requestItems.service');

        $request->load('embassy', 'member');
        return view('requests.show', compact('request'));
    }

    public function approveRequest($id, Request $request)
    {
        $request = RequestItem::findOrFail($id);
        $request->is_approved = true;
        $request->save();

        return redirect()->back()->with('success', 'Request approved successfully.');
    }

    public function rejectRequest($id, Request $request)
    {
        $request = RequestItem::findOrFail($id);
        $request->is_approved = false;
        $request->save();

        return redirect()->back()->with('error', 'Request rejected.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // Not implemented
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestRequest $request, Request $requestModel)
    {
        // Not implemented
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $requestModel)
    {
        // Not implemented
    }
}
