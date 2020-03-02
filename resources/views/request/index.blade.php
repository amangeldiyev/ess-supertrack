@extends('layouts.master')


@section('content')

    @include('layouts._navbar')

    
    <table class="table table-sm table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Veh Type</th>
                <th scope="col">Vehicle</th>
                <th scope="col">Status</th>
                <th scope="col">Driver</th>
                <th scope="col">Start Time</th>
                <th scope="col">On Location</th>
                <th scope="col">Client Name</th>
                <th scope="col">Passenger</th>
                <th scope="col">Passenger Phone</th>
                <th scope="col">On Board</th>
                <th scope="col">Dropped Time</th>
                <th scope="col">Trip Type</th>
                <th scope="col">Remaining Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($taxiRequests as $request)
                <tr class="{{$request->status ? '' : 'table-danger'}}">
                    <td>{{$request->vehicle->type}}</td>
                    <td>{{$request->vehicle->name}}</td>
                    <td>{{\App\TaxiRequest::STATUSES[$request->status]}}</td>
                    <td>{{$request->driver->name}}</td>
                    <td>{{$request->start_time}}</td>
                    <td>{{$request->on_location_time}}</td>
                    <td>{{$request->client->name}}</td>
                    <td>{{$request->passenger}}</td>
                    <td>{{$request->phone}}</td>
                    <td>{{$request->pick_up_time}}</td>
                    <td>{{$request->drop_off_time}}</td>
                    <td>{{\App\TaxiRequest::TYPES[$request->type]}}</td>
                    <td>{{$request->time_remaining}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="fixed-bottom border-top p-3 bg-secondary" style="height: 150px">
        <form class="form-inline">
            <div class="form-group mb-2">
                <label for="staticEmail2" class="sr-only">Email</label>
                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPassword2" class="sr-only">Password</label>
                <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
            </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.onkeydown = function (e) {

            e = e || window.event;

            if (e.keyCode == 112) {
                e.preventDefault()

                window.open('/taxi-requests/create', 'new', 'width=1050,height=700')
            } else if (e.keyCode == 27) {
                window.close()
            }
        }
    </script>
@endpush
