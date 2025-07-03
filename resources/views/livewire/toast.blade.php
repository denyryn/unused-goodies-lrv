<div x-data="{ show: @entangle('show').live }" 
     x-show="show" 
     x-init="window.addEventListener('toast-hide', event => setTimeout(() => show = false, event.detail.time))"
     class="absolute bottom-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800"
     x-transition.opacity.duration.500ms>
     
    <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 rounded-lg"
        :class="{
            'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200': '{{ $type }}' === 'danger',
            'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200': '{{ $type }}' === 'success',
            'text-yellow-500 bg-yellow-100 dark:bg-yellow-800 dark:text-yellow-200': '{{ $type }}' === 'warning',
            'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200': '{{ $type }}' === 'info'
        }">
        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
        </svg>
    </div>
    <div class="ms-3 text-sm font-normal">{{ $message }}</div>
    <button @click="show = false" type="button" 
        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        aria-label="Close">
        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>
