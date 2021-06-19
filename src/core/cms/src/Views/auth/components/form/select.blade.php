<div class="form-group">
    <label for="exampleInputEmail1">{{ $label }}</label>
    <select class="form-control form-control-sm" name="{{ $name }}" id="field_{{ $name }}" {{ isset($disabled) && $disabled ? 'disabled' : ''}}>
        <option value="">{{ isset($empty) ? $empty : '---' }}</option>
        @foreach($options as $option)
            @if(isset($option->id))
            <option value="{{ $option->id }}" {{ optional(($item ?? ''))->$name === $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
            @elseif(isset($option->matp))
            <option value="{{ $option->matp }}" {{ optional(($item ?? ''))->$name === $option->matp ? 'selected' : '' }}>{{ $option->name }}</option>
            @elseif(isset($option->maqh))
            <option value="{{ $option->maqh }}" {{ optional(($item ?? ''))->$name === $option->maqh ? 'selected' : '' }}>{{ $option->name }}</option>
            @elseif(isset($option->xaid))
            <option value="{{ $option->xaid }}" {{ optional(($item ?? ''))->$name === $option->xaid ? 'selected' : '' }}>{{ $option->name }}</option>
            @endif
        @endforeach
    </select>
    @error($name)<span class="text-danger">{{ $message }}</span>@enderror
</div>