<x-app-layout>
    <div class="py-6 sm:py-8 lg:py-12">
        <div class="max-w-screen-lg px-4 mx-auto md:px-8">
            <div class="grid gap-8 md:grid-cols-2">

                <livewire:product-carousel :images="$images" />

                <!-- content - start -->
                <div class="md:flex md:items-center md:justify-center">
                    <div>
                        <!-- name - start -->
                        <div class="mb-2 md:mb-3">
                            <h2 class="text-2xl font-bold text-theme-invert lg:text-3xl">
                                {{ $product->name }}
                            </h2>
                        </div>
                        <!-- name - end -->

                        <!-- stock quantity - start -->
                        <div class="mb-5 md:mb-8">
                            <span
                                class="inline-block text-sm font-normal text-theme-invert-secondary md:text-base">Stocks:
                                {{ $product->formatted_stock }}
                            </span>
                        </div>
                        <!-- stock quantity - end -->

                        <!-- price - start -->
                        <div class="mb-4">
                            <div class="flex items-end gap-2">
                                <span class="text-xl font-bold text-theme-invert md:text-2xl">
                                    {{ $product->formatted_price }}
                                </span>
                            </div>
                            <span class="text-sm text-theme-invert-secondary">
                                *Shipping cost may vary
                            </span>
                        </div>
                        <!-- price - end -->

                        <!-- buttons - start -->
                        <div class="flex gap-2.5">
                            <livewire:cart.components.add-to-cart-button :product="$product" />
                        </div>
                        <!-- buttons - end -->
                    </div>
                </div>
            </div>
            <!-- description - start -->
            <div class="mt-5 md:mt-8 lg:mt-10">
                <div class="mb-3 text-lg font-semibold text-theme-invert">
                    Description
                </div>
                <div class="text-theme-invert-secondary">
                    {!! $product->description !!}
                </div>
            </div>
            <!-- description - end -->
        </div>
    </div>
</x-app-layout>