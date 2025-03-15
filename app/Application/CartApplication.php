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
        $this->user_id = auth()->id();
    }

    protected function isRecordExists($product_id)
    {
        return $this->cartRepository
            ->isRecordExists($this->user_id, $product_id);
    }

    protected function isProductQuantitySufficient($product_id)
    {
        return $this->cartRepository
            ->hasItemMoreThanQuantity($this->user_id, $product_id, ($this->productRepository
                ->getProductStock($product_id) - 1));
    }

    protected function hasItemMoreThanOneQuantity($product_id)
    {
        return $this->cartRepository
            ->hasItemMoreThanQuantity($this->user_id, $product_id, 1);
    }

    public function getUserCart()
    {
        return $this->cartRepository
            ->getUserCart($this->user_id);
    }

    public function getTotalItemsInCart()
    {
        return count($this->getUserCart());
    }

    public function addProductToCart($product_id)
    {
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
        if ($this->isProductQuantitySufficient($product_id)) {
            return;
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


    public function getTotalPriceOfSelectedItems($items)
    {
        return $this->cartRepository->getTotalPriceOfSelectedItems($items);
    }

    public function getTotalPriceOfUserCart()
    {
        return $this->cartRepository->getTotalPriceOfUserCart($this->user_id);
    }

    public function removeProductsFromCart($items)
    {
        return $this->cartRepository->removeProductsFromCart($this->user_id, $items);
    }

}