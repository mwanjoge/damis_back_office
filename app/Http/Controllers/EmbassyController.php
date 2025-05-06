<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Embassy;
use App\Events\EmbassyCreated;
use App\Services\EmbassyService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreEmbassyRequest;
use App\Http\Requests\UpdateEmbassyRequest;

class EmbassyController extends Controller
{

    public function __construct(protected EmbassyService $embassyService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmbassyRequest $request)
    {
        DB::beginTransaction();
    
        try {
            $embassy = $this->embassyService->create($request);
            $account = $this->embassyService->createAccount($request);
            $embassy->account()->save($account);
    
            $this->embassyService->attachCountries($embassy, $request);

            DB::commit();
                
            event(new EmbassyCreated($embassy));
            session()->flash('success', 'Emmbassy created successfully!');
      
       return redirect()->route('settings');
        } catch (\Exception $e) {
            DB::rollBack();
    
            // Log error for debugging
            Log::error('Failed to store embassy: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
    
            // Return failure response
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create embassy: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong!');
            // Optionally, you can log the error message for debugging
            return redirect()->route('settings');
       
            // // Log error for debugging
            // Log::error('Failed to store embassy: ' . $e->getMessage(), [
            //     'trace' => $e->getTraceAsString()
            // ]);
    
            // // Return failure response
            // return response()->json([
            //     'error' => 'Failed to store embassy',
            //     'message' => $e->getMessage()
            // ], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Embassy $embassy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Embassy $embassy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmbassyRequest $request, Embassy $embassy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Embassy $embassy)
    {
        //
    }
}
