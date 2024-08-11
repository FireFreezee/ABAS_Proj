


{{-- modal edit --}}

<div class="modal fade" id="edit{{ $k->id_kelas }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('edit-kelas', ['id_kelas' => $k->id_kelas]) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jurusan</label>
                        <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                            <option value="" hidden>Pilih</option>
                            @foreach ($jurusan as $j)
                            <option value="{{ $j->id_jurusan }}" {{ $k->id_jurusan == $j->id_jurusan ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nomor Kelas</label>
                        <input type="text" class="form-control" id="nomor_kelas" name="nomor_kelas" placeholder="Nomor Kelas"
                        value="{{ $k->nomor_kelas }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Wali Kelas</label>
                        <select class="form-control" id="nuptk" name="nuptk">
                            <option value="" hidden>Pilih</option>
                            @foreach ($walikelas as $wk)
                            <option value="{{ $wk->nuptk }}" {{ $k->nuptk == $wk->nuptk ? 'selected' : '' }}>{{ $wk->user->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tingkat Kelas</label>
                        <select class="form-control" id="tingkat" name="tingkat" required>
                            <option value="{{ $k->tingkat }}" hidden>Pilih</option>
                            <option value="10" {{ $k->tingkat == 10 ? 'selected' : '' }}>10</option>
                            <option value="11" {{ $k->tingkat == 11 ? 'selected' : '' }}>11</option>
                            <option value="12" {{ $k->tingkat == 12 ? 'selected' : '' }}>12</option>
                        </select>
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

<div class="modal fade" id="hapus{{ $k->id_kelas }}" tabindex="-1" role="dialog"
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
                Apakah anda yakin ingin menghapus kelas {{ $k->tingkat }} {{ $k->jurusan->nama_jurusan }} ?
                <span class="badge badge-danger">Data Akan Dihapus Secara Permanen!</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <form action="{{ route('hapus-kelas', ['id' => $k->id_kelas]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
