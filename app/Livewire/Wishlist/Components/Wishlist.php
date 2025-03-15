<?php

namespace App\Livewire\Wishlist\Components;

use App\Livewire\Wishlist\WishlistManager;

use Livewire\Component;

class Wishlist extends WishlistManager
{
    public function render()
    {
        return view('livewire.wishlist.components.wishlist');
    }
}
