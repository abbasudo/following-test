<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'username';
    }

    /**
     * Follow a user.
     */
    public function follow(User $user): void
    {
        if ($this->id === $user->id) {
            return;
        }

        $this->following()->syncWithoutDetaching($user->id);
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(User $user): void
    {
        $this->following()->detach($user->id);
    }

    /**
     * Get common followers.
     */
    public function commonFollowers(User $user)
    {
        return $this->followers()->whereHas('follows', function ($query) use ($user) {
            $query->where('following_id', $user->id);
        })->get();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'user_id')->withTimestamps();
    }

    public function follows()
    {
        return $this->hasMany(Follow::class);
    }
}
