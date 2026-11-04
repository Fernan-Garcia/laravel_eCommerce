@props(['name', 'type', 'label', 'figurine', 'class'])
<div class="{{ $class }}">
    <label class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control"
        value="{{ old($name, $figurine->$name) }}">
    @error($name)
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
