<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\RoleEnum;

class User extends Authenticatable implements FilamentUser, HasAvatar
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
        'role',
        'password',
    ];

    /**
     * Get the wishlists associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Wishlist>
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Get the carts associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Cart>
     */

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

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

    /**
     * Determine if the user can access the specified Filament panel.
     *
     * @param \Filament\Panel $panel
     * @return bool True if the user is an admin, false otherwise.
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->role === RoleEnum::ADMIN;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function hasWished($product)
    {
        return $this->wishlists()->where('product_id', $product->id)->exists();
    }
}
