<?php

namespace App\Application;

use App\Exceptions\CartException;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Flasher\Toastr\Prime\ToastrInterface;

class CartApplication
{
    private $cartRepository;
    private $productRepository;
    private $user_id;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->user_id = Auth::id();
    }

    protected function isRecordExists($product_id)
    {
        return $this->cartRepository
            ->isRecordExists($this->user_id, $product_id);
    }

    protected function isProductExceedsStock($product_id)
    {
        $product_stock = $this->productRepository->getProductStock($product_id);

        if ($product_stock <= 0) {
            return false;
        }

        return $this->cartRepository
            ->hasItemMoreThanQuantity($this->user_id, $product_id, $product_stock);
    }

    protected function hasItemMoreThanOneQuantity($product_id)
    {
        return $this->cartRepository
            ->hasItemMoreThanQuantity($this->user_id, $product_id, 1);
    }

    public function getUserCart($limit = null)
    {
        return $this->cartRepository
            ->getUserCart($this->user_id, $limit);
    }

    public function getTotalItemsInCart()
    {
        return count($this->getUserCart());
    }

    public function addProductToCart($product_id)
    {
        if ($this->isProductExceedsStock($product_id)) {
            return session()->flash('error', 'Product quantity is not sufficient.');
        }

        if ($this->isRecordExists($product_id)) {
            return $this->cartRepository
                ->incrementCartItemQuantity($this->user_id, $product_id);
        }

        return $this->cartRepository
            ->addProductToCart($this->user_id, $product_id);
    }

    public function removeProductFromCart($product_id)
    {
        return $this->cartRepository
            ->removeProductFromCart($this->user_id, $product_id);
    }

    public function updateCartItemQuantity($product_id, $quantity)
    {
        $availableStock = $this->productRepository->getProductStock($product_id);
        $quantity = min($quantity, $availableStock);
        return $this->cartRepository->updateCartItemQuantity($this->user_id, $product_id, $quantity);
    }

    public function incrementCartItemQuantity($product_id)
    {
        if ($this->isProductExceedsStock($product_id)) {
            return session()->flash('error', 'Insufficient stock for this product.');
        }
        return $this->cartRepository
            ->incrementCartItemQuantity($this->user_id, $product_id);
    }

    public function decrementCartItemQuantity($product_id)
    {
        if (!$this->hasItemMoreThanOneQuantity($product_id)) {
            return $this->cartRepository
                ->removeProductFromCart($this->user_id, $product_id);
        }
        return $this->cartRepository
            ->decrementCartItemQuantity($this->user_id, $product_id);
    }


    public function getTotalPriceOfSelectedItems($itemsIds)
    {
        return $this->cartRepository->getTotalPriceOfSelectedItems($itemsIds);
    }

    public function getTotalPriceOfUserCart()
    {
        return $this->cartRepository->getTotalPriceOfUserCart($this->user_id);
    }

    public function removeProductsFromCart($items)
    {
        return $this->cartRepository->removeProductsFromCart($this->user_id, $items);
    }

    public function getUserCheckedItems()
    {
        return $this->cartRepository->getUserCheckedItems($this->user_id);
    }

    public function getCheckedItemsTotalPrice()
    {
        $items = $this->getUserCheckedItems();
        if ($items->isEmpty()) {
            return 0;
        }
        return $this->cartRepository->getTotalPriceOfSelectedItems($items->pluck('id')->toArray());
    }

    public function toggleCheckAllItems($checkAll)
    {
        if ($checkAll && !$this->isAllItemsChecked()) {
            $this->cartRepository->checkAllItems($this->user_id);
            return;
        }

        $this->cartRepository->uncheckAllItems($this->user_id);
        return;
    }

    public function toggleItemCheck($product_id)
    {
        if ($this->isItemChecked($product_id)) {
            return $this->cartRepository->uncheckItem($this->user_id, $product_id);
        }

        return $this->cartRepository->checkItem($this->user_id, $product_id);
    }

    public function isItemChecked($product_id)
    {
        return $this->cartRepository->isItemChecked($this->user_id, $product_id);
    }

    public function isAllItemsChecked()
    {
        return $this->cartRepository->isAllItemsChecked($this->user_id);
    }

    public function removeCheckedItems()
    {
        return $this->cartRepository->removeCheckedItems($this->user_id);
    }
}