@extends('layout.dashboardlayout')
@section('content')
<div class="container-fluid">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Welcome to mentorIn</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>Mentoring Terlaksana</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Total Mentoring</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>

              <p>Belum Terlaksana</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>

              <p>Mentoring Selanjutnya</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3 col-6">
            <button type="button" class="btn btn-block btn-primary btn-lg">Tambah Jadwal</button>
        </div>
        <div class="col-lg-3 col-6">
            <button type="button" class="btn btn-block btn-success btn-lg">Tambah Hasil</button>
        </div>
        <div class="col-lg-3 col-6">
            <button type="button" class="btn btn-block btn-warning btn-lg">Lihat Feedback</button>
        </div>
        <div class="col-lg-3 col-6">
            <button type="button" class="btn btn-block btn-danger btn-lg">Lihat Modul</button>
        </div>
      </div>

      <div class="row mt-2">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Jadwal, Hasil, dan Feedback</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>Mentee</th>
                    <th>Hari tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Hasil</th>
                    <th>Feed Back</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Muh Mahammad Ahmad</td>
                    <td>Senin, 30 September 12</td>
                    <td>12.00 - 13.00</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </td>
                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      
</div>
    
@endsection