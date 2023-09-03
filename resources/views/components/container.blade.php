@props(['width' => 'auto', 'height' => 'auto', 'align' => 'start'])

@php
    $containerName = $size == '' ? 'container' : 'container-' . $size;
    $classname = $containerName . ' d-flex align-items-' . $align . ' justify-content-' . $align;
@endphp

<div {{ $attributes->merge(['class' => $classname]) }} style="height: {{ $height }}">
    {{ $slot }}
</div>
