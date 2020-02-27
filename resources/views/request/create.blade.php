@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <form>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">#</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="form-group col-md-4">
                    <div class="form-group">
                        <label for="inputEmail4">Date</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Trip Status</label>
                    <select id="inputState" class="form-control">
                        <option selected>Pending</option>
                        <option>...</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Start Date</label>
                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">End Date</label>
                    <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Trip Type</label>
                    <select id="inputState" class="form-control">
                        <option selected>Business</option>
                        <option>...</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                    value="option1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Client
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                    value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                    Visitor
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Driver should return
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Places QTY</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
            </div>

            <hr />

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputState">Company</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                    {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none"></textarea> --}}
                </div>
                <div class="form-group col-md-3">
                    <label for="inputState">Passenger name</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                    {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none"></textarea> --}}
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Phone</label>
                    {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" style="resize: none"></textarea> --}}
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Pick Up Location</label>
                    <input type="email" class="form-control" id="inputEmail4">
                    {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" style="resize: none"></textarea> --}}
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Drop Off Location</label>
                    <input type="email" class="form-control" id="inputEmail4">
                    {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" style="resize: none"></textarea> --}}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputState">Drivers</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputState">Vehicle Number</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputState">Vehicle Type</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Comment</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" style="resize: none"></textarea>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Ordered By</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Save and Close</button>
                </div>
            </div>

            
            
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.onkeydown = function(e) {

            e = e || window.event;

            if(e.keyCode == 112) {
                e.preventDefault()

                window.open('/requests/create', 'new', 'width=1050,height=200')
            } else if(e.keyCode == 27) {
                window.close()
            }
        }

        $(function () {
            $('#datetimepicker1').datetimepicker({
                daysOfWeekDisabled: []
            });
            $('#datetimepicker2').datetimepicker({
                daysOfWeekDisabled: []
            });
            $('#datetimepicker3').datetimepicker({
                daysOfWeekDisabled: []
            });
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endpush