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
                            <h3>Edit Jadwal</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Date:</label>
                                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                      <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                              </div>
                        </div>
                        <div class="col-6">

                        </div>
                        <div class="col-4 mt-4">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>Time picker:</label>
              
                                  <div class="input-group date" id="timepicker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#timepicker1"/>
                                    <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                  </div>
                                 
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>Time picker:</label>
              
                                  <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#timepicker2"/>
                                    <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                  </div>
                                 
                                </div>
                            </div>
                        </div>
                        <div class="col-8 mt-4">
                            <label>Mentee:</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Mentee">
                        </div>
                        <div class="col-8 mt-4">
                            <label>Judul Materi:</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Judul Materi">
                        </div>
                        <div class="col-12 mt-4">
                            <label>Deskripsi Materi:</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <label>Todo Pre Mentoring:</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
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