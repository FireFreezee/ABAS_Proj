{{-- modal edit --}}

<div class="modal fade" id="edit{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('edit-kesiswaan', ['id' => $k->id]) }}" method="POST" class="forms-sample"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input type="text" class="form-control" id="nama" name="name" placeholder="Nama"
                            value="{{ $k->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">NIP</label>
                        <input type="email" class="form-control" id="nip"
                            name="nip" placeholder="nip" value="{{ $k->wali->nip }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">nuptk</label>
                        <input type="email" class="form-control" id="nuptk"
                            name="nuptk" value="{{ $k->wali->nuptk }}" placeholder="nuptk" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ $k->email }}">
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="" hidden>Pilih</option>
                            <option value="1" {{ $k->wali->jenis_kelamin == 'laki laki' ? 'selected' : '' }}>laki laki
                            </option>
                            <option value="2" {{ $k->wali->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>perempuan
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Password</label>
                        <input type="email" class="form-control" id="password" name="password" placeholder="Password"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- modal hapus --}}

<div class="modal fade" id="hapus{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus data {{ $k->name }} ini?
                <span class="badge badge-danger">Data Akan Dihapus Secara Permanen!</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <form action="{{ route('hapus-kesiswaan', ['id' => $k->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
