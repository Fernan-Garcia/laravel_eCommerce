@props(['label', 'name', 'id' => 'province'])

<div class="mb-3">
    @error('province')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erreur</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
    <label for="{{ $label }}" class="form-label small">{{ $label }}</label>
    <select id="{{ $id }}" class="form-control" name="{{ $name }}">
        <option value="">Sélectionnez une province</option>
        <option value="AB" {{ old('province') == 'AB' ? 'selected' : '' }}>AB</option>
        <option value="BC" {{ old('province') == 'BC' ? 'selected' : '' }}>BC</option>
        <option value="MB" {{ old('province') == 'MB' ? 'selected' : '' }}>MB</option>
        <option value="NB" {{ old('province') == 'NB' ? 'selected' : '' }}>NB</option>
        <option value="NL" {{ old('province') == 'NL' ? 'selected' : '' }}>NL</option>
        <option value="NS" {{ old('province') == 'NS' ? 'selected' : '' }}>NS</option>
        <option value="NT" {{ old('province') == 'NT' ? 'selected' : '' }}>NT</option>
        <option value="NU" {{ old('province') == 'NU' ? 'selected' : '' }}>NU</option>
        <option value="ON" {{ old('province') == 'ON' ? 'selected' : '' }}>ON</option>
        <option value="PE" {{ old('province') == 'PE' ? 'selected' : '' }}>PE</option>
        <option value="QC" {{ old('province') == 'QC' ? 'selected' : '' }}>QC</option>
        <option value="SK" {{ old('province') == 'SK' ? 'selected' : '' }}>SK</option>
        <option value="YT" {{ old('province') == 'YT' ? 'selected' : '' }}>YT</option>
    </select>
</div>
