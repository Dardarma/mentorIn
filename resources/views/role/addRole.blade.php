@extends('layout.dashboardlayout')
@section('content')

<div class="container-fluid">
    <div class="row px-0 mx-2">
        <div class="card col-12 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-1 px-0">
                        <a href="{{ asset('/admin/role/list') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i></a>
                    </div>
                    <div class="col-7">
                        <h3>Tambah Role</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" placeholder="Nama Role">
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="form-group">
                            <label>Menu</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="form-group">
                            <label>Permision</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4"></div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Enable</option>
                                <option>Disable</option>
                            </select>
                        </div>
                    </div>

                    <div class="container mt-3">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-success" id="submitButton">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Anjai Muncul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            Menu berhasil di tambahkan!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Ya</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('submitButton').addEventListener('click', function() {
        // Menampilkan modal
        $('#confirmationModal').modal('show');
    });

    document.getElementById('confirmButton').addEventListener('click', function() {
        // Logika untuk menambahkan role di sini
        // Contoh: $('#yourFormId').submit();

        // menampilkan modal sukses 
        $('#confirmationModal').modal('hide');
    });
</script>

@endsection
