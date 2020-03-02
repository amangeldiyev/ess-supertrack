@extends('concept.layouts.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
@endpush

@section('content')
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Taxi Requests</h2>
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
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Veh Type</th>
                                    <th>Vehicle</th>
                                    <th>Status</th>
                                    <th>Driver</th>
                                    <th>Start Time</th>
                                    <th>On Location</th>
                                    <th>Client Name</th>
                                    <th>Passenger</th>
                                    <th>Passenger Phone</th>
                                    <th>On Board</th>
                                    <th>Dropped Time</th>
                                    <th>Trip Type</th>
                                    <th>Remaining Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxiRequests as $request)
                                    <tr class="{{$request->status ? '' : 'table-danger'}}">
                                        <td>{{$request->vehicle->type}}</td>
                                        <td>{{$request->vehicle->name}}</td>
                                        <td>{{\App\TaxiRequest::STATUSES[$request->status]}}</td>
                                        <td>{{$request->driver->name}}</td>
                                        <td>{{$request->start_date}}</td>
                                        <td>{{$request->on_location_time}}</td>
                                        <td>{{$request->client->name}}</td>
                                        <td>{{$request->passenger}}</td>
                                        <td>{{$request->phone}}</td>
                                        <td>{{$request->pick_up_time}}</td>
                                        <td>{{$request->drop_off_time}}</td>
                                        <td>{{\App\TaxiRequest::TYPES[$request->type]}}</td>
                                        <td>{{$request->time_remaining}}</td>
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
@endpush