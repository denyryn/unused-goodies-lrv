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

    public function isRecordExists($user_id, $product_id)
    {
        return $this->cart->where('user_id', $user_id)->where('product_id', $product_id)->exists();
    }

    public function hasItemMoreThanQuantity($user_id, $product_id, $quantity)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('quantity', '>', $quantity)
            ->exists();
    }

    public function getUserCart($user_id)
    {
        return $this->cart->with('product.productImages')
            ->where('user_id', $user_id)->get();
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

    public function removeProductsFromCart($user_id, $items)
    {
        return $this->cart->whereIn('id', $items)->delete();
    }

    public function updateCartItemQuantity($user_id, $product_id, $quantity)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->update(['quantity' => $quantity]);
    }

    public function incrementCartItemQuantity($user_id, $product_id)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->increment('quantity', 1);
    }

    public function decrementCartItemQuantity($user_id, $product_id)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->decrement('quantity', 1);
    }

    public function getTotalPriceOfSelectedItems($items)
    {
        return $this->cart->whereIn('id', $items)
            ->with('product')
            ->get()
            ->sum(fn($item) => $item->product->price * $item->quantity);
    }

    public function getTotalPriceOfUserCart($user_id)
    {
        return $this->cart->where('user_id', $user_id)
            ->with('product')
            ->get()
            ->sum(fn($item) => $item->product->price * $item->quantity);
    }
}