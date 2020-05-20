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
                            <input name="name" type="text" value="{{isset($passenger) ? $passenger->name : ''}}" class="form-control @error('name') is-invalid @enderror" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Badge Number</label>
                            <input name="badge_number" type="text" value="{{isset($passenger) ? $passenger->badge_number : ''}}" class="form-control @error('badge_number') is-invalid @enderror" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('badge_number') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input name="phone" type="text" value="{{isset($passenger) ? $passenger->phone : ''}}" class="form-control @error('phone') is-invalid @enderror">
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="email" value="{{isset($passenger) ? $passenger->email : ''}}" class="form-control @error('email') is-invalid @enderror">
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Language</label>
                            <select class="form-control" name="lang">
                                <option value="0" {{isset($passenger) && $passenger->lang == 'eng' ? 'selected' : ''}}>English</option>
                                <option value="1" {{isset($passenger) && $passenger->lang == 'kz' ? 'selected' : ''}}>Kazakh</option>
                                <option value="2" {{isset($passenger) && $passenger->lang == 'ru' ? 'selected' : ''}}>Russian</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="sms_notification" value="1" {{isset($passenger) && $passenger->sms_notification == 1 ? "checked" : ""}} class="custom-control-input">
                                <span class="custom-control-label">SMS notification</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="email_notification" value="1" {{isset($passenger) && $passenger->email_notification == 0 ? "" : "checked"}} class="custom-control-input">
                                <span class="custom-control-label">Email notification</span>
                            </label>
                        </div>
                        @if (auth()->user()->company_id === 0)
                            <div class="form-group">
                                <label>Company</label>
                                <select class="form-control" name="company_id">
                                    @foreach (\App\Company::all() as $company)
                                    <option value="{{$company->id}}" {{isset($passenger) && $passenger->company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
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