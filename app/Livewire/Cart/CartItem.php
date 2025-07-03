<?php

namespace App\Livewire\Cart;

use App\Application\CartApplication;
use Livewire\Component;
use Livewire\Attributes\On;

class CartItem extends Component
{
    private $cartApplication;
    public $viewType = 'detail';

    public $item;
    public $checked = false;

    public function boot(CartApplication $cartApplication)
    {
        $this->cartApplication = $cartApplication;
    }

    public function mount()
    {
        $this->checked = $this->cartApplication->isItemChecked($this->item->product_id);
    }

    #[On('cart-updated')]
    public function refresh()
    {
        $this->item;
        $this->checked = $this->cartApplication->isItemChecked($this->item->product_id);
    }

    public function toggleCheck()
    {
        $this->cartApplication->toggleItemCheck($this->item->product_id);
        $this->dispatch('cart-updated');
    }

    public function increment()
    {
        $this->cartApplication->incrementCartItemQuantity($this->item->product_id);
        $this->dispatch('cart-updated');
    }

    public function decrement()
    {
        $this->cartApplication->decrementCartItemQuantity($this->item->product_id);
        $this->dispatch('cart-updated');
    }

    public function remove()
    {
        $this->cartApplication->removeProductFromCart($this->item->product_id);
        $this->dispatch('cart-updated');
    }

    #[On('cart-updated')]
    public function syncCheckedState()
    {
        $this->checked = $this->cartApplication->isItemChecked($this->item->product_id);
    }

    public function render()
    {
        return view('livewire.cart.cart-item');
    }
}