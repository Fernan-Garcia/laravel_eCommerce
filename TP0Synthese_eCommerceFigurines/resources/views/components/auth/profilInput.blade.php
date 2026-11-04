@props(['type', 'name', 'label', 'id' => null])
<div class="col-12">
    <label class="form-label h6 text-uppercase small fw-semibold mb-1">
        {{ $label }}
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
        class="form-control form-control-lg" value="{{ auth('client')->user()->$name }}" required>
</div>
