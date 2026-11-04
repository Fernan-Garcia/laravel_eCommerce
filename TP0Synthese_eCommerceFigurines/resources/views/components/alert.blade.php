@props(['champ', 'type' => 'success'])

@if (session($champ))
    <div @class([
        'alert alert-dismissible fade show',
        'alert-danger' => $type == 'error',
        'alert-success' => $type == 'success',
    ]) role="alert">
        <strong>{{ ucfirst($type) }}</strong> {{ session($champ) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
