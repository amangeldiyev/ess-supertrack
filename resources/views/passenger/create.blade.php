@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <form action="/passengers" method="POST">
            @csrf
            <div class="form-group">
                <label>Passenger Name</label>
                <input name="name" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Badge Number</label>
                <input name="badge_number" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input name="phone" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Company</label>
                <select class="form-control" name="company_id">
                    @foreach (\App\Company::all() as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
                
            <button type="submit" class="btn btn-primary">Save</button>      
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.onkeydown = function (e) {

            e = e || window.event;

            if (e.keyCode == 27) {
                window.close()
            }
        }
    </script>
@endpush