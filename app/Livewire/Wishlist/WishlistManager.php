<?php

namespace App\Livewire\Wishlist;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Application\WishlistApplication;

class WishlistManager extends Component
{
    protected $wishlistApplication;
    public $product;
    public $wishlist;
    public $productInList;
    public bool $inWishlist;

    public function boot(WishlistApplication $wishlistApplication)
    {
        $this->wishlistApplication = $wishlistApplication;
        $this->getUserWishlists();
        // $this->isInWishlist($this->product->id);
    }

    public function mount()
    {
    }

    public function isInWishlist($product_id)
    {
        $this->inWishlist = $this->wishlistApplication->isProductInWishlist($product_id);
    }

    #[On('wishlist-updated')]
    public function getUserWishlists()
    {
        $this->wishlist = $this->wishlistApplication
            ->getUserWishlists();
        $this->productInList = $this->wishlist->pluck('product_id')->toArray();
    }

    #[On('toggle-wishlist')]
    public function toggleWishlist($product_id)
    {
        if ($this->isProductInWishlist($product_id)) {
            return $this->removeProductFromWishlist($product_id);
        }
        return $this->addProductToWishlist($product_id);
    }

    public function isProductInWishlist($product_id)
    {
        return in_array($product_id, $this->productInList);
    }

    #[On('add-to-wishlist')]
    public function addProductToWishlist($product_id)
    {
        $this->wishlistApplication->addProductToWishlist($product_id);
        $this->updateWishlistState();
    }

    #[On('remove-from-wishlist')]
    public function removeProductFromWishlist($product_id)
    {
        $this->wishlistApplication->removeProductFromWishlist($product_id);
        $this->updateWishlistState();
    }

    private function updateWishlistState()
    {
        $this->getUserWishlists();
        $this->dispatch('wishlist-updated'); // Update all wishlist buttons across pages
    }

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
