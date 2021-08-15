@extends('layouts.app')


@section('content')

<div class="layout-px-spacing">

    <div class="row layout-top-spacing">
        {{ $link = session("edit_modal") ? 'class_arm.create': null}}
        {{ $hasModal = session("edit_modal") ? false: true  }}

        <x-table-header
            :title="'Manage Class Arms'"
            :modalId="'classArm'"
            :link="$link"
            :hasModal="$hasModal"
            :resource="'Class Arm'"/>

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6 table-responsive">
                <table class="multi-table table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Arm Name</th>
                            <th>Date Created</th>
                            <th colspan="2" class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($arms as $arm)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $arm->arm_name }}</td>
                                <td>{{ $arm->created_at->toRfc7231String() }}</td>
                               <x-action-component :id="$arm->id" :deleteRoute="'class_arm.delete'" :editRoute="'class_arm.edit'"/>
                            </tr>
                        @empty
                           <x-no-record :size="5" :resource="'Class Arm'"/>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Arm Name</th>
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
<div class="modal  fade" id="classArmModal" tabindex="-1" role="dialog" aria-labelledby="sessionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModal">{{ session("edit_modal") ? "Edit Class Arm" : "Add A Class Arm" }}</h5>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ session("edit_modal") ? route('class_arm.update', $class_arm->id ?? 0) : route('class_arm') }}">
                    @csrf

                    @if (session("edit_modal"))
                        @method("PATCH")
                    @endif

                    <div class="form-group mb-4">
                        <label for="class-name">Class Arm</label>
                          <input type="text"
                            class="form-control" value="{{ isset($class_arm) ? $class_arm->arm_name : "" }}" name="arm_name" id="class-name" aria-describedby="helpId" placeholder="Class Arm Name">
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
