<div {{ $attributes->merge(['class' => 'card mb-3', 'style' => 'border-left: 4px solid #101010']) }}>
    <div class="card-body row">
        <div class="col mr-2">
            <h3 class="card-title" style="margin-bottom: 8px"><b>{{ $count }}</b></h3>
        </div>
        @if ($image != '')
            <img style="width:64px" src="{{ $image }}" />
        @elseif ($icon != '')
            <div class="col-auto">
                <i class="fas {{ $icon }} text-gray-300 "></i>
            </div>
        @endif
        <h6>{{ $title }}</h6>
        @if ($target != '')
            <a href="{{ $target }}" class="card-link">Lihat Detail</a>
        @endif

    </div>
</div>
