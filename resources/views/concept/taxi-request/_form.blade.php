@push('styles')
    <link rel="stylesheet" href="{{ asset('/vendor/datepicker/tempusdominus-bootstrap-4.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-select/css/bootstrap-select.css') }}" />
@endpush

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        {{-- <div class="section-block" id="basicform">
            <h3 class="section-title">Taxi Request Form</h3>
        </div> --}}
        <div class="card">
            <div class="card-body">
                <form onsubmit="submitForm(event, {{isset($taxiRequest) ? $taxiRequest->id : 0}})" action="{{isset($taxiRequest) ? route('taxi-requests.update', ['taxi_request'=>$taxiRequest]) : route('taxi-requests.store') }}" method="POST">
        
                    @if (isset($taxiRequest))
                        @method('PUT')
                    @endif
                    
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Ordered By</label>
                            <select id="ajax-select" name="ordered_by" class="selectpicker with-ajax form-control" data-live-search="true">
                                @isset($taxiRequest)
                                <option value="{{$taxiRequest->client->id}}" data-subtext="{{$taxiRequest->client->phone}}">{{$taxiRequest->client->name}}</option>
                                @endisset
                                @foreach (\App\Passenger::filterByCompany()->limit(5)->get() as $passenger)
                                    <option value="{{$passenger->id}}" data-subtext="{{$passenger->phone}}">{{$passenger->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="error_ordered_by">
                                Field is required.
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Trip Type</label>
                            <select name="type" id="inputState" class="form-control">
                                <option value="0" {{isset($taxiRequest) && $taxiRequest->type == 0 ? "selected" : ""}}>Business</option>
                            </select>
                        </div>
                        @if (auth()->user()->company_id === 0)
                            <div class="form-group col-md-3">
                                <label>Company</label>
                                <select name="company_id" class="form-control">
                                    @foreach (\App\Company::all() as $company)
                                    <option value="{{$company->id}}" {{isset($taxiRequest) && $taxiRequest->company_id == $company->id ? "selected" : ""}}>{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group col-md-3">
                            <label>Trip Status</label>
                            <select name="status" class="form-control">
                                @foreach (\App\TaxiRequest::STATUSES as $key => $status)
                                    <option value="{{$key}}" {{isset($taxiRequest) && $taxiRequest->status == $key ? "selected" : ""}}>{{$status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Passenger name</label>
                            <input id="passenger" name="passenger" value="{{isset($taxiRequest) ? $taxiRequest->passenger : ''}}" class="form-control" autocomplete="off" required>
                            <div class="invalid-feedback" id="error_passenger">
                                Field is required.
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Phone</label>
                            <input name="phone" value="{{isset($taxiRequest) ? $taxiRequest->phone : ''}}" type="text" class="form-control">
                            <div class="invalid-feedback" id="error_phone">
                                Field is required.
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Pick Up Location</label>
                            <input name="pick_up_location" value="{{isset($taxiRequest) ? $taxiRequest->pick_up_location : ''}}" type="text" class="form-control" required>
                            <div class="invalid-feedback" id="error_pick_up_location">
                                Field is required.
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Drop Off Location</label>
                            <input name="drop_off_location" value="{{isset($taxiRequest) ? $taxiRequest->drop_off_location : ''}}" type="text" class="form-control" required>
                            <div class="invalid-feedback" id="error_drop_off_location">
                                Field is required.
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>#</label>
                            <input name="number" value="{{isset($taxiRequest) ? $taxiRequest->number : time()}}" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Places QTY</label>
                            <input name="qty" type="number" class="form-control" value="{{isset($taxiRequest) ? $taxiRequest->qty : ''}}" required>
                            <div class="invalid-feedback" id="error_qty">
                                Field is required.
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="custom-control custom-radio">
                                            <input type="radio" name="passenger_type" value="0" {{isset($taxiRequest) && $taxiRequest->passenger_type == 1 ? "" : "checked"}} class="custom-control-input"><span class="custom-control-label">Client</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input type="radio" name="passenger_type" value="1" {{isset($taxiRequest) && $taxiRequest->passenger_type == 1 ? "checked" : ""}} class="custom-control-input"><span class="custom-control-label">Visitor</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="form-check">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="driver_in_time" value="1" {{isset($taxiRequest) && $taxiRequest->driver_in_time == 0 ? "" : "checked"}} class="custom-control-input">
                                    <span class="custom-control-label">Driver should be in time</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="input-group date" id="datetimepicker1" data-default="{{isset($taxiRequest) ? $taxiRequest->date : ''}}" data-target-input="nearest">
                                    <input name="date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" autocomplete="off" required/>
                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="invalid-feedback" id="error_date">
                                    Field is required.
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Start Date</label>
                            <div class="input-group date" id="datetimepicker2" data-default="{{isset($taxiRequest) ? $taxiRequest->start_date : ''}}" data-target-input="nearest">
                                <input name="start_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" autocomplete="off" required/>
                                <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="error_start_date">
                                Field is required.
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>End Date</label>
                            <div class="input-group date" id="datetimepicker3" data-default="{{isset($taxiRequest) ? $taxiRequest->end_date : ''}}" data-target-input="nearest">
                                <input name="end_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3" autocomplete="off" required/>
                                <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="error_end_date">
                                Field is required.
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>On Location</label>
                            <div class="input-group date form-datetime" id="datetimepicker4" data-default="{{isset($taxiRequest) ? $taxiRequest->on_location_time : ''}}" data-target-input="nearest">
                                <input name="on_location_time" value="{{isset($taxiRequest) ? $taxiRequest->on_location_time : ''}}" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" autocomplete="off"/>
                                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Pick Up Time</label>
                            <div class="input-group date form-datetime" id="datetimepicker5" data-default="{{isset($taxiRequest) ? $taxiRequest->pick_up_time : ''}}" data-target-input="nearest">
                                <input name="pick_up_time" value="{{isset($taxiRequest) ? $taxiRequest->pick_up_time : ''}}" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker5" autocomplete="off"/>
                                <div class="input-group-append" data-target="#datetimepicker5" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Drop Off Time</label>
                            <div class="input-group date form-datetime" id="datetimepicker6" data-default="{{isset($taxiRequest) ? $taxiRequest->drop_off_time : ''}}" data-target-input="nearest">
                                <input name="drop_off_time" value="{{isset($taxiRequest) ? $taxiRequest->drop_off_time : ''}}" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker6" autocomplete="off"/>
                                <div class="input-group-append" data-target="#datetimepicker6" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />
            
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Drivers</label>
                            <select class="form-control selectpicker" name="driver_id" data-live-search="true" data-size="5">
                                <option value="">None</option>
                                @foreach (\App\Driver::filterByCompany()->get() as $driver)
                                <option value="{{$driver->id}}" {{isset($taxiRequest) && $taxiRequest->driver_id == $driver->id ? "selected" : ""}}>{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Vehicle Number</label>
                            <select name="vehicle_id" class="form-control selectpicker" data-live-search="true" data-size="5">
                                <option value="">None</option>
                                @foreach (\App\Vehicle::filterByCompany()->get() as $vehicle)
                                <option value="{{$vehicle->id}}" data-tokens="{{$vehicle->type}}" data-subtext="{{$vehicle->type}}" {{isset($taxiRequest) && $taxiRequest->vehicle_id == $vehicle->id ? "selected" : ""}}>{{$vehicle->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Comment</label>
                            <textarea name="comment" class="form-control" rows="4" style="resize: none">{{isset($taxiRequest) ? $taxiRequest->comment : ''}}</textarea>
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/search.js') }}"></script>

@push('scripts')
    <script src="{{ asset('/vendor/datepicker/moment.js') }}"></script>
    <script src="{{ asset('/vendor/datepicker/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-select/js/ajax-bootstrap-select.min.js') }}"></script>
    
@endpush