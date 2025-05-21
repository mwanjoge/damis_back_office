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

      public function __construct()
    {
        $model = 'member';
        $this->middleware("permission:view_{$model}")->only(['index', 'show']);
        $this->middleware("permission:create_{$model}")->only(['create', 'store']);
        $this->middleware("permission:edit_{$model}")->only(['edit', 'update']);
        $this->middleware("permission:delete_{$model}")->only(['destroy']);
    }


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
    public function store(StoreMemberRequest $request)
    {
        try {
            $member = Member::create($request->only(['name', 'email', 'phone']));
            return redirect()->back()->with('success', 'Member created.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create member: ' . $e->getMessage());
        }
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
