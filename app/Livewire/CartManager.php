<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Application\CartApplication;

class CartManager extends Component
{
    private $cartApplication;

    public function mount(CartApplication $cartApplication)
    {
        $this->cartApplication = $cartApplication;
    }

    #[On('add-to-cart')]
    public function addToCart($productId)
    {
        $this->cartApplication
            ->addProductToCart(auth()->id(), $productId);
        $this->dispatch('cartUpdated');
    }

    #[On('update-qty')]
    public function updateQuantity($productId, $quantity)
    {
        $this->cartApplication
            ->updateCartItemQuantity(auth()->id(), $productId, $quantity);
        $this->dispatch('cartUpdated');
    }

    #[On('remove-from-cart')]
    public function removeFromCart($productId)
    {
        $this->cartApplication
            ->removeProductFromCart(auth()->id(), $productId);
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
