@extends('layouts.app')


@section('content')

<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <x-table-header :hasModal="true" :resource="'subject'"/>

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6 table-responsive">
                <table class="multi-table table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Subject Name</th>
                            <th>Date Created</th>
                            <th colspan="2" class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $subject)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subject->subject_name }}</td>
                                <td>{{ $subject->created_at->toRfc7231String() }}</td>
                               <x-action-component :deleteRoute="test" :editRoute="test"/>
                            </tr>
                        @empty
                           <x-no-record :size="5" :resource="'Subject'"/>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th> Subject Name</th>
                            <th>Date Created</th>
                            <th colspan="2" class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

</div>

<!-- Registration Modal -->
<div class="modal  fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="sessionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModal">Add A New Subject</h5>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('subjects') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="form-group mb-4">
                            <label for="class-name">Subject</label>
                              <input type="text"
                                class="form-control" name="subject_name" id="class-name" aria-describedby="helpId" placeholder="Subject Name">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
