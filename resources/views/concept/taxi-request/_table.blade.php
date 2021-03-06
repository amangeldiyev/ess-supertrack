<!-- ============================================================== -->
<!-- data table  -->
<!-- ============================================================== -->

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-sm table-striped table-bordered {{$taxiRequests instanceof \Illuminate\Pagination\LengthAwarePaginator ? 'first' : 'second'}}" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Veh Type</th>
                            <th>Vehicle</th>
                            <th>Status</th>
                            <th>Driver</th>
                            <th>Start Time</th>
                            <th>On Location</th>
                            <th>Client</th>
                            <th>Passenger</th>
                            <th>Phone</th>
                            <th>On Board</th>
                            <th>Dropped Time</th>
                            <th>Trip Type</th>
                            <th>Remaining Time</th>
                            <th style="min-width:65px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($taxiRequests as $request)
                            <tr class="{{$request->status ? '' : 'table-danger'}}">
                                <td>{{$request->id}}</td>
                                <td>{{$request->vehicle ? $request->vehicle->type : ''}}</td>
                                <td class="text-center">{!! $request->vehicle ? $request->vehicle->name : '<a href="#" onclick="assignVehicle('.$request->id.')" type="button" class="btn btn-xs btn-info"><i class="fas fa-truck"></i></a>' !!}</td>
                                <td>{{\App\TaxiRequest::STATUSES[$request->status]}}</td>
                                <td class="text-center">{!! $request->driver ? $request->driver->name : '<a href="#" onclick="assignDriver('.$request->id.')" type="button" class="btn btn-xs btn-info"><i class="fas fa-address-card"></i></a>' !!}</td>
                                <td>{{\Carbon\Carbon::parse($request->start_date)->format('H:i')}}</td>
                                <td>{{$request->on_location_time}}</td>
                                <td>{{$request->client->name}}</td>
                                <td>{{$request->passenger}}</td>
                                <td>{{$request->phone}}</td>
                                <td>{{$request->pick_up_time}}</td>
                                <td>{{$request->drop_off_time}}</td>
                                <td>{{\App\TaxiRequest::TYPES[$request->type]}}</td>
                                <td>{{$request->remaining_time}}</td>
                                <td class="text-center" style="min-width: 190px">
                                    <a href="#" onclick="toggleModal({{$request->id}})" type="button" class="btn btn-xs btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="#" onclick="updateStatus({{$request->id}}, 1, 'Confirm taxi request')" type="button" class="btn btn-xs btn-success" title="Confirm"><i class="fas fa-check"></i></a>
                                    <a href="#" onclick="updateStatus({{$request->id}}, 4, 'Driver on location')" type="button" class="btn btn-xs btn-info" title="On location"><i class="fas fa-clock"></i></a>
                                    <a href="#" onclick="updateStatus({{$request->id}}, 3, 'Cancel taxi request')" type="button" class="btn btn-xs btn-brand" title="Cancel"><i class="fas fa-times"></i></a>
                                    <a href="#" onclick="event.preventDefault();document.getElementById('delete-form-{{$request->id}}').submit();" type="button" class="btn btn-xs btn-danger" title="Delete">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    <form id="delete-form-{{$request->id}}" action="{{ route('taxi-requests.destroy', ['taxi_request' => $request->id]) }}" method="POST" style="display: none;">
                                        @method("DELETE")
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($taxiRequests instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <br>
                    <div style="float: right">Showing {{$taxiRequests->toArray()['from']}} to {{$taxiRequests->toArray()['to']}}
                        of  {{$taxiRequests->total()}} entries
                    </div>
                    {{ $taxiRequests->appends(request()->input())->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end data table  -->
<!-- ============================================================== -->
