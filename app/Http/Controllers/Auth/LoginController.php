<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\TokenResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Login.
     */
    public function __invoke(Request $request)
    {
        $attributes = $request->validate([
            'email'    => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (!Auth::guard('web')->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'invalid email or password'
            ]);
        }

        return new TokenResource([
            'token' => Auth::user()->createToken($request->userAgent())->plainTextToken,
            'user'  => Auth::user()
        ]);
    }
}
