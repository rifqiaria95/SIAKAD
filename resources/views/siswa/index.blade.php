@extends('master.template')
@section('master.intro-header')

<div class="main-wrapper">
    <div class="row">
        <div class="col">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Siswa SMK Ti Tunas Harapan</h5>
                    <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
                    <a href="/siswa/exportexcel" class="btn btn-success mb-5">Export Excel</a>
                    <a href="/siswa/exportpdf" class="btn btn-danger mb-5">Export PDF</a>
                    <button type="button" id="importSiswa" class="btn btn-success mb-5" data-bs-toggle="modal" data-bs-target="#importModal">Import Data Siswa</button>
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
            <form id="formSiswa" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="user_id" id="user_id">
                    <ul id="save_errorList"></ul>
                    <div class="row g-3">
                        <div class="mb-3 col-sm-6">
                            <label class="form-label">Nama Depan</label>
                            <input type="text" name="nama_depan" class="nama_depan form-control">
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label class="form-label">Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="nama_belakang form-control">
                        </div>
                        <div class="form-floating">
                            <fieldset class="form-group">
                                <select class="form-control" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="email form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Agama</label>
                            <input type="text" name="agama" class="agama form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Alamat</label>
                            <textarea class="alamat form-control" name="alamat" aria-label="With textarea"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Avatar</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-block" id="btn-simpan" value="create">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Tambah Siswa -->

<!-- Modal Edit Siswa -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                        <div class="mb-3 col-sm-6">
                            <label for="nama_depan" class="form-label">Nama Depan</label>
                            <input type="text" name="nama_depan" class="nama_depan form-control" id="nama_depan" value="" required>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="exampleInputPassword1" class="form-label">Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="nama_belakang form-control" id="nama_belakang" value="">
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
                            <label for="exampleInputPassword1" class="form-label">Agama</label>
                            <input type="text" name="agama" class="agama form-control" id="agama" value="" required>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-block" id="btn-update" value="create">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Edit Siswa -->

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
            </div>
            <div class="modal-body">
                <p><b>Jika menghapus Siswa maka</b></p>
                <p>*data siswa tersebut hilang selamanya, apakah anda yakin?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" id="btn-hapus" data-target="#btn-hapus" class="btn btn-danger tambah_data" value="add">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import Siswa -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Import Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!!Form::open(['route' => 'siswa.import', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'])!!}

                {!! Form::file('data_siswa') !!}
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-block" value="Import">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tambah Siswa -->

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
        $('#table-siswa').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            ajax: {
                url: "/siswa",
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

    $('#btn_tambah').click(function() {
        $('#btn-simpan').val("tambah-siswa");
        $('#siswa_id').val('');
        $('#formSiswa').trigger("reset");
        $('#modal-judul').html("Tambah Siswa");
        $('#tambahModal').modal('show');
    });

    $(document).on('click', '.edit-siswa', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/siswa/edit/" + id,
            success: function(response) {
                console.log(response);
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').modal('hide');
                } else {
                    $('#id').val(id);
                    $('#nama_depan').val(response.nama_depan);
                    $('#nama_belakang').val(response.nama_belakang);
                    $('#jenis_kelamin').val(response.jenis_kelamin);
                    $('#agama').val(response.agama);
                    $('#alamat').val(response.alamat);
                    $('#avatar').val();
                }
            }
        });
        $('.btn-close').find('input').val('');

    });

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika id = formSiswa panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    if ($("#formSiswa").length > 0) {
        $("#formSiswa").validate({
            submitHandler: function(form) {
                var actionType = $('#btn-simpan').val();
                // Mengubah data menjadi objek agar file image bisa diinput kedalam database
                var formData = new FormData($('#formSiswa')[0]);
                $.ajax({
                    data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                    url: "/siswa/store", //url simpan data
                    type: "POST", //data tipe kita kirim berupa JSON
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var oTable = $('#table-siswa').dataTable(); //inialisasi datatable
                        oTable.fnDraw(false); //reset datatable
                        if (response.status == 400) {
                            $('#save_errorList').html("");
                            $('#save_errorList').removeClass('d-none');
                            $.each(response.errors, function(key, err_value) {
                                $('#save_errorList').append('<li>' + err_value +
                                '</li>');
                            }); 

                            $('#btn-simpan').text('Menyimpan..');
                        } 
                        else if(response.status == 200)
                        {
                            $('#modalJudulEdit').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#formSiswa').find('input').val('');
                            $('#success_message').text(response.message);

                            $('#tambahModal').modal('hide');

                        }
                    }
                });
            }
        })
    }

    $(document).on('submit', '#formEdit', function(e) {
        e.preventDefault();
        var id = $('#id').val();

        // Mengubah data menjadi objek agar file image bisa diinput kedalam database
        var EditFormData = new FormData($('#formEdit')[0]);

        $.ajax({
            type: "POST",
            url: "/siswa/update/" + id,
            data: EditFormData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                var oTable = $('#table-siswa').dataTable(); //inialisasi datatable
                oTable.fnDraw(false); //reset datatable
                if (response.status == 400) {
                    $('#modalJudulEdit').html("");
                    $('#modalJudulEdit').removeClass('d-none');
                    $.each(response.errors, function(key, err_value) {
                        $('#modalJudulEdit').append('<li>' + err_value +
                        '</li>');
                    }); 

                    $('#btn-update').text('Update');
                } 
                else if (response.status == 404)
                {
                    alert(response.message);
                }
                else if(response.status == 200)
                {
                    $('#modalJudulEdit').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);

                    $('#editModal').modal('hide');
                }
            }
        });

    });

    //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
    $('body').on('click', '.delete', function() {
        id = $(this).attr('id');
        $('#modalHapus').modal('show');
    });
    //jika tombol hapus pada modal konfirmasi di klik maka
    $('#btn-hapus').click(function() {
        $.ajax({
            url: "/siswa/delete/" + id, //eksekusi ajax ke url ini
            type: 'delete',
            beforeSend: function() {
                $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
            },
            success: function(response) { //jika sukses
                setTimeout(function() {
                    $('#modalHapus').modal('hide');
                    var oTable = $('#table-siswa').dataTable();
                    oTable.fnDraw(false); //reset datatable
                    if(response.status == 404)
                    {
                        alert(response.message);
                    }
                    else if(response.status == 200)
                    {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                    }
                });
            }
        })
    });
</script>
@endsection