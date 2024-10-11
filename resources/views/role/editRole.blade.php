@extends('layout.dashboardlayout')
@section('content')

<div class="container-fluid">
    <div class="row px-0 mx-2">
        <div class="card col-12 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-1 px-0">
                        <a href="{{asset('/admin/role/list')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i></a>
                    </div>
                    <div class="col-7">
                        <h3>Edit Role</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Pemision">
                        </div>
                    </div>
                    <div class="col-6">
                    </div>
                    <div class="col-8">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>Menu</label>
                                <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>Permision</label>
                                <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                </select>
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

@endsection