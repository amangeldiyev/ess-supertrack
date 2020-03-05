@extends('concept.layouts.master', ['currentRoute' => 'taxi-requests'])

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/datatable.css') }}">
@endpush

@section('content')
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">
                    Taxi Requests
                    <a href="{{ route('taxi-requests.create') }}" class="btn btn-xs btn-outline-success">
                        <i class="fas fa-plus"></i>
                    </a>
                </h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Taxi Requests</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->

    <div class="row">
        <!-- ============================================================== -->
        <!-- data table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-sm table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Veh Type</th>
                                    <th>Vehicle</th>
                                    <th>Status</th>
                                    <th>Driver</th>
                                    <th>Start Time</th>
                                    <th>On Location</th>
                                    <th>Client</th>
                                    <th>Passenger</th>
                                    <th>Phone</th>
                                    <th>On Board</th>
                                    <th>Dropped Time</th>
                                    <th>Trip Type</th>
                                    <th>Remaining Time</th>
                                    <th style="min-width:65px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxiRequests as $request)
                                    <tr onclick="toggleModal({{$request->id}})" class="{{$request->status ? '' : 'table-danger'}}">
                                        <td>{{$request->id}}</td>
                                        <td>{{$request->vehicle->type}}</td>
                                        <td>{{$request->vehicle->name}}</td>
                                        <td>{{\App\TaxiRequest::STATUSES[$request->status]}}</td>
                                        <td>{{$request->driver->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($request->start_date)->format('H:i')}}</td>
                                        <td>{{$request->on_location_time}}</td>
                                        <td>{{$request->client->name}}</td>
                                        <td>{{$request->passenger}}</td>
                                        <td>{{$request->phone}}</td>
                                        <td>{{$request->pick_up_time}}</td>
                                        <td>{{$request->drop_off_time}}</td>
                                        <td>{{\App\TaxiRequest::TYPES[$request->type]}}</td>
                                        <td>{{$request->remaining_time}}</td>
                                        <td>
                                            <a onclick="event.stopPropagation()" href="{{ route('taxi-requests.edit', ['taxi_request' => $request->id]) }}" type="button" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="event.preventDefault();document.getElementById('delete-form-{{$request->id}}').submit();" type="button" class="btn btn-xs btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                            <form id="delete-form-{{$request->id}}" action="{{ route('taxi-requests.destroy', ['taxi_request' => $request->id]) }}" method="POST" style="display: none;">
                                                @method("DELETE")
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end data table  -->
        <!-- ============================================================== -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width:70%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">New Taxi Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('concept.taxi-request._form')
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables/js/data-table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('/js/modal-form.js') }}"></script>
@endpush