@props([
    'item' => null,
    'wireToggleCheck' => null,
    'wireRemove' => null,
    'wireDecrement' => null,
    'wireIncrement' => null,
])

@if ($item && $item->product)
    <div class="bg-theme-secondary flex flex-row items-center p-3 space-x-3 rounded-lg">
        <img class="size-12 rounded object-cover"
            src="{{ \App\Utilities\Asset::getProductImage($item->product->productImages[0]->image_path) }}"
            alt="{{ __($item->product->name) }}" width="48" height="48" loading="lazy">

        <div class="flex-1 min-w-0">
            <p class="text-sm font-medium truncate">{{ $item->product->name }}</p>
            <p class="text-xs text-gray-500">{{ $item->product->formatted_price }}</p>
        </div>

        <div class="flex items-center space-x-2">
            <button wire:click.debounce.200ms="{{ $wireDecrement }}" class="quantity-stepper-btn"
                aria-label="Decrease quantity" @if ($item->quantity <= 1) disabled @endif>
                -
            </button>
            <span class="text-sm w-6 text-center">{{ $item->quantity }}</span>
            <button wire:click.debounce.200ms="{{ $wireIncrement }}" class="quantity-stepper-btn"
                aria-label="Increase quantity">
                +
            </button>
        </div>
    </div>
@else
    <div class="bg-theme-secondary p-3 rounded-lg text-sm text-gray-500">
        Product unavailable
    </div>
@endif
