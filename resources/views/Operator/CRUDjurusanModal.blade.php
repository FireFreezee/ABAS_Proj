


{{-- modal edit --}}

<div class="modal fade" id="edit{{ $j->id_jurusan }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('edit-jurusan', ['id_jurusan' => $j->id_jurusan]) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                           <label for="exampleInputUsername1">Jurusan</label>
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan"
                           value="{{ $j->nama_jurusan }}" required>
                           <input type="hidden" name="id_jurusan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- modal hapus --}}

<div class="modal fade" id="hapus{{ $j->id_jurusan }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus jurusan {{ $j->nama_jurusan }} ini?
                <span class="badge badge-danger">Data Akan Dihapus Secara Permanen!</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <form action="{{ route('hapus-jurusan', ['id' => $j->id_jurusan]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
