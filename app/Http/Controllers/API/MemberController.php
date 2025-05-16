<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|string|max:15',
            'nin' => 'required|string|max:20|unique:members,nin',
        ]);

        $member = Member::create($validatedData);
        $response = [
            'status' => 'success',
            'code' => 100,
            'message' => 'Member created successfully',
            'data' => new \App\Http\Resources\Member($member),
        ];

        return response()->json($response, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:members,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
            'nin' => 'sometimes|required|string|max:20|unique:members,nin,' . $id,
        ]);
        $member = Member::findOrFail($id);
        $member->update($validatedData);
        //$member = $this->memberService->updateMember($id, $validatedData);
        return response()->json($member);
    }

}