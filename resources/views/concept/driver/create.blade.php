@extends('concept.layouts.master', ['currentRoute' => 'drivers'])

@section('content')
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Drivers</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('drivers.index') }}" class="breadcrumb-link">Drivers</a></li>
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
                <h3 class="section-title">Driver Form</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{isset($driver) ? route('drivers.update', ['driver'=>$driver]) : route('drivers.store') }}" method="POST">
            
                        @if (isset($driver))
                            @method('PUT')
                        @endif
                        
                        @csrf
                        
                        <div class="form-group">
                            <label>Driver Name</label>
                            <input name="name" type="text" value="{{isset($driver) ? $driver->name : ''}}" class="form-control @error('name') is-invalid @enderror" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                        @if (auth()->user()->company_id === 0)
                            <div class="form-group">
                                <label>Company</label>
                                <select class="form-control" name="company_id">
                                    @foreach (\App\Company::all() as $company)
                                    <option value="{{$company->id}}" {{isset($driver) && $driver->company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                            
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection