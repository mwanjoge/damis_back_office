<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = \App\Models\Request::all();

        // Calculate summary counts
        $summary = [
            'Pending' => $requests->where('status', 'Pending')->count(),
            'In Progress' => $requests->where('status', 'In Progress')->count(),
            'Completed' => $requests->where('status', 'Completed')->count(),
            'Cancelled' => $requests->where('status', 'Cancelled')->count(),
        ];

        return view('requests.index', compact('requests', 'summary'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = \App\Models\Service::query()->select('id', 'name')->get();
        $serviceProviders = \App\Models\ServiceProvider::query()->select('id', 'name');
        $embassies = \App\Models\Embassy::query()->select('id', 'name');
        $countries = \App\Models\Country::query()->select('id', 'name');
        $members = \App\Models\Member::query()->select('id', 'name');

        return view('requests.create', compact('services', 'serviceProviders', 'embassies', 'countries', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestRequest $request)
    {
 

        try {
            $data = $request->validated();

            // Set a default account_id (e.g., from the authenticated user or the first account)
            $accountId = \App\Models\Account::query()->where('embassy_id', $data['embassy_id'])->first()->id ?? null;
            if (!$accountId) {
                return redirect()->back()->withInput()->withErrors(['embassy_id' => 'Account not found for the specified embassy.']);
            }

            $mainRequest = \App\Models\Request::create([
                'account_id' => $accountId,
                'embassy_id' => $data['embassy_id'],
                'member_id' => $data['member_id'],
                'country_id' => $data['country_id'],
                'type' => $data['type'],
                'tracking_number' => \Illuminate\Support\Str::ulid(),
                'total_cost' => collect($data['request_items'] ?? [])->sum('price'),
            ]);
            
            foreach ($data['request_items'] ?? [] as $item) {
                \App\Models\RequestItem::create([
                    'account_id' => $accountId,
                    'request_id' => $mainRequest->id,
                    'service_id' => $item['service_id'],
                    'service_provider_id' => $item['service_provider_id'],
                    'certificate_holder_name' => $item['certificate_holder_name'],
                    'certificate_index_number' => $item['certificate_index_number'] ?? null,
                    'price' => $item['price'] ?? null,
                    'attachment' => $item['attachment'] ?? null,
                ]);
            }

            return redirect()->route('requests.index')->with('success', 'Request created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create request: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Request $request)
    {
        $request->load('items.serviceProvider', 'items.service');
        return view('Requests.show', compact('request'));
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
