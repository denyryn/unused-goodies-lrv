<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Application\CartApplication;

class FloatingCart extends Component
{
    protected $cartApplication;
    public bool $isOpen = false;
    public $cartItems = [];
    public $totalCartCost = 0;

    public function boot(CartApplication $cartApplication)
    {
        $this->cartApplication = $cartApplication;
    }

    public function mount()
    {
        $this->loadCart();
    }

    public function getTotalPrice()
    {
        return $this->totalCartCost;
    }

    #[On('cart-updated')]
    public function loadCart()
    {
        if (!auth()->check()) {
            $this->cartItems = collect([]);
            $this->totalCartCost = 0;
            return;
        }

        try {
            $this->cartItems = $this->cartApplication->getUserCart(auth()->id());
            $this->calculateTotal();
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Failed to load cart: ' . $e->getMessage());
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to load your cart. Please try again.'
            ]);
        }
    }

    #[On('open-cart')]
    public function showCart()
    {
        $this->dispatch('open-cart-modal');
    }

    #[On('close-cart')]
    public function handleCloseCart()
    {
        $this->dispatch('close-cart-modal');
    }

    protected function calculateTotal()
    {
        $this->totalCartCost = $this->cartItems->sum(function ($item) {
            // Handle both nested and flat data structures
            if (isset($item->product) && is_object($item->product)) {
                return $item->quantity * $item->product->price;
            }
            return $item->quantity * $item->price;
        });
    }

    public function removeItem($productId)
    {
        if (!auth()->check())
            return;

        try {
            $this->cartApplication->removeProductFromCart(auth()->id(), $productId);
            $this->dispatch('cartUpdated');
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Item removed from cart'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to remove item. Please try again.'
            ]);
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        if (!auth()->check() || $quantity < 1)
            return;

        try {
            $this->cartApplication->updateCartItemQuantity(auth()->id(), $productId, $quantity);
            $this->loadCart();
            $this->dispatch('cartUpdated');
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to update quantity. Please try again.'
            ]);
        }
    }

    public function render()
    {
        return view('cart.floating-cart');
    }
}