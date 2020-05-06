@extends('concept.layouts.master', ['currentRoute' => 'passengers'])

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
                <h2 class="pageheader-title">
                    Passengers
                    <a href="{{ route('passengers.create') }}" class="btn btn-xs btn-outline-success">
                        <i class="fas fa-plus"></i>
                    </a>
                </h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Passengers</li>
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
                                    <th>Name</th>
                                    <th>Badge</th>
                                    <th>Company</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Language</th>
                                    <th>Created At</th>
                                    <th style="min-width:60px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($passengers as $passenger)
                                    <tr>
                                        <td>{{$passenger->name}}</td>
                                        <td>{{$passenger->badge_number}}</td>
                                        <td>{{$passenger->company->name}}</td>
                                        <td>{{$passenger->phone}}</td>
                                        <td>{{$passenger->email}}</td>
                                        <td>{{$passenger->lang}}</td>
                                        <td>{{$passenger->created_at}}</td>
                                        <td>
                                            <a href="{{ route('passengers.edit', ['passenger' => $passenger->id]) }}" type="button" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="event.preventDefault();document.getElementById('delete-form-{{$passenger->id}}').submit();" type="button" class="btn btn-xs btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                            <form id="delete-form-{{$passenger->id}}" action="{{ route('passengers.destroy', ['passenger' => $passenger->id]) }}" method="POST" style="display: none;">
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