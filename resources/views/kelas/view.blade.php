@extends('master.template')
@section('master.intro-header')

<div class="main-wrapper">
    <div class="row">
        <div class="col">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Kelas</h5>
                    <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
                    <table id="table-kelas" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Siswa -->
<div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" name="formEdit" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <ul class="alert alert-warning d-none" id="modalJudulEdit"></ul>
                    <div class="row g-3">
                        <div class="mb-3 col-md-4">
                            <label class="form-label">NISN</label>
                            <input type="number" id="nisn" name="nisn" class="form-control" value="" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="nama_depan" class="form-label">Nama Depan</label>
                            <input type="text" name="nama_depan" class="form-control" id="nama_depan" value="" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="exampleInputPassword1" class="form-label">Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" value="">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="exampleInputPassword1" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="exampleInputPassword1" class="form-label">Tanggal Lahir</label>
                            <input type="text" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="">
                        </div>
                        <div class="form-floating col-md-4">
                            <fieldset class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="js-states form-control" name="jenis_kelamin" id="jenis_kelamin" tabindex="-1" style="display: none; width: 100%">
                                    <optgroup label="Pilih Jenis Kelamin">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </optgroup>
                                </select>
                            </fieldset>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="exampleInputPassword1" class="form-label">Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" id="nama_ibu" value="" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="exampleInputPassword1" class="form-label">Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" id="nama_ayah" value="" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="exampleInputPassword1" class="form-label">Agama</label>
                            <input type="text" name="agama" class="form-control" id="agama" value="" required>
                        </div>
                        <div class="form-floating col-md-6">
                            <select class="js-states form-control" name="kelas_id" id="kelas_id" tabindex="-1" style="display: none; width: 100%">
                                <option selected disabled>-- Pilih Kelas --</option>
                                @foreach ($kelas as $kl)
                                <option value="{{ $kl->id }}">{{ $kl->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-floating col-md-6">
                            <select class="js-states form-control" name="jurusan_id" id="jurusan_id" tabindex="-1" style="display: none; width: 100%">
                                <option selected disabled>-- Pilih Jurusan --</option>
                                @foreach ($jurusan as $jr)
                                <option value="{{ $jr->id }}">{{ $jr->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Alamat</label>
                            <textarea class="alamat form-control" name="alamat" id="alamat" aria-label="With textarea" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Avatar</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block" id="btn-update" value="create">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Edit Siswa -->

<script src="{{ asset('template/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
        $('#table-kelas').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            ajax: {
                url: "/kelas",
                type: 'GET'
            },
            columns: [{
                    data: 'nama_kelas',
                    name: 'nama_kelas'
                },
                {
                    data: 'siswa',
                    name: 'siswa'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ],
            order: [
                [0, 'asc']
            ]
        });
    });

</script>
@endsection