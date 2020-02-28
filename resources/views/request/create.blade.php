@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        @if (isset($taxiRequest))
            <h1>Editing {{$taxiRequest->number}}</h1>
        @endif
        <form action="{{isset($taxiRequest) ? route('taxi-requests.update', ['taxi_request'=>$taxiRequest]) : route('taxi-requests.store') }}" method="POST">
            
            @if (isset($taxiRequest))
                @method('PUT')
            @endif
            
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>#</label>
                    <input name="number" value="{{isset($taxiRequest) ? $taxiRequest->number : ''}}" type="text" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input name="date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>Trip Status</label>
                    <select name="status" class="form-control">
                        <option value="0" {{isset($taxiRequest) && $taxiRequest->status == 0 ?  "selected" : ""}}>Pending</option>
                        <option value="1" {{isset($taxiRequest) && $taxiRequest->status == 1 ?  "selected" : ""}}>Confirmed</option>
                        <option value="2" {{isset($taxiRequest) && $taxiRequest->status == 2 ?  "selected" : ""}}>Assigned</option>
                        <option value="3" {{isset($taxiRequest) && $taxiRequest->status == 3 ?  "selected" : ""}}>Pick Up</option>
                        <option value="4" {{isset($taxiRequest) && $taxiRequest->status == 4 ?  "selected" : ""}}>Drop Off</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Start Date</label>
                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input name="start_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2"/>
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>End Date</label>
                    <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                        <input name="end_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3"/>
                        <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>Trip Type</label>
                    <select name="type" id="inputState" class="form-control">
                        <option value="0" {{isset($taxiRequest) && $taxiRequest->type == 0 ?  "selected" : ""}}>Business</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="passenger_type" id="gridRadios1"
                                    value="0" {{isset($taxiRequest) && $taxiRequest->passenger_type == 0 ?  "checked" : ""}}>
                                <label class="form-check-label" for="gridRadios1">
                                    Client
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="passenger_type" id="gridRadios2"
                                    value="1" {{isset($taxiRequest) && $taxiRequest->passenger_type == 1 ?  "checked" : ""}}>
                                <label class="form-check-label" for="gridRadios2">
                                    Visitor
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" name="driver_in_time" type="checkbox" id="gridCheck" value="1" {{isset($taxiRequest) && $taxiRequest->driver_in_time == 1 ?  "checked" : ""}}>
                        <label class="form-check-label" for="gridCheck">
                            Driver should be in time
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>Places QTY</label>
                    <input name="qty" type="number" class="form-control" value="{{isset($taxiRequest) ?  $taxiRequest->qty : ''}}">
                </div>
            </div>

            <hr />

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Company</label>
                    <select name="company_id" class="form-control">
                        @foreach (\App\Company::all() as $company)
                        <option value="{{$company->id}}" {{isset($taxiRequest) && $taxiRequest->company_id == $company->id ?  "selected" : ""}}>{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Passenger name</label>
                    <input name="passenger" value="{{isset($taxiRequest) ?  $taxiRequest->passenger : ''}}" class="form-control" list="passengers" autocomplete="off">
                    <datalist id="passengers">
                        @foreach ($passengers = \App\Passenger::all() as $passenger)
                        <option value="{{$passenger->name}}">{{$passenger->badge_number}}</option>
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group col-md-2">
                    <label>Phone</label>
                    <input name="phone" value="{{isset($taxiRequest) ?  $taxiRequest->phone : ''}}" type="text" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Pick Up Location</label>
                    <input name="pick_up_location" value="{{isset($taxiRequest) ?  $taxiRequest->pick_up_location : ''}}" type="text" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Drop Off Location</label>
                    <input name="drop_off_location" value="{{isset($taxiRequest) ?  $taxiRequest->drop_off_location : ''}}" type="text" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Drivers</label>
                    <select name="driver_id" class="form-control">
                        @foreach (\App\Driver::all() as $driver)
                        <option value="{{$driver->id}}" {{isset($taxiRequest) && $taxiRequest->driver_id == $driver->id ?  "selected" : ""}}>{{$driver->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Vehicle Number</label>
                    <select name="vehicle_id" class="form-control">
                        @foreach (\App\Vehicle::all() as $vehicle)
                        <option value="{{$vehicle->id}}" {{isset($taxiRequest) && $taxiRequest->vehicle_id == $vehicle->id ?  "selected" : ""}}>{{$vehicle->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Vehicle Type</label>
                    <input name="vehicle_type" value="{{isset($taxiRequest) ?  $taxiRequest->vehicle_type : ''}}" type="text" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Comment</label>
                    <textarea name="comment" class="form-control" rows="4" style="resize: none">{{isset($taxiRequest) ?  $taxiRequest->comment : ''}}</textarea>
                </div>
                <div class="form-group col-md-4">
                    <label>Ordered By</label>
                    <select name="ordered_by" class="form-control">
                        @foreach ($passengers as $passenger)
                        <option value="{{$passenger->id}}" {{isset($taxiRequest) && $taxiRequest->ordered_by == $passenger->id ?  "selected" : ""}}>{{$passenger->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div> 
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.onkeydown = function(e) {

            e = e || window.event;

            if(e.keyCode == 27) {
                window.close()
            }
        }

        $(function () {
            $('#datetimepicker1').datetimepicker({
                daysOfWeekDisabled: [],
                format: 'DD/MM/YYYY',
                defaultDate: "{{isset($taxiRequest) ? $taxiRequest->date : ''}}",
            })
            $('#datetimepicker2').datetimepicker({
                daysOfWeekDisabled: [],
                format: 'DD/MM/YYYY HH:mm',
                defaultDate: "{{isset($taxiRequest) ? $taxiRequest->start_date : ''}}",
            })
            $('#datetimepicker3').datetimepicker({
                daysOfWeekDisabled: [],
                format: 'DD/MM/YYYY HH:mm',
                defaultDate: "{{isset($taxiRequest) ? $taxiRequest->end_date : ''}}",
            })
        })
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endpush