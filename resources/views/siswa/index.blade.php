@extends('master.template')
@section('master.intro-header')

<div class="main-wrapper">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Siswa SMK Ti Tunas Harapan</h5>
                    <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
                    <a href="/siswa/exportexcel" class="btn btn-success mb-5">Export Excel</a>
                    <a href="/siswa/exportpdf" class="btn btn-danger mb-5">Export PDF</a>
                    <table id="table-siswa" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>Nilai Rata-Rata</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formSiswa" name="formSiswa" class="form-horizontal">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <ul id="save_errList"></ul>
                    <div class="row g-3">
                        <div class="mb-3 col-sm-6">
                            <label for="nama_depan" class="form-label">Nama Depan</label>
                            <input type="text" name="nama_depan"  class="nama_depan form-control" id="nama_depan" value="" required>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="exampleInputPassword1" class="form-label">Nama Belakang</label>
                            <input type="text" name="nama_belakang"  class="nama_belakang form-control" id="nama_belakang" value="">
                        </div>
                        <div class="form-floating">
                            <fieldset class="form-group">
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="email form-control" id="email" value= "" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Agama</label>
                            <input type="text" name="agama"  class="agama form-control" id="agama" value= "" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Alamat</label>
                            <textarea class="alamat form-control" name="alamat" id="alamat" aria-label="With textarea" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Avatar</label>
                            <input type="file" id="avatar" name="avatar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-block" id="btn-simpan"
                        value="create">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Tambah Siswa -->

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Jika menghapus Siswa maka</b></p>
                <p>*data siswa tersebut hilang selamanya, apakah anda yakin?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                    Data</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('template/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function () {
        $('#table-siswa').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            ajax: {
                url: "{{ route('siswa.index') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'nama_depan',
                    name: 'nama_depan'
                },
                {
                    data: 'nama_belakang',
                    name: 'nama_belakang'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'agama',
                    name: 'agama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'rata2_nilai',
                    name: 'rata2_nilai'
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

    $('#btn_tambah').click(function () {
        $('#btn-simpan').val("tambah-siswa");
        $('#siswa_id').val('');
        $('#formSiswa').trigger("reset");
        $('#modal-judul').html("Tambah Siswa");
        $('#tambahModal').modal('show');
    });

    // /TOMBOL EDIT DATA PER PEGAWAI DAN TAMPIKAN DATA BERDASARKAN ID PEGAWAI KE MODAL
    //ketika class edit-post yang ada pada tag body di klik maka
    $('body').on('click', '.edit-siswa', function () {
        var data_id = $(this).data('id');
        $.get('siswa/' + data_id + '/edit', function (data) {
            console.log(data);
            $('#modal-judul').html("Edit Siswa");
            $('#btn-simpan').val("edit-siswa");
            $('#tambahModal').modal('show');
            //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
            $('#id').val(data.id);
            $('#nama_depan').val(data.nama_depan);
            $('#nama_belakang').val(data.nama_belakang);
            $('#jenis_kelamin').val(data.jenis_kelamin);
            $('#email').val(data.email);
            $('#agama').val(data.agama);
            $('#alamat').val(data.alamat);
        })
    });

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika id = formSiswa panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    if ($("#formSiswa").length > 0) {
        $("#formSiswa").validate({
            submitHandler: function (form) {
                var actionType = $('#btn-simpan').val();
                $('#btn-simpan').html('Sending..');
                $.ajax({
                    data: $('#formSiswa')
                        .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                    url: "{{ route('siswa.store') }}", //url simpan data
                    type: "POST", //karena simpan kita pakai method POST
                    dataType: 'json', //data tipe kita kirim berupa JSON
                    success: function (data) { //jika berhasil 
                        $('#formSiswa').trigger("reset"); //form reset
                        $('#tambahModal').modal('hide'); //modal hide
                        $('#btn-simpan').html('Simpan'); //tombol simpan
                        var oTable = $('#table-siswa').dataTable(); //inialisasi datatable
                        oTable.fnDraw(false); //reset datatable
                        toastr.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                            title: 'Data Berhasil Disimpan',
                            message: '{{ Session('
                            success ')}}',
                            position: 'bottomRight'
                        });
                    },
                    error: function (data) { //jika error tampilkan error pada console
                        console.log('Error:', data);
                        $('#btn-simpan').html('Simpan');
                    }
                });
            }
        })
    }

    
    @if(Session::has('sukses'))
        toastr.success("{{Session::get('sukses')}}", "Sukses, Data Berhasil Disimpan")
    @endif
</script>
@endsection