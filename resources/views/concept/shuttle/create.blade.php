@extends('concept.layouts.master', ['currentRoute' => 'shuttles'])

@section('content')
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Shuttles</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('shuttles.index') }}" class="breadcrumb-link">Shuttles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title">Shuttle Form</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{isset($shuttle) ? route('shuttles.update', ['shuttle'=>$shuttle]) : route('shuttles.store') }}" method="POST" enctype="multipart/form-data">
            
                                @if (isset($shuttle))
                                    @method('PUT')
                                @endif
                                
                                @csrf
                                
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label>Name</label>
                                        <input name="name" type="text" value="{{isset($shuttle) ? $shuttle->name : ''}}" class="form-control @error('name') is-invalid @enderror" required>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label>Map</label>
                                        <input name="map" type="file" class="form-control @error('map') is-invalid @enderror">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('map') }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h3>Route</h3>
                                <div class="form-row">
                                    <label class="col-md-2 col-form-label">
                                        Start
                                    </label>
                                    <div class="form-group col-md-6">
                                        <input name="route[start][address]" type="text" value="{{isset($shuttle) ? $shuttle->route['start']['address'] : ''}}" class="form-control" placeholder="Address" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input name="route[start][time]" type="text" value="{{isset($shuttle) ? $shuttle->route['start']['time'] : ''}}" class="form-control" placeholder="Time" required>
                                    </div>
                                </div>
                                <div class="extra-points" data-count="{{isset($shuttle) ? count($shuttle->route) - 2 : 0}}">
                                    @if (isset($shuttle))
                                        @foreach ($shuttle->route as $key => $item)
                                            @if ($key != 'start' && $key != 'end')
                                                <div class="form-row" id="extra-point-{{$key}}">
                                                    <label class="col-md-2 col-form-label">
                                                        Location {{$key}}
                                                    </label>
                                                    <div class="form-group col-md-6">
                                                        <input name="route[{{$key}}][address]" type="text" value="{{$shuttle->route[$key]['address']}}" class="form-control" placeholder="Address" required>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input name="route[{{$key}}][time]" type="text" value="{{$shuttle->route[$key]['time']}}" class="form-control" placeholder="Time" required>
                                                    </div>
                                                    @if ($key == count($shuttle->route) - 2)
                                                    <div class="form-group col-md-2 remove-btn">
                                                        <span class="btn btn-sm btn-danger" onclick="removePoint({{$key}})">Remove</span></h3>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="col-md-10">
                                        <div class="btn btn-block btn-sm btn-success mb-2" onclick="addPoint()">Add</div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="col-md-2 col-form-label">
                                        End
                                    </label>
                                    <div class="form-group col-md-6">
                                        <input name="route[end][address]" type="text" value="{{isset($shuttle) ? $shuttle->route['end']['address'] : ''}}" class="form-control" placeholder="Address" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input name="route[end][time]" type="text" value="{{isset($shuttle) ? $shuttle->route['end']['time'] : ''}}" class="form-control" placeholder="Time" required>
                                    </div>
                                </div>
                                    
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        @if (isset($shuttle))
                        <div class="col-md-6">
                            <img src="{{asset('storage/'.$shuttle->map)}}" width="100%" alt="">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script>
    function addPoint() {
        var count = $('.extra-points').data('count') + 1;

        $('.remove-btn').remove()

        $('.extra-points').append(
            `<div class="form-row" id="extra-point-${count}">
                <label class="col-md-2 col-form-label">Location ${count}</label>
                <div class="form-group col-md-6">
                    <input name="route[${count}][address]" type="text" class="form-control" placeholder="Address" required>
                </div>
                <div class="form-group col-md-2">
                    <input name="route[${count}][time]" type="text" class="form-control" placeholder="Time" required>
                </div>
                <div class="form-group col-md-2 remove-btn">
                    <span class="btn btn-sm btn-danger" onclick="removePoint(${count})">Remove</span></h3>
                </div>
            </div>`
        );

        $('.extra-points').data('count', count);

        console.log(count)
    }

    function removePoint(key) {
        $(`#extra-point-${key}`).remove();

        $(`#extra-point-${key-1}`).append(
            `<div class="form-group col-md-2 remove-btn">
                <span class="btn btn-sm btn-danger" onclick="removePoint(${key-1})">Remove</span></h3>
            </div>`
        );

        $('.extra-points').data('count', key-1);
        console.log(key-1)
    }
</script>
    
@endpush