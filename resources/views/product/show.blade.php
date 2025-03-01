<x-app-layout>
    <div class="max-w-2xl px-4 py-16 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

            @foreach ($products as $product)
                <a href="{{ route('product_detail_page', ['productSlug' => $product->slug]) }}"
                    class="p-3 transition duration-200 ease-in-out border rounded-md group active:scale-95">
                    <div
                        class="w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 aspect-square xl:aspect-h-8 xl:aspect-w-7">
                        <img src="{{ \App\Utilities\Asset::getFromStorage($product->productImages[0]->image_path) }}"
                            alt="{{ $product->name }}"
                            class="object-cover object-center w-full h-full group-hover:opacity-75">
                    </div>
                    <h3 class="mt-4 text-sm text-theme-invert">
                        {{ $product->name }}
                    </h3>
                    <div class="text-xs text-theme-invert line-clamp-2">
                        {!! $product->description !!}
                    </div>
                    <p class="mt-1 text-lg font-medium text-theme-invert">
                        {{ $product->formatted_price }}
                    </p>
                </a>
            @endforeach

        </div>
    </div>
</x-app-layout>