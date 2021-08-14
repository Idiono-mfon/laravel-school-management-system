@props(['resource', 'hasModal', 'link','title'=> false])

<div class="table-header-menu">
    <div class="header-text">
      {{ $title ? ucwords($title) :  "Manage School ".Str::ucfirst($resource)."s"}}
    </div>
    <div class="headerBtn">
        @if ($hasModal)
            <button data-toggle="modal" data-target="#{{ $resource }}Modal" class="btn btn-primary btn-sm">Add New {{ $resource }} <i class="fa fa-plus"></i></button>
        @else
            <a href="{{ $link ?? '' }}" class="btn btn-primary btn-sm">Add New {{ $resource }}</a>
        @endif

    </div>
</div>
