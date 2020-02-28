@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <p>Company: {{$company->name}}</p>
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