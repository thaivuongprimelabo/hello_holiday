<div class="form-group">
    <label for="exampleInputEmail1">{{ $label }}</label>
    <textarea 
        class="form-control" 
        id="field_{{ $name }}" 
        name="{{ $name }}" r
        ows="{{ isset($rows) ? $rows : 6 }}" 
        placeholder="{{ $label }}" 
        {{ isset($disabled) ? 'disabled' : ''}}>{{ old($name, $item->$name) }}</textarea>
    @error($name)<span class="text-danger">{{ $message }}</span>@enderror
</div>