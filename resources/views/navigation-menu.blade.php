@php
    use \App\Utilities\Permission;
@endphp

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="navbar bg-base-100 text-theme-invert">
        <div class="navbar-start">
            <a href="{{ Permission::isAdmin() ? route('dashboard') : route('landing') }}"
                class="btn btn-ghost w-fit h-fit">
                <img class="flex items-center justify-center w-14" src="{{ asset('assets/Logo/logo.svg') }}"
                    alt="{{ config('app.name', 'Unused Goodies') }}">
            </a>
        </div>
        <div class="hidden navbar-center sm:flex ">
            <ul class="px-1 font-bold menu menu-horizontal font-rubik space-x-1">
                <li><a href="{{ Permission::isAdmin() ? route('dashboard') : route('landing') }}">Home</a></li>
                <li><a href="category_page.php">Categories</a></li>
                <li><a href="product_page.php">Products</a></li>
            </ul>
        </div>
        <div class="navbar-end space-x-1">
            <a class="flex bg-transparent border-none shadow-none outline-none btn">
                <img src="{{ asset('assets/Icons/cart.svg') }}" alt="Cart">
            </a>
            <div class="font-semibold dropdown dropdown-end font-rubik">
                <div tabindex="0" role="button" class=" btn btn-ghost sm:hidden">
                    <img src="{{ asset('assets/Icons/kebab.svg') }}" alt="Kebab">
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-fit">
                    <li><a href="main_page.php">Home</a></li>
                    <li><a href="category_page.php">Categories</a></li>
                    <li><a href="product_page.php">Products</a></li>
                </ul>
            </div>
            <a href="{{ route('profile.show') }}"
                class="hidden lg:flex bg-transparent border-none shadow-none outline-none btn">
                <img class="w-5 h-5" src="{{ asset('assets/Icons/user.svg') }}" alt="Login">
            </a>
        </div>
    </div>
</nav>