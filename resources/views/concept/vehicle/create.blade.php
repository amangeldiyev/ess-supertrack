@extends('concept.layouts.master', ['currentRoute' => 'vehicles'])

@section('content')
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Vehicles</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vehicles.index') }}" class="breadcrumb-link">Vehicles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
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
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-4">
            <div class="section-block" id="basicform">
                <h3 class="section-title">Taxi Request Form</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{isset($vehicle) ? route('vehicles.update', ['vehicle'=>$vehicle]) : route('vehicles.store') }}" method="POST">
            
                        @if (isset($vehicle))
                            @method('PUT')
                        @endif
                        
                        @csrf
                        
                        <div class="form-group">
                            <label>Vehicle Name</label>
                            <input name="name" type="text" value="{{isset($vehicle) ? $vehicle->name : ''}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Vehicle Type</label>
                            <input value="{{isset($vehicle) ? $vehicle->type : ''}}" name="type" class="form-control" list="vehicle-types" autocomplete="off">
                            <datalist id="vehicle-types">
                                @foreach (\App\Vehicle::all()->pluck('type') as $type)
                                <option value="{{$type}}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control" name="company_id">
                                @foreach (\App\Company::all() as $company)
                                <option value="{{$company->id}}" {{isset($vehicle) && $company->company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                            
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection