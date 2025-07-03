<?php

namespace App\Livewire\Cart;

use App\Application\CartApplication;
use App\Utilities\Permission;
use Livewire\Component;
use Livewire\Attributes\On;

class AddToCart extends Component
{
    protected $cartApplication;
    public $productId;

    public function boot(CartApplication $cartApplication)
    {
        $this->cartApplication = $cartApplication;
    }

    #[On('add-to-cart')]
    public function addToCart()
    {
        if ($redirect = $this->ensureUserIsLoggedIn()) {
            return $redirect;
        }

        $this->cartApplication
            ->addProductToCart($this->productId);
        $this->dispatch('cart-updated');
    }

    private function ensureUserIsLoggedIn()
    {
        if (!Permission::isLoggedIn()) {
            session(['redirect_after_login' => url()->previous()]);
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.cart.add-to-cart');
    }
}
