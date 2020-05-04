<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        {{-- <div class="section-block" id="basicform">
            <h3 class="section-title">Taxi Request Form</h3>
        </div> --}}
        <div class="card">
            <div class="card-body">
                <form onsubmit="submitForm(event, {{$taxiRequest->id}})" action="{{route('taxi-requests.setVehicle', ['taxiRequest'=>$taxiRequest]) }}" method="POST">

                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Vehicle</label>
                            <select name="vehicle_id" class="form-control">
                                <option value="">Select Vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                <option value="{{$vehicle->id}}">{{$vehicle->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
