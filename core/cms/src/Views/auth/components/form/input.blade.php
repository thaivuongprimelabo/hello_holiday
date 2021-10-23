<div class="form-group">
    <label for="exampleInputEmail1">
        {{ $label }}
        @if(isset($maxlength))
        (Tối đa {{ $maxlength }} ký tư)
        @endif
    </label>
    <input 
        type="{{ isset($type) ? $type : 'text' }}" 
        class="form-control form-control-sm" id="field_{{ $name }}" 
        name="{{ $name }}" 
        {{ isset($disabled) && $disabled ? 'disabled' : ''}} 
        value="{{ old($name, optional($item ?? '')->$name) }}" 
        placeholder="{{ $label }}"
        {{ isset($maxlength) ? 'maxlength=' . $maxlength : '' }}
        {{ isset($min) ? 'min=' . $min : ''}}
        {{ isset($max) ? 'max=' . $max : ''}}
    />
    @error($name)<span class="text-danger">{{ $message }}</span>@enderror
</div>