@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <form action="/vehicles" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Vehcile Number</label>
                <input name="name" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Vehcile Type</label>
                <input name="type" class="form-control" list="vehicle-types" autocomplete="off">
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