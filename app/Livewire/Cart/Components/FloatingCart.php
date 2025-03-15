<?php

namespace App\Livewire\Cart\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Cart\CartManager;
use App\Application\CartApplication;

class FloatingCart extends CartManager
{
    protected $cartApplication;
    public $totalCartCost;

    public function boot(CartApplication $cartApplication)
    {
        parent::boot($cartApplication);
        $this->cartApplication = $cartApplication;
    }

    public function mount()
    {
        $this->loadCart();
    }

    public function resetAttributes()
    {
        $this->items = collect([]);
        $this->totalCartCost = 0;
        $this->totalItems = 0;
    }

    #[On('cart-updated')]
    public function loadCart()
    {
        $this->getUserCart();
        $this->getTotalItem();
        $this->calculateTotalCartCost();
    }

    #[On('open-floating-cart')]
    public function showCart()
    {
        $this->dispatch('open-cart-modal');
    }

    #[On('close-floating-cart')]
    public function handleCloseCart()
    {
        $this->dispatch('close-cart-modal');
    }

    public function render()
    {
        return view('cart.floating-cart');
    }
}