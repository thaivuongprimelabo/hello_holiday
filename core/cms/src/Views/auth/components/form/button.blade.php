<button type="{{ $type ?? 'submit' }}" id="{{ $name ?? '' }}" style="{{ isset($style) ? $style : '' }}" class="{{ isset($class) ? $class : 'btn btn-sm btn-primary' }}">
    <i class="{{ $icon ?? '' }}"></i>
    {{ $label ?? '' }}
</a>