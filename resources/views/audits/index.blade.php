@extends('layouts.tabler.app')
@section('content')
    <div class="page-header d-print-none mb-4">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Audits Trail</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <table class="table table-sm table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Event</th>
                            <th>Entity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($audits as $audit)
                            <tr class="py-0">
                                <td class="py-0">{{$audit->created_at}}</td>
                                <td class="py-0">{{$audit->user_name}}</td>
                                <td class="py-0">{{$audit->event}}</td>
                                <td class="py-0">{{\Illuminate\Support\Str::of($audit->auditable_type)->afterLast('\\')}}</td>
                                <td>
                                    @include('audits._log_viewer_modal')
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#log-viwer-modal-{{ $audit->id }}">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection