
@props(['status', 'route', 'id'])

<td>
    <button type="button" class="btn {{ $status === 1 ? 'btn-success':'btn-danger' }}">
        {{ $status === 1 ? 'Active': 'Inactive' }}<span class="badge badge-light"></span>
    </button>
</td>
<td class="text-center">
    <form action="{{ route($route, $id) }}" method="post">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-primary btn-sm">{{ $status === 1 ? 'Disable':'Enable' }}</button>
    </form>
</td>

