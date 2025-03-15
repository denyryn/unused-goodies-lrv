<?php

namespace App\Application;

use App\Repositories\WishlistRepository;

class WishlistApplication
{
    private $wishlistRepository;
    private $user_id;

    public function __construct(WishlistRepository $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
        $this->user_id = auth()->id();
    }

    public function addProductToWishlist($product_id)
    {
        return $this->wishlistRepository->create($this->user_id, $product_id);
    }

    public function removeProductFromWishlist($product_id)
    {
        return $this->wishlistRepository->remove($this->user_id, $product_id);
    }

    public function getUserWishlists()
    {
        return $this->wishlistRepository->getWishlistsByUserId($this->user_id);
    }

    public function isProductInWishlist($product_id)
    {
        return $this->wishlistRepository->isProductInWishlist($this->user_id, $product_id);
    }
}