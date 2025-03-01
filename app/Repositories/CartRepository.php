<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function getUserCart($user_id)
    {
        return $this->cart->with('product')
            ->where('user_id', $user_id)->get();
    }

    public function isExisted($user_id, $product_id)
    {
        return $this->cart->where('user_id', $user_id)->where('product_id', $product_id)->exists();
    }

    public function addProductToCart($user_id, $product_id)
    {
        return $this->cart->create([
            'user_id' => $user_id,
            'product_id' => $product_id,
        ]);
    }

    public function removeProductFromCart($user_id, $product_id)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)->delete();
    }

    public function updateCartItemQuantity($user_id, $product_id, $quantity)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->update(['quantity' => $quantity]);
    }
}