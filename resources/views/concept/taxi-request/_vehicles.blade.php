<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        {{-- <div class="section-block" id="basicform">
            <h3 class="section-title">Taxi Request Form</h3>
        </div> --}}
        <div class="card">
            <div class="card-body">
                <form onsubmit="submitForm(event, {{$taxiRequest->id}})" action="{{route('taxi-requests.assign-vehicle', ['taxiRequest'=>$taxiRequest]) }}" method="POST">

                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Vehicle</label>
                            <select name="vehicle_id" class="form-control selectpicker" data-live-search="true" data-size="10">
                                @foreach ($vehicles as $vehicle)
                                <option value="{{$vehicle->id}}" data-tokens="{{$vehicle->type}}" data-subtext="{{$vehicle->type}}">{{$vehicle->name}}</option>
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

<script>
    $('.selectpicker').selectpicker();
</script>
