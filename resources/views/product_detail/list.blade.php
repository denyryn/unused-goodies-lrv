<div class="py-6 sm:py-8 lg:py-12">
    <div class="max-w-screen-lg px-4 mx-auto md:px-8">
        <div class="grid gap-8 md:grid-cols-2">
            <!-- images - start -->
            <div class="space-y-4">
                <div class="relative overflow-hidden bg-gray-100 rounded-md aspect-square">
                    @foreach ($product->productImages as $image)
                        <img src="{{ \App\Utilities\Asset::getFromStorage($image->image_path) }}" loading="lazy"
                            alt="{{ $product->name }}" class="object-cover object-center w-full h-full" />
                    @endforeach
                </div>
            </div>
            <!-- images - end -->

            <!-- content - start -->
            <div class="md:flex md:items-center md:justify-center">
                <div>
                    <!-- name - start -->
                    <div class="mb-2 md:mb-3">
                        <h2 class="text-2xl font-bold text-gray-800 lg:text-3xl">
                            {{ $product->name }}
                        </h2>
                    </div>
                    <!-- name - end -->

                    <!-- stock quantity - start -->
                    <div class="mb-5 md:mb-8">
                        <span class="inline-block text-sm font-normal text-gray-500 md:text-base">Stocks:
                            {{ $product->stock }}
                        </span>
                    </div>
                    <!-- stock quantity - end -->

                    <!-- price - start -->
                    <div class="mb-4">
                        <div class="flex items-end gap-2">
                            <span class="text-xl font-bold text-gray-800 md:text-2xl">
                                {{ $product->formatted_price }}
                            </span>
                        </div>
                        <span class="text-sm text-gray-500">*Shipping cost may vary</span>
                    </div>
                    <!-- price - end -->

                    <!-- buttons - start -->
                    <div class="flex gap-2.5">
                        <!-- <a
                                class="flex-1 inline-block px-8 py-3 text-sm font-semibold text-center text-white transition duration-100 bg-blue-500 rounded-lg outline-none btn ring-blue-300 hover:bg-blue-600 focus-visible:ring active:bg-indigo-700 sm:flex-none md:text-base">Add
                                to cart</a> -->
                    </div>
                    <!-- buttons - end -->
                </div>
            </div>
        </div>
        <!-- description - start -->
        <div class="mt-5 md:mt-8 lg:mt-10">
            <div class="mb-3 text-lg font-semibold text-gray-800">Description</div>
            <p class="text-gray-500">
                {{ $product->description }}
            </p>
        </div>
        <!-- description - end -->
    </div>
</div>