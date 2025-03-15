<x-icon-button wire:click="toggleWishlist({{ $product->id }})"
    class="size-fit group transition duration-300 transform active:scale-90"
    wire:key="toggle-wishlist-{{ $product->id }}">
    @if ($inWishlist)
        <x-heroicon-s-heart class="size-6 text-red-500 group-hover:text-theme-primary" />
    @else
        <x-heroicon-o-heart
            class="size-6 text-theme-primary group-hover:text-red-500 transition-transform duration-300 hover:scale-110" />
    @endif
</x-icon-button>