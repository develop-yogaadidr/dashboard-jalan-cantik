@aware(['needValidation' => 'false'])

@php
    $isNeedValidation = $needValidation == true && $required == true;
@endphp

<div class="form-group">
    @if ($label != '')
        <label class="form-label" for="{{ $name }}">{{ $label }}
            @if ($isNeedValidation)
                <span style="color:red">*</span>
            @endif
        </label><br>
    @endif
    <textarea {{ $attributes->merge(['class' => 'form-control']) }} id="{{ $name }}"
        @if ($isNeedValidation) required @endif name="{{ $name }}">{{ $slot }}</textarea>

    @if ($description != '')
        <small id="emailHelp" class="form-text text-muted">{{ $description }}</small>
    @endif

    <div class="invalid-feedback">
        Please provide a valid {{ $label }}.
    </div>
</div>
