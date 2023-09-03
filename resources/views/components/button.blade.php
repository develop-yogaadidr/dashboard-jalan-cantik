<button {{ $attributes->merge(['class' => 'btn btn-' . $color]) }}
    type="{{ $type }}">{{ $slot }}</button>
