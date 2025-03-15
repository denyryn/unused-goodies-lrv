<?php

namespace App\Repositories;

use App\Models\Wishlist;

class WishlistRepository
{
    private $wishlist;
    public function __construct(Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
    }

    public function create($user_id, $product_id)
    {
        return $this->wishlist->create([
            'user_id' => $user_id,
            'product_id' => $product_id,
        ]);
    }

    public function remove($user_id, $product_id)
    {
        return $this->wishlist->where(['user_id' => $user_id, 'product_id' => $product_id])->delete();
    }

    public function findById(int $id)
    {
        return $this->wishlist->with(['product', 'user'])->find($id);
    }

    public function getWishlistsByUserId($id)
    {
        return $this->wishlist->where('user_id', $id)->with('product')->get();
    }

    public function isProductInWishlist($user_id, $product_id)
    {
        return $this->wishlist->where(['user_id' => $user_id, 'product_id' => $product_id])->exists();
    }
}