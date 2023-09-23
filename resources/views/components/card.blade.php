<div {{ $attributes->merge(['class' => 'card mb-4', 'style' => '']) }}>
    @if ($image != '')
        <img src="{{ $image }}" class="card-img-top" alt="...">
    @endif
    <div class="card-body">
        @if ($title != '')
            <h5 class="card-title" style="margin-bottom: 16px">{{ $title }}</h5>
        @endif
        {{ $slot }}
    </div>
</div>
