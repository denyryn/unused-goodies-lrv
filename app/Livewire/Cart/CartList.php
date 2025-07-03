<?php

namespace App\Livewire\Cart;

use App\Application\CartApplication;
use Livewire\Component;
use Livewire\Attributes\On;

class CartList extends Component
{
    private $cartApplication;
    public $items = [];
    public $checkedItems = [];
    public $totalPrice = 0;
    public $checkAll = false;

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
        $this->items = $this->cartApplication->getUserCart();
        $this->checkedItems = $this->cartApplication->getUserCheckedItems()->pluck('product_id')->toArray();
        $this->totalPrice = $this->cartApplication->getCheckedItemsTotalPrice();
        $this->checkAll = $this->cartApplication->isAllItemsChecked();
        $this->dispatch('cart-updated')->to(CartItem::class);
    }

    public function toggleCheckAllItems()
    {
        $this->cartApplication->toggleCheckAllItems($this->checkAll);
        $this->refreshCart();
    }

    public function removeCheckedItems()
    {
        $this->cartApplication->removeCheckedItems();
        $this->refreshCart();
    }

    public function checkout()
    {
        if (empty($this->checkedItems)) {
            return;
        }
        // Add checkout logic here
    }

    public function render()
    {
        return view('livewire.cart.cart-list');
    }
}