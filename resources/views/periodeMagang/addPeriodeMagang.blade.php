@extends('layout.dashboardlayout')
@section('content')

<div class="container-fluid">
    <div class="row px-0 mx-2">
        <div class="card col-12 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-1 px-0">
                        <button type="button" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i></button>
                    </div>
                    <div class="col-7">
                        <h3>Edit Periode Magang</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Tanggal Mulai:</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                            </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Tanggal Selesai:</label>
                            <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                                    <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                            </div>
                    </div>
                </div>
                <div class="col-4">
                </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Enable</option>
                            <option>Disable</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset ('plugins/jquery/jquery.min.js')}}"></script>

<script src="{{asset ('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset ('plugins/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{asset('plugins/moment/moment.min.js')}}"></script>

<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>


<script>
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    $('#reservationdate1').datetimepicker({
        format: 'L'
    });
</script>

@endsection