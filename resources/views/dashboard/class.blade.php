@extends('layouts.app')

@php
    $link = session("edit_modal") ? 'classes.create': null;
    $hasModal = session("edit_modal") ? false: true;
@endphp


@section('content')

<div class="layout-px-spacing">

    <div class="row layout-top-spacing">
        <x-table-header
            :title="'Manage All Classes'"
            :modalId="'classes'"
            :link="$link"
            :hasModal="$hasModal"
            :resource="'Class'"/>

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6 table-responsive">
                <table class="multi-table table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Class Name</th>
                            <th>Class Arm</th>
                            <th>Date Created</th>
                            <th colspan="2" class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($classes as $class)
                            <tr>
                                <td>{{ $class->iteration }}</td>
                                <td>{{ $class->class_name }}</td>
                                <td>{{ $class->class_arm }}</td>
                                <td>{{ $class->created_at->toRfc7231String() }}</td>
                               <x-action-component :id="$class->id" :deleteRoute="'classes.delete'" :editRoute="'classes.edit'"/>
                            </tr>
                        @empty
                           <x-no-record :size="6" :resource="'Class'"/>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Class Name</th>
                            <th>Class Arm</th>
                            <th>Date Created</th>
                            <th colspan="2" class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

</div>

<!-- Class Arm Modal -->
<div class="modal  fade" id="classes" tabindex="-1" role="dialog" aria-labelledby="classModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="classModal">{{ session("edit_modal") ? "Edit Class" : "Register A New Class" }}</h5>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ session("edit_modal") ? route('classes.update', $class->id ?? 0) : route('classes') }}">
                    @csrf

                    @if (session("edit_modal"))
                        @method("PATCH")
                    @endif

                    <div class="form-group mb-4">
                        <label for="class-name">Class Name</label>
                        <input type="text"
                        class="form-control" value="{{ isset($class) ? $class->class_name : "" }}" name="class_name" id="class-name" aria-describedby="helpId" placeholder="Class Name"/>
                    </div>

                    <div class="form-group mb-4">
                      <label for="">Select Class Arm</label>
                      <select class="form-control" name="class_arm" id="">
                        @if (session("edit_modal"))
                            @foreach ($arms as $arm )
                                <option value="{{ $arm->id }}">{{ $arm->arm_name }}</option>
                            @endforeach
                        @else
                            @foreach ($arms as $arm )
                                <option {{ $arm->id === $class->class_arm_id ? 'selected':"" }} value="{{ $arm->id }}">{{ $arm->arm_name }}</option>
                            @endforeach
                        @endif
                      </select>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                        <button  class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('pageScripts')
        <script>
             @if (session("edit_modal") || session("create_modal"))
                $("#classArmModal").modal("show");
            @endif
        </script>
@endsection
