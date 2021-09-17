@extends('master.template')
@section('master.intro-header')

<div class="main-wrapper">
    <div class="row">
        <div class="col">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Guru SMK Ti Tunas Harapan</h5>
                    <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
                    <a href="#" class="btn btn-success mb-5">Export Excel</a>
                    <a href="#" class="btn btn-danger mb-5">Export PDF</a>
                    <table id="table-guru" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Guru</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Guru -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Tambah Data Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formGuru" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="user_id" id="user_id">
                    <ul id="save_errorList"></ul>
                    <div class="row g-3">
                        <div class="mb-3 col-sm-6">
                            <label for="nama_depan" class="form-label">Nama Guru</label>
                            <input type="text" name="nama_guru" class="nama_guru form-control" id="nama_guru" value="" required>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="exampleInputPassword1" class="form-label">Nomor Telepon</label>
                            <input type="text" name="telepon" class="telepon form-control" id="telepon" value="">
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
                    <button type="submit" class="btn btn-primary btn-block" id="btn-simpan" value="create">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Tambah Guru -->

<!-- Modal Edit Guru -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Edit Data Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" name="formEdit" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <ul class="alert alert-warning d-none" id="modalJudulEdit"></ul>
                    <div class="row g-3">
                        <div class="mb-3 col-sm-6">
                            <label for="nama_depan" class="form-label">Nama Guru</label>
                            <input type="text" name="nama_depan" class="nama_depan form-control" id="nama_depan" value="" required>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="exampleInputPassword1" class="form-label">Nomor Telepon</label>
                            <input type="text" name="nama_belakang" class="nama_belakang form-control" id="nama_belakang" value="">
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

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
            </div>
            <div class="modal-body">
                <p><b>Jika menghapus Guru maka</b></p>
                <p>*data guru tersebut hilang selamanya, apakah anda yakin?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" id="btn-hapus" data-target="#btn-hapus" class="btn btn-danger tambah_data" value="add">Hapus</button>
            </div>
        </div>
    </div>
</div>

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
        $('#table-guru').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            ajax: {
                url: "/guru",
                type: 'GET'
            },
            columns: [{
                    data: 'nama_guru',
                    name: 'nama_guru'
                },
                {
                    data: 'telepon',
                    name: 'telepon'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
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
        $('#btn-simpan').val("tambah-guru");
        $('#guru_id').val('');
        $('#formGuru').trigger("reset");
        $('#modal-judul').html("Tambah Guru");
        $('#tambahModal').modal('show');
    });

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika id = formguru panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    if ($("#formGuru").length > 0) {
        $("#formGuru").validate({
            submitHandler: function(form) {
                var actionType = $('#btn-simpan').val();
                // Mengubah data menjadi objek agar file image bisa diinput kedalam database
                var formData = new FormData($('#formGuru')[0]);
                $.ajax({
                    data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                    url: "/guru/store", //url simpan data
                    type: "POST", //data tipe kita kirim berupa JSON
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var oTable = $('#table-guru').dataTable(); //inialisasi datatable
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
                            $('#formGuru').find('input').val('');
                            $('#success_message').text(response.message);

                            $('#tambahModal').modal('hide');

                        }
                    }
                });
            }
        })
    }

</script>
@endsection