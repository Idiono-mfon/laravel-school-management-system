@extends('layouts.app')


@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <x-table-header :hasModal="true" :resource="'session'"/>

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Session</th>
                                <th>Date Created</th>
                                <th class="text-center  dt-no-sorting">Session Status</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schoolSessions as $session)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $session->session_name }}</td>
                                    <td>{{ $session->created_at->toRfc7231String() }}</td>
                                    <x-status-component :id="$session->id" :route="'session.update'" :status="$session->is_active"/>
                                </tr>
                            @empty
                                <x-no-record :size="5" :resource="'Session'"/>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Session</th>
                                <th>Date Created</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- Registration Modal -->
    <div class="modal  fade" id="sessionModal" tabindex="-1" role="dialog" aria-labelledby="sessionModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sessionModal">Add A New Session</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('session') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <input type="text" name="session_name" class="form-control" id="session" placeholder="Session eg 2019/2020 *">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
