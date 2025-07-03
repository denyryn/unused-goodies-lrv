<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Application\CartApplication;

class QuickViewCart extends Component
{
    protected $cartApplication;

    public $isOpen = false;
    public $items = [];
    public $total = 0;
    public $itemCount = 0;


    public function boot(CartApplication $cartApplication)
    {
        $this->cartApplication = $cartApplication;
    }

    public function mount()
    {
        $this->refreshCart();
    }

    #[On('cart-updated')]
    public function refreshCart()
    {
        $this->items = $this->cartApplication->getUserCart(3) ?? [];
        $this->total = $this->cartApplication->getTotalPriceOfUserCart();
        $this->itemCount = $this->cartApplication->getTotalItemsInCart();
    }

    public function removeItem($itemId)
    {
        $this->cartApplication->removeProductFromCart($itemId);
        $this->dispatch('cart-updated');
    }

    #[On('open-floating-cart')]
    public function showCart()
    {
        $this->isOpen = true;
    }

    #[On('close-floating-cart')]
    public function closeCart()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.cart.quick-view-cart');
    }
}
