@extends('layouts.app')


@section('content')

<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <x-table-header :hasModal="true" :resource="'term'"/>

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6 table-responsive">
                <table class="multi-table table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Term</th>
                            <th>Session</th>
                            <th>Date Created</th>
                            <th class="text-center  dt-no-sorting">Term Status</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($terms as $term)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Str::substr($term->term_name, 0, 1) }} <sup>{{Str::substr($term->term_name, 1, 2) }}</sup></td>
                                <td>
                                    @if ($term->session->is_active === 1)
                                        <span data-placement="top" title="Active session" class="badge badge-success bs-tooltip">{{ $term->session->session_name }}</span>
                                    @else
                                        {{ $term->session->session_name }}
                                    @endif
                                </td>
                                <td>{{ $term->created_at->toRfc7231String() }}</td>
                               <x-status-component :id="$term->id" :route="'term.update'" :status="$term->is_active"/>
                            </tr>
                        @empty
                           <x-no-record :size="6" :resource="'Term'"/>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Term</th>
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
<div class="modal  fade" id="termModal" tabindex="-1" role="dialog" aria-labelledby="sessionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModal">Add A New Term</h5>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('term') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="term">Select Term</label>
                        <select  name="term" class="form-control" name="" id="termSession">
                            <option value="1st">1<sup>st</sup></option>
                            <option value="2nd">2<sup>nd</sup></option>
                            <option value="3rd">3<sup>rd</sup></option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="termSession">Select Session</label>
                        <select name="session" class="form-control" id="termSession">
                           @forelse ($schoolSessions as $session)
                                <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                           @empty
                                <option>No session is availble</option>
                           @endforelse
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
