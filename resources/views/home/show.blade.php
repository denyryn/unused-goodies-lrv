<x-app-layout>
    <section id="home">
        <div class="min-h-screen hero" style="background-image: url('{{ asset('assets/Image/old_camera.jpg') }}');">
            <div class="hero-overlay bg-opacity-60 backdrop-blur-md"></div>
            <div class="text-center hero-content text-neutral-content">
                <div class="max-w-md text-theme">
                    <h1 class="mb-5 text-5xl font-bold">
                        Hello {{ $userFirstName ?? _('There') }}
                    </h1>
                    <p class="mb-5">Welcome to our website, Unused Goodies. We sell many things that are worth your
                        penny. Let's
                        start by logging you in, or register a new account if you don't have one.</p>
                    <a href="{{ route(\App\Utilities\Permission::isLoggedIn() ? 'product_page' : 'login') }}"
                        class="btn btn-outline text-theme">Get Started</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
