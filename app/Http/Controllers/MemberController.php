<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
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
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
        ]);
    
        $member = Member::create($request->only(['name', 'email', 'phone','account_id']));
        $accountId = \App\Models\Account::query()->where('embassy_id', $member['embassy_id'])->first()->id;
        if (!$accountId) {
            return redirect()->back()->with('error', 'Account not found for the specified embassy.');
        }
        if ($request->expectsJson()) {
            return response()->json(['id' => $member->id, 'name' => $member->name]);
        }
    
        return redirect()->back()->with('success', 'Member created.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
