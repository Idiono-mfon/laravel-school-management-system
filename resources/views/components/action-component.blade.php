@props(['editRoute', 'id', "deleteRoute", "toggleRoute"=> false, "toogleVal"=>1])

@if ($editRoute)
    <td class="text-center">
        <a href="{{ route($editRoute, $id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i>Edit</a>
    </td>
@endif

@if ($deleteRoute)
    <td>
        <form action="{{ route($deleteRoute, $id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-delete"></i>Delete</button>
        </form>
    </td>
@endif


@if ($toggleRoute)
    <td>
        <form action="{{ route($toggleRoute, $id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">{{ $toggleVal === 1 ? "Unassign": "Assign" }}</button>
        </form>
    </td>

@endif
