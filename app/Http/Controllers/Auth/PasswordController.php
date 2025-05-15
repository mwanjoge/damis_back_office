<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    /**
     * Show the password change form.
     *
     * @return \Illuminate\View\View
     */
    public function showChangeForm()
    {
        return view('auth.password_change');
    }

    /**
     * Handle password update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->is_default_password = false; // Mark password as changed
        $user->save();

        return redirect()->route('home')->with('success', 'Password updated successfully.');
    }
}
