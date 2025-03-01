<?php

namespace App\Application;

use App\Repositories\CartRepository;

class CartApplication
{
    private $cartRepository;

    protected function isExisted($user_id, $product_id)
    {
        return $this->cartRepository->isExisted($user_id, $product_id);
    }

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getUserCart($user_id)
    {
        return $this->cartRepository->getUserCart($user_id);
    }

    public function addProductToCart($user_id, $product_id)
    {
        if ($this->isExisted($user_id, $product_id)) {
            return $this->cartRepository->updateCartItemQuantity($user_id, $product_id, 1);
        }
        return $this->cartRepository->addProductToCart($user_id, $product_id);
    }

    public function removeProductFromCart($user_id, $product_id)
    {
        return $this->cartRepository->removeProductFromCart($user_id, $product_id);
    }

    public function updateCartItemQuantity($user_id, $product_id, $quantity)
    {
        return $this->cartRepository->updateCartItemQuantity($user_id, $product_id, $quantity);
    }

}