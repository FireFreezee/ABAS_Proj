{{-- modal tambah --}}
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add-siswa', ['id' => $kelas->id_kelas]) }}" method="POST" class="forms-sample">
                    @csrf
                    <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
                    <div class="form-group">
                        <label for="exampleInputPassword1">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="{{ $s->jenis_kelamin }}" hidden>Pilih</option>
                            <option value="1">laki laki</option>
                            <option value="2">perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Password"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- modal import --}}
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


{{-- modal edit --}}

<div class="modal fade" id="edit{{ $s->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('edit-siswa', ['id' => $s->id]) }}" method="POST" class="forms-sample">
                    @csrf
                    <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
                    <div class="form-group">
                        <label for="exampleInputPassword1">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS"
                           value="{{ $s->nis }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN"
                        value="{{ $s->nisn }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama"
                        value="{{ $s->user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="" hidden>Pilih</option>
                            <option value="1" {{ $s->jenis_kelamin == 'laki laki' ? 'selected' : '' }}>laki laki</option>
                            <option value="2" {{ $s->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                        value="{{ $s->user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Password"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- modal hapus --}}

<div class="modal fade" id="hapus{{ $s->id }}" tabindex="-1" role="dialog"
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
                Apakah anda yakin ingin menghapus data {{ $s->user->name }} ?
                <span class="badge badge-danger">Data Akan Dihapus Secara Permanen!</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <form action="{{ route('hapus-siswa', ['id' => $s->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
