@extends('layout.dashboardlayout')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Periode Magang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item ">Home</li>
                        <li class="breadcrumb-item active"><a href="#">List Mentoring</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card mx-1">
      <div class="card-header">
        <div class="row">
          <div class="col-6">
              <h2 class="card-title">Data Mentoring</h2>
          </div>
          <div class="col-6 d-flex justify-content-end">
              <a href="{{url ('/admin/periode-magang/add')}}" class="btn btn-success">Tambah Jadwal</a>
          </div>
        </div>      
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td>Trident</td>
              <td>Internet
                Explorer 4.0
              </td>
              <td>Win 95+</td>
              <td>
                <a href="{{url ('/admin/periode-magang/edit')}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pencil"></i></a>
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></button>
                <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
            </td>
          </tr>
          <tfoot>
          <tr>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
      
    $(document).ready(function() {
        // Inisialisasi Sparkline jika elemen targetnya ada
        if ($('#sparklineTarget').length) {
            new Sparkline(document.getElementById("sparklineTarget"));
        }

        // Inisialisasi DataTables
        if ($.fn.DataTable) {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": true,
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        } else {
            console.error("DataTables plugin not loaded.");
        }
    });

    </script>

@endsection