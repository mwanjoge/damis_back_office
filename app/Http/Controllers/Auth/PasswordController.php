<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;


class PasswordController extends Controller
{
    /**
     * Show the password change form.
     *
     * @return \Illuminate\View\View
     */
    public function showChangeForm()
    {
        return view('auth.passwords.password_change');
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
        'password' => [
            'required',
            'confirmed',
            Password::min(8)               // Minimum 8 characters
                ->mixedCase()              // Must contain uppercase and lowercase
                ->letters()                // Must contain letters
                ->numbers()                // Must contain numbers
                ->symbols()                // Must contain symbols
                ->uncompromised(),         // Must not be in known data breaches
        ],
    ]);

    $user = Auth::user();
    $user->password = Hash::make($request->password);
    $user->is_default_password = false;
    $user->save();

    return redirect()->route('home')->with('success', 'Password updated successfully.');
}
}


