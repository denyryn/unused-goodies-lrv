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

    /**
     * Check if the given product_id in user's cart has more than the given quantity
     *
     * @param int $user_id
     * @param int $product_id
     * @param int $quantity
     * @return bool
     */
    public function hasItemMoreThanQuantity($user_id, $product_id, $quantity)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('quantity', '>', $quantity - 1)
            ->exists();
    }

    public function getUserCart($user_id, $limit = null)
    {
        $query = $this->cart->with('product.productImages')
            ->where('user_id', $user_id);

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
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

    public function getUserCartItemCount($user_id, $product_id)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->count();
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

    public function getUserCheckedItems($user_id)
    {
        return $this->cart->where('user_id', $user_id)
            ->where('is_checked', true)
            ->get();
    }

    public function checkItem($user_id, $product_id)
    {
        if (!$this->isRecordExists($user_id, $product_id)) {
            throw new \Exception("Item not found in cart.");
        }
        if ($this->isItemChecked($user_id, $product_id)) {
            throw new \Exception("Item is already checked.");
        }
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->update(['is_checked' => true]);
    }

    public function uncheckItem($user_id, $product_id)
    {
        if (!$this->isRecordExists($user_id, $product_id)) {
            throw new \Exception("Item not found in cart.");
        }
        if (!$this->isItemChecked($user_id, $product_id)) {
            throw new \Exception("Item is already unchecked.");
        }
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->update(['is_checked' => false]);
    }

    public function checkAllItems($user_id)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->update(['is_checked' => true]);
    }

    public function uncheckAllItems($user_id)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->update(['is_checked' => false]);
    }

    public function isItemChecked($user_id, $product_id)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('is_checked', true)
            ->exists();
    }

    public function isAllItemsChecked($user_id)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('is_checked', true)
            ->count() === $this->cart->where('user_id', $user_id)->count();
    }

    public function removeCheckedItems($user_id)
    {
        return $this->cart
            ->where('user_id', $user_id)
            ->where('is_checked', true)
            ->delete();
    }
}