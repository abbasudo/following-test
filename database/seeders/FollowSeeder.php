<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Random\RandomException;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        User::all()->each(function (User $user) {
            // Create a random number of following relationships for each user
            Follow::factory(random_int(1, 10))
                ->state(
                    new Sequence(
                        fn(Sequence $sequence) => ['following_id' => User::all()->random()],
                    )
                )
                ->for($user)
                ->create();
        });
    }
}
