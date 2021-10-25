@php
    $field = isset($field) && !is_null($field) ? $field : $name;
@endphp
<div class="form-group">
    <label for="exampleInputEmail1">{{ $label }}</label>
    <select class="select2" name="{{ $name }}" id="field_{{ $name }}" {{ isset($disabled) && $disabled ? 'disabled' : ''}}  style="width: 100%;">
        <option value="">{{ isset($empty) ? $empty : '---' }}</option>
        @foreach($options as $option)
            @if(isset($option->id))
            <option value="{{ $option->id }}" {{ optional(($item ?? ''))->$field === $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
            @elseif(isset($option->matp))
            <option value="{{ $option->matp }}" {{ optional(($item ?? ''))->$field === $option->matp ? 'selected' : '' }}>{{ $option->name }}</option>
            @elseif(isset($option->maqh))
            <option value="{{ $option->maqh }}" {{ optional(($item ?? ''))->$field === $option->maqh ? 'selected' : '' }}>{{ $option->name }}</option>
            @elseif(isset($option->xaid))
            <option value="{{ $option->xaid }}" {{ optional(($item ?? ''))->$field === $option->xaid ? 'selected' : '' }}>{{ $option->name }}</option>
            @endif
        @endforeach
    </select>
    @error($name)<span class="text-danger">{{ $message }}</span>@enderror
</div>