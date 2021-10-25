<div class="form-group">
    <label>{{ $label }}</label>
    <select class="select2" name="{{ $name }}" multiple="multiple" data-placeholder="{{ isset($placeholder) ? $placeholder : $label }}" style="width: 100%;">
        @foreach($options as $option)
        <option value="{{ $option['id'] }}" {{ in_array($option['id'], $item) ? 'selected' : ''  }}>{{ $option['name'] }}</option>
        @endforeach
    </select>
</div>