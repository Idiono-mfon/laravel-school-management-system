@props(['resource', 'hasModal', 'customMsg', 'link','title'=> null, "modalId"])

<div class="table-header-menu">
    <div class="header-text">
      {{ $title ? ucwords($title) :  "Manage School ".Str::ucfirst($resource)."s"}}
    </div>
    <div class="headerBtn">
        @if ($hasModal)
            <button data-toggle="modal" data-target="#{{ $modalId ?? $resource }}Modal" class="btn btn-primary btn-sm"> {{ $customMsg ?? "Add New $resource" }} <i class="fa fa-plus"></i></button>
        @else
            <a href="{{ route($link) ?? '' }}" class="btn btn-primary btn-sm">{{ $customMsg ?? "Add New $resource" }}</a>
        @endif

    </div>
</div>
