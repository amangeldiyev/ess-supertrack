@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <p>Passenger Name: {{$passenger->name}}</p>
        <p>Badge Number: {{$passenger->badge_number}}</p>
        <p>Phone: {{$passenger->phone}}</p>
        <p>Email: {{$passenger->email}}</p>
        <p>Company: {{$passenger->company->name}}</p>
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