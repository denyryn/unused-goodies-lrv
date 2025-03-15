<?php

namespace App\Livewire\Cart;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Application\CartApplication;

use App\Utilities\Permission;

class CartManager extends Component
{
    private $cartApplication;
    public $items;
    public $product;
    public $totalItems;
    public $totalCartCost;

    public function boot(CartApplication $cartApplication)
    {
        $this->cartApplication = $cartApplication;
    }

    private function ensureUserIsLoggedIn()
    {
        if (!Permission::isLoggedIn()) {
            session(['redirect_after_login' => url()->previous()]);
            return redirect()->route('login');
        }
    }

    public function getTotalCartCost()
    {
        return $this->totalCartCost;
    }

    protected function calculateTotalCartCost()
    {
        $this->totalCartCost = $this->cartApplication->getTotalPriceOfUserCart();
    }

    public function getUserCart()
    {
        $this->items = $this->cartApplication->getUserCart();
    }

    public function getTotalItem()
    {
        $this->totalItems = $this->cartApplication->getTotalItemsInCart();
    }

    #[On('add-to-cart')]
    public function addToCart($productId)
    {
        if ($redirect = $this->ensureUserIsLoggedIn()) {
            return $redirect;
        }

        $this->cartApplication
            ->addProductToCart($productId);
        $this->dispatch('cart-updated');
    }

    #[On('remove-from-cart')]
    public function removeFromCart($productId)
    {
        $this->cartApplication
            ->removeProductFromCart($productId);
        $this->dispatch('cart-updated');
    }

    #[On('update-qty-cart')]
    public function updateItemQuantity($productId, $quantity)
    {
        $this->cartApplication
            ->updateCartItemQuantity($productId, $quantity);
        $this->dispatch('cart-updated');
    }

    #[On('increment-qty-cart')]
    public function incrementItemQuantity($productId)
    {
        $this->cartApplication
            ->incrementCartItemQuantity($productId);
        $this->dispatch('cart-updated');
    }

    #[On('decrement-qty-cart')]
    public function decrementItemQuantity($productId)
    {
        $this->cartApplication
            ->decrementCartItemQuantity($productId);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
