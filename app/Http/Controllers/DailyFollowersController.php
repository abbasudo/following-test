<?php

namespace App\Http\Controllers;

use App\Http\Resources\FollowersResource;
use App\Models\User;

class DailyFollowersController extends Controller
{
    public function __invoke(User $user)
    {
        $startDate = now()->subMonth();
        $endDate = now();

        return $user->follows()
            ->selectRaw('date(created_at) as day, count(*) as followers_count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('day')
            ->orderBy('day')
            ->get();
    }
}
