<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-outline']) }}>
    {{ $slot }}
</button>