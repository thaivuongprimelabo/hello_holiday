<div class="form-group">
    <label for="exampleInputEmail1">{{ $label }}</label>
    <select class="form-control select2" name="category_id">
        <option value="">---</option>
        @foreach($options as $option)
        <option value="{{ $option->id }}" {{ $item->$name === $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
        @endforeach
    </select>
    @error($name)<span class="text-danger">{{ $message }}</span>@enderror
</div>