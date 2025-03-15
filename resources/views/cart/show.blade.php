<x-app-layout>
    <div class="flex mx-10">
        <div class="*:px-6 w-full *:w-full flex flex-col">
            <h2 class="my-6 max-w-3xl font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cart') }}
            </h2>
            <livewire:cart.components.cart-list />
        </div>
    </div>

    </div>
</x-app-layout>