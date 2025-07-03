@props([
    'item' => null,
    'checked' => false,
    'wireToggleCheck' => 'toggleCheck',
    'wireRemove' => 'remove',
    'wireDecrement' => 'decrement',
    'wireIncrement' => 'increment',
])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between bg-theme-secondary p-4 rounded-lg']) }}>
    <div class="flex items-center space-x-4">
        <input type="checkbox" @checked($checked) wire:model="checked" wire:change="{{ $wireToggleCheck }}"
            class="product-checkbox">

        <div class="flex items-center space-x-2">
            <img src="{{ \App\Utilities\Asset::getProductImage($item->product->productImages[0]->image_path) }}"
                alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
            <div>
                <h3 class="font-medium">{{ $item->product->name }}</h3>
                <p class="text-sm text-gray-500">
                    {{ \App\Utilities\Format::price($item->product->price) }}
                </p>
            </div>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-2">
            <button wire:click="{{ $wireDecrement }}" class="quantity-stepper-btn"
                @if ($item->quantity <= 1) disabled @endif>
                -
            </button>
            <span class="w-6 text-center">{{ $item->quantity }}</span>
            <button wire:click="{{ $wireIncrement }}" class="quantity-stepper-btn">
                +
            </button>
        </div>
        <button wire:click="{{ $wireRemove }}" class="text-red-500 hover:text-red-700 transition">
            <x-heroicon-o-trash class="size-5" />
        </button>
    </div>
</div>
