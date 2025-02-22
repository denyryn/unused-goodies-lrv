<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\RoleEnum;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
    ];

    /**
     * Get the addresses associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Address>
     */
    public function address()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the orders associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Order>
     */
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the reviews written by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Review>
     */
    public function review()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => RoleEnum::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
