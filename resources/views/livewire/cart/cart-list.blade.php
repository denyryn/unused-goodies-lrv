<div class="flex space-x-2 relative">
    <div class="min-w-min max-w-full *:overflow-auto space-y-2 w-full">
        <div class="flex justify-between items-center bg-theme-secondary first:rounded-t-lg p-4">
            <div class="flex items-center space-x-2">
                <input class="product-checkbox" type="checkbox" wire:model="checkAll" wire:click="toggleCheckAllItems"
                    @if (count($items) === 0) disabled @endif>
                <span>Check All</span>
            </div>
            <x-link wire:click="removeCheckedItems()"
                class="@empty($checkedItems) opacity-50 cursor-not-allowed @endempty">
                Remove
            </x-link>
        </div>

        @foreach ($items as $item)
            <livewire:cart.cart-item :item="$item" :key="$item->id" wire:key="item-{{ $item->id }}"
                @cart-updated='$refresh' />
        @endforeach
    </div>

    <div
        class="sticky top-5 bg-theme-secondary p-6 rounded-lg space-y-4 min-w-fit max-w-sm w-full max-h-fit lg:block hidden">
        <h2 class="font-bold">Shopping Summary</h2>
        <div class="flex flex-row justify-between">
            <span>Price</span>
            <span class="font-bold">{{ \App\Utilities\Format::price($totalPrice) }}</span>
        </div>
        <button class="w-full bg-primary text-white py-2 rounded-lg font-medium disabled:opacity-50"
            wire:click="checkout" @if (empty($checkedItems)) disabled @endif>
            Checkout ({{ count($checkedItems) }} items)
        </button>
    </div>
</div>
