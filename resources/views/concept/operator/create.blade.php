@extends('concept.layouts.master', ['currentRoute' => 'users'])

@section('content')
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Users</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="breadcrumb-link">Users</a></li>
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
                <h3 class="section-title">User Form</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{isset($user) ? route('users.update', ['user'=>$user]) : route('users.store') }}" method="POST">
            
                        @if (isset($user))
                            @method('PUT')
                        @endif
                        
                        @csrf
                        
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" required value="{{isset($user) ? $user->name : ''}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" type="text" required value="{{isset($user) ? $user->username : ''}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="email" required value="{{isset($user) ? $user->email : ''}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" autocomplete="off" class="form-control" {{isset($user) ? '' : 'required'}}>
                        </div>

                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control" name="company_id">
                                <option value="0">Admin</option>
                                @foreach (\App\Company::all() as $company)
                                <option value="{{$company->id}}" {{isset($user) && $user->company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
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