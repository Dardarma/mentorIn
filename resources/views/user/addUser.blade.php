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
                            <h3>Tambah User</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 mt-4">
                            <label>Nama:</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Judul Materi">
                        </div>
                        <div class="col-8 mt-4">
                            <label>User Name:</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Judul Materi">
                        </div>
                        <div class="col-8 mt-4">
                            <label>Password:</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Mentee">
                        </div>
                        <div class="col-8 mt-4">
                            <label>Asal Instanasi:</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Mentee">
                        </div>
                        <div class="col-4">
                           
                        </div>
                        <div class="col-4 mt-4">
                            <div class="form-group">
                                <label>Periode magang</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <label>Status:</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Enable</option>
                                <option>Disable</option>
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
    $('#timepicker1').datetimepicker({
        format: 'LT', // Format for displaying the time
        icons: {
            time: 'far fa-clock', // Icon used in the time picker
        }
    });

    $('#timepicker2').datetimepicker({
        format: 'LT', // Format for displaying the time
        icons: {
            time: 'far fa-clock', // Icon used in the time picker
        }
    });

    $('#reservationdate').datetimepicker({
        format: 'L'
    });
</script>

@endsection