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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                        
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Company Name</label>
                                <input name="name" type="text" value="{{isset($company) ? $company->name : ''}}" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <h3>Message Templates</h3>
                        <p>Use <span class="text-secondary">[id]</span>, <span class="text-secondary">[start_date]</span>, <span class="text-secondary">[driver]</span>, <span class="text-secondary">[vehicle]</span>, <span class="text-secondary">[type]</span> as placeholder.</p>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Request Confirm</label>
                                <textarea name="confirm_sms_template[eng]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->confirm_sms_template) ? $company->confirm_sms_template['eng'] : ''}}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Request Confirm(RU)</label>
                                <textarea name="confirm_sms_template[ru]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->confirm_sms_template) ? $company->confirm_sms_template['ru'] : ''}}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Request Confirm(KZ)</label>
                                <textarea name="confirm_sms_template[kz]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->confirm_sms_template) ? $company->confirm_sms_template['kz'] : ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Assigned</label>
                                <textarea name="assign_sms_template[eng]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->assign_sms_template) ? $company->assign_sms_template['eng'] : ''}}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Assigned(RU)</label>
                                <textarea name="assign_sms_template[ru]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->assign_sms_template) ? $company->assign_sms_template['ru'] : ''}}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Assigned(KZ)</label>
                                <textarea name="assign_sms_template[kz]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->assign_sms_template) ? $company->assign_sms_template['kz'] : ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Cancelled</label>
                                <textarea name="cancel_sms_template[eng]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->cancel_sms_template) ? $company->cancel_sms_template['eng'] : ''}}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Cancelled(RU)</label>
                                <textarea name="cancel_sms_template[ru]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->cancel_sms_template) ? $company->cancel_sms_template['ru'] : ''}}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Cancelled(KZ)</label>
                                <textarea name="cancel_sms_template[kz]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->cancel_sms_template) ? $company->cancel_sms_template['kz'] : ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>On Location</label>
                                <textarea name="on_location_sms_template[eng]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->on_location_sms_template) ? $company->on_location_sms_template['eng'] : ''}}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>On Location(RU)</label>
                                <textarea name="on_location_sms_template[ru]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->on_location_sms_template) ? $company->on_location_sms_template['ru'] : ''}}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>On Location(KZ)</label>
                                <textarea name="on_location_sms_template[kz]" cols="20" rows="3" class="form-control">{{isset($company) && !empty($company->on_location_sms_template) ? $company->on_location_sms_template['kz'] : ''}}</textarea>
                            </div>
                        </div>
                            
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection