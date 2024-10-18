@extends('layout.dashboardlayout')
@section('content')

<div class="container-fluid">
    <div class="row px-0 mx-2">
        <div class="card col-12 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-1 px-0">
                        <a href="{{ asset('/admin/menu/list') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i></a>
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
                            <input type="text" class="form-control" placeholder="Nama Mentee">
                        </div>
                        <div class="form-group">
                            <label>Type:</label>
                            <input type="text" class="form-control" placeholder="Type Menu">
                        </div>
                        <div class="form-group">
                            <label>Icon:</label>
                            <input type="text" class="form-control" placeholder="Icon Menu">
                        </div>
                        <div class="form-group">
                            <label>Link:</label>
                            <input type="text" class="form-control" placeholder="Link Menu">
                        </div>
                        <div class="form-group">
                            <label>Menu Master Urutan:</label>
                            <input type="number" class="form-control" placeholder="Urutan Menu">
                        </div>
                        <div class="form-group">
                            <label>Slug:</label>
                            <input type="text" class="form-control" placeholder="Slug Menu">
                        </div>
                        <div class="form-group col-4 mt-4">
                            <label>Status:</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Enable</option>
                                <option>Disable</option>
                            </select>
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
</div>

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Anjai Muncul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Menu berhasil ditambahkan!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ya</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('submitButton').addEventListener('click', function() {
        // Menampilkan modal
        $('#successModal').modal('show');
    });
</script>

@endsection
