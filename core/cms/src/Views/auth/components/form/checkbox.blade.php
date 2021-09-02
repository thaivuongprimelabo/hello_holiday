<div class="form-group clearfix">
    <div class="icheck-primary d-inline">
        <input type="checkbox" id="field_{{ $name }}" 
            {{ (old($name, $item->$name) == $checked) || (!$item->exists && $checked) ? 'checked' : '' }}
            name="{{ $name }}"
        >
        <label for="field_{{ $name }}">{{ $label }}</label>
    </div>
</div>