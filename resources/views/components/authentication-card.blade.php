<div class="hero bg-base-200 min-h-screen lg:px-24">
    <div class="hero-content flex-col lg:flex-row-reverse max-w-6xl">
        @if(isset($quote))
            <div class="ml-10 text-center lg:text-left">
                {{ $quote }}
            </div>
        @endif
        <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
            {{ $slot }}
        </div>
    </div>
</div>