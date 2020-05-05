@extends('concept.layouts.master', ['currentRoute' => 'companies'])

@section('content')
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Companies</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('companies.index') }}" class="breadcrumb-link">Companies</a></li>
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
                <h3 class="section-title">Company Form</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{isset($company) ? route('companies.update', ['company'=>$company]) : route('companies.store') }}" method="POST">
            
                        @if (isset($company))
                            @method('PUT')
                        @endif
                        
                        @csrf
                        
                        <div class="form-group">
                            <label>Company Name</label>
                            <input name="name" type="text" value="{{isset($company) ? $company->name : ''}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Request Confirm SMS Template</label>
                            <textarea name="confirm_sms_template" cols="20" rows="3" class="form-control">{{isset($company) ? $company->confirm_sms_template : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Request Assign SMS Template</label>
                            <textarea name="assign_sms_template" cols="20" rows="3" class="form-control">{{isset($company) ? $company->assign_sms_template : ''}}</textarea>
                        </div>
                            
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection