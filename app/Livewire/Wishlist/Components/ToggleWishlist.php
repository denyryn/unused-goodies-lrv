<?php

namespace App\Livewire\Wishlist\Components;

use Livewire\Attributes\On;
use App\Livewire\Wishlist\WishlistManager;
use App\Application\WishlistApplication;

class ToggleWishlist extends WishlistManager
{
    public $product;
    public bool $inWishlist;

    public function boot(WishlistApplication $wishlistApplication)
    {
        parent::boot($wishlistApplication);
        $this->isInWishlist($this->product->id);
    }

    public function mount()
    {
        parent::mount();
    }

    public function render()
    {
        return view('livewire.wishlist.components.toggle-wishlist');
    }
}