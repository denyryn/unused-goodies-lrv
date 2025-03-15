<div class="flex space-x-2 relative">
    <div class="min-w-min max-w-full *:overflow-auto space-y-2 w-full">
        <div class="flex justify-between items-center bg-theme-secondary first:rounded-t-lg p-4">
            <div class="flex items-center space-x-2">
                <input class="product-checkbox" type="checkbox" wire:model="checkAll" wire:click="updateCheckAll()">
                <span>Check All</span>
            </div>
            <x-link wire:click="removeCheckedItems()">Remove</x-link>
        </div>
        @foreach ($items as $item)
            <div class="bg-theme-secondary flex flex-row last:rounded-b-lg p-4 space-x-4">
                <input class="product-checkbox" type="checkbox" wire:model='checkedItems' wire:click="getCheckedItemPrice()"
                    value="{{ $item->id }}">

                <img class="size-16"
                    src="{{ $item->product->productImages[0]->image_path ? \App\Utilities\Asset::getFromStorage($item->product->productImages[0]->image_path) : \App\Utilities\Asset::getDefaultImage()}}"
                    alt="{{__($item->product->name)}}">

                <div class="flex flex-col w-full justify-between *:flex">
                    <div class="justify-between w-full">
                        <span>{{$item->product->name}}</span>
                        <span>{{$item->product->formatted_price}}</span>
                    </div>
                    <div class="justify-end space-x-4 items-center *:transition *:duration-150">
                        <livewire:wishlist.components.toggle-wishlist :product="$item->product" />
                        <x-icon-button wire:click="removeFromCart({{ $item->product->id }})" class="size-fit group">
                            <x-heroicon-o-trash class="size-6 text-theme-primary group-hover:text-red-500" />
                        </x-icon-button>
                        <div class="flex justify-between items-center outline outline-1 w-fit h-7 rounded-sm *:h-full">
                            <button wire:click="decrementItemQuantity({{$item->product->id}})"
                                class="px-2 text-xs bg-theme-primary rounded-sm rounded-r-none hover:bg-theme-secondary ">-</button>
                            {{-- <input type="number" class="w-fit text-center text-sm bg-theme-primary"
                                wire:model.defer="item.{{ $item->id }}.quantity"
                                wire:blur="updateItemQuantity({{ $item->product->id }}, $event.target.value)" min="1"
                                max="{{ $item->product->stock }}"> --}}
                            <input type="number" value="{{ $item->quantity }}"
                                class="bg-theme-primary w-fit text-center text-sm" disabled>
                            <button wire:click="incrementItemQuantity({{$item->product->id}})"
                                class="px-2 text-xs bg-theme-primary rounded-sm rounded-l-none  hover:bg-theme-secondary">+</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="sticky top-5 bg-theme-secondary p-6 rounded-lg space-y-4 min-w-fit max-w-sm w-full max-h-fit">
        <h2 class="font-bold">Shopping Summary</h2>
        <div class="flex flex-row justify-between">
            <span>Price</span>
            <span class="font-bold">{{\App\Utilities\Format::price($totalPrice)}}</span>
        </div>
    </div>
</div>