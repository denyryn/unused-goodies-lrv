<div>
    <!-- Cart Button -->
    <button aria-label="Shopping cart"
        class="flex bg-transparent border-none shadow-none outline-none btn btn-ghost text-gray-800 dark:text-gray-100"
        wire:mouseenter="$dispatch('open-floating-cart')" wire:click="$dispatch('open-floating-cart')">
        {!! file_get_contents(public_path('assets/Icons/cart.svg')) !!}
        <span class="sr-only">Shopping Cart</span>
    </button>

    <!-- Cart Dropdown -->
    <div class="absolute right-16 top-16 shadow-lg rounded-lg transform translate-y-2 z-50" style="display: none;"
        x-data="{
            open: false,
            init() {
                // initially closed
                this.open = false;
        
                this.$watch('open', (value) => {
                    if (value) {
                        @this.dispatch('open-floating-cart');
                    } else {
                        @this.dispatch('close-floating-cart');
                    }
                });
        
                Livewire.on('open-floating-cart', () => { this.open = true });
                Livewire.on('close-floating-cart', () => { this.open = false });
            }
        }" x-on:click.away="open = false" x-show="open"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
        @mouseleave="$dispatch('close-floating-cart')">
        <div class="relative items-center w-full max-w-lg p-5 bg-theme rounded-lg shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-medium text-theme-invert">
                    Cart({{ $itemCount ?? 0 }})
                </h3>
                <x-link>More</x-link>
            </div>

            @if ($itemCount > 0)
                <div class="mt-6 space-y-6">
                    @foreach ($items as $item)
                        <livewire:cart.cart-item :item="$item" :key="$item->id" viewType="quick" />
                    @endforeach
                </div>

                <div class="flex my-3 mt-8">
                    <span class="flex-1 text-sm">Total</span>
                    <span class="text-sm font-semibold">
                        Rp {{ number_format($total, 2, ',', '.') }}
                    </span>
                </div>

                <div class="flex max-sm:flex-col gap-4 !mt-6 w-full">
                    <button x-on:click="open = false"
                        class="btn px-6 py-2.5 w-1/2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md">
                        Continue Shopping
                    </button>
                    <a href="/checkout"
                        class="btn px-6 py-2.5 w-1/2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-center">
                        Check out
                    </a>
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <p class="mt-4 text-gray-600">Your cart is empty</p>
                    <button x-on:click="open = false"
                        class="px-4 py-2 mt-6 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Continue Shopping
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
