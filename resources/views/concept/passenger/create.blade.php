@extends('concept.layouts.master', ['currentRoute' => 'passengers'])

@section('content')
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Passengers</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('passengers.index') }}" class="breadcrumb-link">Passengers</a></li>
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
                <h3 class="section-title">Passenger Form</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{isset($passenger) ? route('passengers.update', ['passenger'=>$passenger]) : route('passengers.store') }}" method="POST">
            
                        @if (isset($passenger))
                            @method('PUT')
                        @endif
                        
                        @csrf
                        
                        <div class="form-group">
                            <label>Passenger Name</label>
                            <input name="name" type="text" value="{{isset($passenger) ? $passenger->name : ''}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Badge Number</label>
                            <input name="badge_number" type="text" value="{{isset($passenger) ? $passenger->badge_number : ''}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input name="phone" type="text" value="{{isset($passenger) ? $passenger->phone : ''}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="email" value="{{isset($passenger) ? $passenger->email : ''}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control" name="company_id">
                                @foreach (\App\Company::all() as $company)
                                <option value="{{$company->id}}" {{isset($passenger) && $passenger->company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
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