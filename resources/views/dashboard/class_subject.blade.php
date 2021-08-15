@extends('layouts.app')


@section('content')

<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <x-table-header :modalId="'classSubject'" :customMsg="Assign Subject To Class" :hasModal="true" :resource="'class subject'"/>

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6 table-responsive">
                <table class="multi-table table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Date Assigned</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($class_subjects as $subject)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subject->class }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $term->created_at->toRfc7231String() }}</td>
                               <x-action-component :deleteRoute="'test'" :id="$subject->id" />
                            </tr>
                        @empty
                           <x-no-record :size="6" :resource="'Term'"/>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Date Assigned</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

</div>

<!-- Registration Modal -->
<div class="modal  fade" id="classSubjectModal" tabindex="-1" role="dialog" aria-labelledby="sessionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModal">Assign Subject to Class</h5>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('class_subject') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="term">Select Subject</label>
                        <select  name="subject" class="form-control" id="subject">
                            @forelse ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @empty
                                <option>No subject is available</option>
                             @endforelse
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="termSession">Select class</label>
                        <select name="class" class="form-control" id="class">
                           @forelse ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                           @empty
                                <option>No class is available</option>
                           @endforelse
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Assign Subject</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
