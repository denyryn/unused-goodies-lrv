@php
    use \App\Utilities\Asset;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="bg-theme">
        <div class="p-3">
            <div class="grid grid-cols-1 gap-4 my-3 lg:grid-cols-4 lg:gap-8" id="categoryContainer">
                @foreach ($parentCategories as $category)
                    <a href="{{ route('product_page', ['categorySlug' => $category->slug]) }}" class="relative block group">
                        <div class="relative h-[200px] sm:h-[300px]">
                            <img src="{{ $category->default_image_path ? Asset::getFromStorage($category->default_image_path) : Asset::getFromAssets('Image/Default/default_no_picture.jpg') }}"
                                alt="{{ $category->name }}"
                                class="absolute inset-0 object-cover w-full h-full duration-150 opacity-100 group-hover:opacity-0 brightness-50">
                            <img src="{{ $category->image_hover_path ? Asset::getFromStorage($category->image_hover_path) : Asset::getFromAssets('Image/Default/default_no_picture.jpg') }}"
                                alt="{{ $category->name }}"
                                class="absolute inset-0 object-cover w-full h-full duration-150 opacity-0 group-hover:opacity-100 brightness-50">
                        </div>
                        <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
                            <h3 class="text-xl font-medium text-white">{{ $category->name }}</h3>
                            <p class="mt-1.5 max-w-[40ch] text-xs text-white">
                                {{ $category->description }}
                            </p>
                            <span
                                class="inline-block px-5 py-3 mt-3 text-xs font-medium tracking-wide text-white uppercase bg-black">Shop
                                Now</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>