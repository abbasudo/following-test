<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Follow a user.
     */
    public function store(User $user)
    {
        abort_if(Auth::user()->id === $user->id, 422, 'Cannot follow yourself');

        Auth::user()->follow($user);

        return new UserResource($user);
    }

    /**
     * Unfollow a user.
     */
    public function destroy(User $user)
    {
        Auth::user()->unfollow($user);

        return new UserResource($user);
    }
}
