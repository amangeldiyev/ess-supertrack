<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h3>Send notification</h3>
                <form onsubmit="submitForm(event, {{$taxiRequest->id}}, {{$status}})" action="{{ route('taxi-requests.update-status', ['taxiRequest' => $taxiRequest]) }}" method="POST">

                    @csrf

                    <div class="form-row">
                        @if (empty($text))
                            <div class="alert alert-danger" role="alert">
                                Template text not set!
                            </div>
                        @endif
                        <div class="form-group col-md-12">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="sms_notification" value="1" {{$client->sms_notification == 0 ? "" : "checked"}} class="custom-control-input">
                                <span class="custom-control-label">SMS notification</span>
                            </label>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="email_notification" value="1" {{$client->email_notification == 0 ? "" : "checked"}} class="custom-control-input">
                                <span class="custom-control-label">Email notification</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
