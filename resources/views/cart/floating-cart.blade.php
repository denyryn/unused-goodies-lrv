<div>
    <button 
        class="flex bg-transparent border-none shadow-none outline-none btn btn-ghost text-gray-800 dark:text-gray-100"
        wire:mouseenter="$dispatch('open-cart')"
        wire:click="$dispatch('open-cart')" >
        {!! file_get_contents(public_path('assets/Icons/cart.svg')) !!}
    </button>
    <div 
        class="absolute right-16 top-16 shadow-lg rounded-lg transform translate-y-2 z-50"
        wire:mouseleave="close-cart"
        x-data="{ open: false }" 
        x-on:open-cart-modal.window="open = true" 
        x-on:close-cart-modal.window="open = false"
        x-on:click.away="open = false"
        x-show="open" 
        x-transition>
            <div class="relative items-center w-full max-w-lg p-5 bg-theme rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-medium text-theme-invert">
                        Cart({{ count($cartItems) }})
                    </h3>
                    <x-link>
                        More
                    </x-link>
                </div>

                @if(count($cartItems) > 0)
                    <div class="mt-6 space-y-6">
                        @foreach ($cartItems as $item)
                            <div class="flex items-center">
                                <img src="{{ $item->image_path ?? ($item->product->image_path ?? '/images/placeholder.png') }}"
                                    alt="{{ $item->product_name ?? $item->product->name ?? 'Product' }}"
                                    class="object-cover w-16 h-16 p-2 bg-gray-100 aspect-square shrink-0" />
                                <div class="flex-1 ml-4">
                                    <p class="text-sm text-black">
                                        {{ $item->product_name ?? $item->product->name ?? 'Unknown Product' }}
                                    </p>
                                    <div class="flex items-center mt-1">
                                        <button 
                                            wire:click="updateQuantity({{ $item->product_id ?? $item->product->id }}, {{ $item->quantity - 1 }})"
                                            class="px-2 text-xs bg-gray-200 rounded hover:bg-gray-300"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}
                                            {{ $item->quantity <= 1 ? 'class="opacity-50 cursor-not-allowed"' : '' }}
                                        >-</button>
                                        <span class="mx-2 text-xs">{{ $item->quantity }}</span>
                                        <button 
                                            wire:click="updateQuantity({{ $item->product_id ?? $item->product->id }}, {{ $item->quantity + 1 }})"
                                            class="px-2 text-xs bg-gray-200 rounded hover:bg-gray-300"
                                        >+</button>
                                    </div>
                                </div>
                                <div>
                                    <span class="mr-5 text-sm font-semibold">
                                        Rp {{ number_format($item->quantity * ($item->price ?? $item->product->price), 2, ',', '.') }}
                                    </span>
                                    <button 
                                        wire:click="removeItem({{ $item->product_id ?? $item->product->id }})"
                                        wire:loading.attr="disabled"
                                        class="text-red-500 hover:text-red-700"
                                    >&times;</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex my-3 mt-8">
                        <span class="flex-1 text-sm">Total</span>
                        <span class="text-sm font-semibold">
                            Rp {{ number_format($totalCartCost, 2, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex max-sm:flex-col gap-4 !mt-6 w-full">
                        <button 
                            x-on:click="open = false"
                            class="btn px-6 py-2.5 w-full bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md"
                        >
                            Continue Shopping
                        </button>
                        <a href="/checkout"
                            class="btn px-6 py-2.5 w-full bg-blue-600 hover:bg-blue-700 text-white rounded-md text-center"
                        >
                            Check out
                        </a>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <p class="mt-4 text-gray-600">Your cart is empty</p>
                        <button 
                            x-on:click="open = false"
                            class="px-4 py-2 mt-6 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700"
                        >
                            Continue Shopping
                        </button>
                    </div>
                @endif
            </div>
        </div>
</div>