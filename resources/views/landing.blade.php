<x-app-layout>
    <section id="home">
        <div class="min-h-screen hero" style="background-image: url('{{ asset('assets/Image/old_camera.jpg') }}');">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="text-center hero-content text-neutral-content">
                <div class="max-w-md text-theme">
                    <h1 class="mb-5 text-5xl font-bold">
                        Hello {{ $userFirstName ?? _('There') }}
                    </h1>
                    <p class="mb-5">Welcome to our website, Unused Goodies. We sells many of things that worth your
                        penny. Lets
                        start by Logging you in, or Register a new account if you dont have one.</p>
                    <a href="" class="btn btn-outline text-theme">Get Started</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>