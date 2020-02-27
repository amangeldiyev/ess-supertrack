<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

</head>

<body style="background-color: lightsteelblue">
    
    <div class="container">
        <br>
        
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
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none"></textarea>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputState">Passenger name</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none"></textarea>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Phone</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" style="resize: none"></textarea>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Pick Up Location</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" style="resize: none"></textarea>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Drop Off Location</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" style="resize: none"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputState">Drivers</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none"></textarea>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputState">Vehicle Number</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none"></textarea>
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

    <script>
        document.onkeydown = function(e) {

            e = e || window.event;

            console.log(e.keyCode)
            if(e.keyCode == 112) {
                e.preventDefault()

                window.open('/form', 'new', 'width=1050,height=850')
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
</body>

</html>
