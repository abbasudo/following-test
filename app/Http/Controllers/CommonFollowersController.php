<?php

namespace App\Http\Controllers;

use App\Http\Resources\FollowersResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommonFollowersController extends Controller
{
    public function __invoke(User $user, User $comparedUser)
    {
        $followers = $user->commonFollowers($comparedUser);

        return FollowersResource::collection($followers);
    }
}
