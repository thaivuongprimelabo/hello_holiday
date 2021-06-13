<div class="form-group">
    <label for="exampleInputEmail1">{{ $label }}</label>
    <textarea class="form-control {{ isset($small) ? 'ckeditor-small' : 'ckeditor-full' }}" id="field_{{ $name }}" name="{{ $name }}" placeholder="{{ $label }}">{{ old($name, $item->$name) }}</textarea>
    @error($name)<span class="text-danger">{{ $message }}</span>@enderror
</div>