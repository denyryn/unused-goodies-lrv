<div 
    x-data="{ 
        activeIndex: 0, 
        imageCount: {{ count($images) }},
        autoplay: true,
        autoplaySpeed: 10000,
        touchStartX: 0,
        touchEndX: 0,
        zoom: false,
        zoomX: 0,
        zoomY: 0,
        init() {
            if (this.autoplay) this.startAutoplay();
            this.$watch('activeIndex', () => {
                if (this.autoplay) this.resetAutoplay();
            });
        },
        startAutoplay() {
            this.autoplayInterval = setInterval(() => {
                this.next();
            }, this.autoplaySpeed);
        },
        resetAutoplay() {
            clearInterval(this.autoplayInterval);
            this.startAutoplay();
        },
        pauseAutoplay() {
            clearInterval(this.autoplayInterval);
        },
        resumeAutoplay() {
            if (this.autoplay) this.startAutoplay();
        },
        next() {
            this.activeIndex = this.activeIndex < this.imageCount - 1 ? this.activeIndex + 1 : 0;
        },
        prev() {
            this.activeIndex = this.activeIndex > 0 ? this.activeIndex - 1 : this.imageCount - 1;
        },
        handleTouchStart(e) {
            this.touchStartX = e.changedTouches[0].screenX;
            this.pauseAutoplay();
        },
        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].screenX;
            const diffX = this.touchStartX - this.touchEndX;
            
            if (Math.abs(diffX) > 50) { // Minimum swipe distance
                if (diffX > 0) {
                    // Swiped left
                    this.next();
                } else {
                    // Swiped right
                    this.prev();
                }
            }
            
            this.resumeAutoplay();
        },
        updateZoom(e) {
            const rect = e.target.getBoundingClientRect();
            this.zoomX = ((e.clientX - rect.left) / rect.width) * 100;
            this.zoomY = ((e.clientY - rect.top) / rect.height) * 100;
        }
    }" 
    class="relative overflow-hidden bg-gray-100 rounded-md aspect-square"
    @touchstart="handleTouchStart"
    @touchend="handleTouchEnd"
    @mouseenter="pauseAutoplay"
    @mouseleave="resumeAutoplay">

    <!-- Image Slides -->
    <div class="relative w-full h-full">
        @foreach ($images as $index => $image)
            <div x-show="activeIndex === {{ $index }}" class="absolute inset-0 w-full h-full">
                <img 
                    src="{{ \App\Utilities\Asset::getFromStorage($image) }}" 
                    alt="Product Image" 
                    class="object-cover object-center w-full h-full transition-opacity duration-300"
                    @mousemove="zoom = true; updateZoom($event)"
                    @mouseleave="zoom = false"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" />
                
                <!-- Magnifier Lens -->
                <div 
                    x-show="zoom"
                    class="absolute w-32 h-32 bg-no-repeat border-2 border-white rounded-full pointer-events-none"
                    :style="{
                        left: `${zoomX - 16}%`,
                        top: `${zoomY - 16}%`,
                        backgroundImage: `url({{ \App\Utilities\Asset::getFromStorage($image) }})`,
                        backgroundSize: '750%',
                        backgroundPosition: `${zoomX}% ${zoomY}%`
                    }">
                </div>
            </div>
        @endforeach
    </div>

    <!-- Previous Button -->
    <button @click="prev(); pauseAutoplay();" 
        class="absolute size-10 left-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 p-2 rounded-full shadow-lg hover:bg-opacity-100 focus:outline-none"
        aria-label="Previous image">
        &#10094;
    </button>

    <!-- Next Button -->
    <button @click="next(); pauseAutoplay();" 
        class="absolute size-10 right-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 p-2 rounded-full shadow-lg hover:bg-opacity-100 focus:outline-none"
        aria-label="Next image">
        &#10095;
    </button>

    <!-- Indicators -->
    <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-2">
        @foreach ($images as $index => $image)
            <button @click="activeIndex = {{ $index }}; pauseAutoplay();" 
                :class="{'bg-white': activeIndex === {{ $index }}, 'bg-gray-400': activeIndex !== {{ $index }}}"
                class="w-3 h-3 rounded-full transition-colors duration-200 focus:outline-none"
                aria-label="Go to image {{ $index + 1 }}"></button>
        @endforeach
    </div>
</div>
