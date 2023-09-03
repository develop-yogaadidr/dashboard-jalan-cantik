@aware(['needValidation' => 'false'])

@php
    $isNeedValidation = $needValidation == true && $required == true;
@endphp

<div class="col-md-12">
    @if ($label != '')
        <label class="form-label" for="{{ $name }}">{{ $label }}
            @if ($isNeedValidation)
                <span style="color:red">*</span>
            @endif
        </label><br>
    @endif
    <input {{ $attributes->merge(['class' => 'form-control']) }} type="{{ $type }}" id="{{ $name }}"
        @if ($value != '') value={{ $value }} @endif placeholder="{{ $label }}"
        @if ($isNeedValidation) required @endif name="{{ $name }}">
    <div class="invalid-feedback">
        Please provide a valid {{ $label }}.
    </div>
</div>
