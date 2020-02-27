@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <form action="/passengers" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Company Name</label>
                    <input name="name" type="text" class="form-control">
                </div>
                
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