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
    <select {{ $attributes->merge(['class' => 'form-select']) }} id="{{ $name }}"
        @if ($isNeedValidation) required @endif name="{{ $name }}">
        {{ $slot }}
    </select>
</div>
