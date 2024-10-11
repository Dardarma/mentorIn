@extends('layout.dashboardlayout')
@section('content')

<div class="container-fluid">
    <div class="row px-0 mx-2">
            <div class="card col-12 mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-1 px-0">
                            <<a href="{{asset ('/admin/menu/list')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i></a>
                        </div>
                        <div class="col-7">
                            <h3>Tambah Menu Master</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>Nama:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Mentee">
                              </div>
                                <label>Type:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Mentee"><br>
                                <label>icon:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Mentee"><br>
                                <label>Link:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Mentee"><br>
                                <label>Menu Master Urutan:</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Nama Mentee"><br>
                                <label>Slug:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Mentee"><br>
                                <label>Status:</label>
                                <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">Toggle this custom switch element</label>
                                </div>

                        <div class="col-6">

                        </div>
@endsection