<div>
    @if ($viewType === 'detail')
        <x-detail-cart-item wire:key="detail-{{ $item->id }}" :item="$item" wire:model.live="checked"
            wireToggleCheck="toggleCheck()" wireRemove="remove()" wireDecrement="decrement()" wireIncrement="increment()" />
    @else
        <x-quick-cart-item wire:key="quick-{{ $item->id }}" :item="$item" wireRemove="remove()"
            wireDecrement="decrement()" wireIncrement="increment()" />
    @endif
</div>
