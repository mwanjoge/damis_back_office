<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Http\Requests\StoreRequestRequest;
use App\Services\RequestService;

class RequestController extends Controller
{
    public function __construct(protected RequestService $requestService)
    {
        $this->middleware('auth:sanctum');
    }

    public function store(StoreRequestRequest $request)
    {
        try {
            $data = $request->validated();

            //return $data['request_items'][0]['price'];

            $country = $this->requestService->getCountry($data['country_id']);


            $accountId = \App\Models\Account::query()->where('embassy_id', $country->embassy_id)->first()->id;
            if (!$accountId) {
                return redirect()->back()->withInput()->withErrors(['embassy_id' => 'Account not found for the specified embassy.']);
            }
            $this->requestService->setAccountId($country->id);
            $request = $this->requestService->createRequest($data);
            $invoice = $this->requestService->createInvoice($request);
            $this->requestService->addRequestedItems($request, $data['request_items']);
            $this->requestService->addInvoiceItems($invoice, $request->requestItems);

            $this->requestService->notifyMember($invoice, $request);

            $response = [
                'status' => 'success',
                'code' => 100,
                'message' => 'Member created successfully',
                'data' => new \App\Http\Resources\Request($request),
            ];

            return response()->json($response, 201);
        } 
        
        catch (\Exception $e) {
            $response = [
                'status' => 'failed',
                'code' => 101,
                'message' => 'Error creating request',
                'data' => $e->getMessage(),
            ];

            return response()->json($response, 201);
        }
    }
}