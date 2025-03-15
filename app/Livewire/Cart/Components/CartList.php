<?php

namespace App\Livewire\Cart\Components;

use Livewire\Component;
use App\Livewire\Cart\CartManager;
use Livewire\Attributes\On;

use App\Application\CartApplication;

class CartList extends CartManager
{
    private $cartApplication;
    public $checkedItems;
    public $totalPrice;
    public $checkAll;

    public function boot(CartApplication $cartApplication)
    {
        parent::boot($cartApplication);
        $this->cartApplication = $cartApplication;
    }

    public function mount()
    {
        $this->resetProperties();
        $this->getUserCart();
    }

    public function resetProperties()
    {
        $this->checkedItems = [];
        $this->totalPrice = 0;
        $this->checkAll = false;
    }

    #[On('cart-updated')]
    public function loadCart()
    {
        $this->getUserCart();
        $this->getCheckedItemPrice();
    }

    public function updateCheckAll()
    {
        if ($this->checkAll) {
            $this->checkedItems = $this->items->pluck('id')->toArray();
        } else {
            $this->checkedItems = [];
        }
        $this->getCheckedItemPrice();
    }

    public function removeCheckedItems()
    {
        $this->cartApplication
            ->removeProductsFromCart($this->checkedItems);
        $this->resetProperties();
        $this->dispatch('cart-updated');
    }

    public function getCheckedItemPrice()
    {
        $this->totalPrice = $this->cartApplication->getTotalPriceOfSelectedItems($this->checkedItems);
    }

    public function checkAllItems()
    {

    }

    public function render()
    {
        return view('livewire.cart-list');
    }
}
