@props(['label', 'name', 'type' => 'text', 'id' => null])
<div class="mb-3">
    @error($name)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erreur</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
    <label for="{{ $id ?? $name }}" class="form-label small">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $id ?? $name }}" class="form-control" name="{{ $name }}"
        value="{{ old($name) }}">
</div>
