<x-app-layout>
    <div class="max-w-2xl px-4 py-16 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        @if (count($products) === 0)
            <div class="text-center flex flex-col items-center justify-center space-y-12">
                <div class="size-64">
                    {!! file_get_contents(public_path('assets/Icons/empty-box.svg')) !!}
                </div>
                <p class="text-2xl font-bold text-theme-invert"> Oops! No products found</p>
                <!-- Consider adding a call-to-action button here -->
            </div>
        @else
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @foreach ($products as $product)
                    <article
                        class="p-3 transition duration-200 ease-in-out border rounded-md group hover:shadow-md active:scale-95">
                        <a href="{{ route('product_detail_page', ['productSlug' => $product->slug]) }}"
                            class="block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                            aria-label="View details for {{ $product->name }}">
                            <div class="relative w-full overflow-hidden bg-gray-100 rounded-md aspect-square">
                                <img src="{{ \App\Utilities\Asset::getFromStorage($product->productImages[0]->image_path) }}"
                                    alt="{{ $product->name }}"
                                    class="object-cover object-center w-full h-full transition-opacity duration-200 group-hover:opacity-90"
                                    loading="lazy" width="300" height="300">
                                <!-- Consider adding a placeholder image or skeleton loader -->
                            </div>

                            <div class="mt-4 space-y-2">
                                <h3 class="text-sm font-medium text-theme-invert">
                                    {{ $product->name }}
                                </h3>

                                @if ($product->description)
                                    <div class="text-xs text-theme-invert/80 line-clamp-2">
                                        {!! strip_tags($product->description) !!}
                                    </div>
                                @endif

                                <p class="text-lg font-semibold text-theme-invert">
                                    {{ $product->formatted_price }}
                                </p>

                                <!-- Consider adding product badges (sale, new, etc.) here -->
                            </div>
                        </a>

                        <!-- Consider adding an "Add to Cart" button here -->
                    </article>
                @endforeach
            </div>

            <!-- Consider adding pagination if applicable -->
            {{-- @if ($products->hasPages())
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @endif --}}
        @endif
    </div>
</x-app-layout>
