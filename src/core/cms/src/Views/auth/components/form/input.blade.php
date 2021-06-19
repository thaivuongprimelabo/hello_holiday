<div class="form-group">
    <label for="exampleInputEmail1">{{ $label }}</label>
    <input 
        type="{{ isset($type) ? $type : 'text' }}" 
        class="form-control form-control-sm" id="field_{{ $name }}" 
        name="{{ $name }}" 
        {{ isset($disabled) && $disabled ? 'disabled' : ''}} 
        value="{{ old($name, optional($item ?? '')->$name) }}" 
        placeholder="{{ $label }}"
    />
    @error($name)<span class="text-danger">{{ $message }}</span>@enderror
</div>