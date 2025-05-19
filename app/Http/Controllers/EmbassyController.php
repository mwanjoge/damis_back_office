<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Embassy;
use App\Models\Country;
use App\Events\EmbassyCreated;
use App\Services\EmbassyService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreEmbassyRequest;
use App\Http\Requests\UpdateEmbassyRequest;

class EmbassyController extends Controller
{
    protected $embassyService;

    public function __construct(EmbassyService $embassyService)
    {
        $this->embassyService = $embassyService;

        $model = 'embassy';
        $this->middleware("permission:read_{$model}")->only(['index', 'show']);
        $this->middleware("permission:create_{$model}")->only(['create', 'store']);
        $this->middleware("permission:update_{$model}")->only(['edit', 'update']);
        $this->middleware("permission:delete_{$model}")->only(['destroy']);
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
        $request->validated();
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
 public function update(UpdateEmbassyRequest $request, $id)
{
    try {
        $embassy = Embassy::findOrFail($id);
        
        // Corrected type assignment
        $embassy->update([
            'name'        => $request->name,
            'type'        => $request->type,
            'country_id'  => $request->location_id,
            'is_active'   => $request->is_active ?? false,
        ]);

        // Clear old accreditations
        Country::where('embassy_id', $embassy->id)->update(['embassy_id' => null]);

        // Set new accreditations
        if ($request->has('country_id')) {
            Country::whereIn('id', $request->country_id)->update(['embassy_id' => $embassy->id]);
        }

        return redirect()->back()->with('success', 'Embassy updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update embassy: ' . $e->getMessage());
    }
}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $embassy = Embassy::findOrFail($id);
            $embassy->delete();

            return redirect()->back()->with('success', 'Embassy deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete embassy: ' . $e->getMessage());
        }
    }



    public function settings()
    {
        $embassies = Embassy::with('account')->get();
        return view('settings', compact('embassies'));
    }
}
