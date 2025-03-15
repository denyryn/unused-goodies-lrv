<?php

namespace App\Livewire\Cart\Components;

use Livewire\Component;

use App\Livewire\Cart\CartManager;

class AddToCartButton extends CartManager
{
    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
