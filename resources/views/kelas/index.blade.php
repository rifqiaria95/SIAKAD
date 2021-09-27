@extends('master.template')
@section('master.intro-header')

<div class="main-wrapper">
    <div class="row">
        <div class="col">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Kelas SMK Ti Tunas Harapan</h5>
                    <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
                    <a href="#" class="btn btn-success mb-5">Export Excel</a>
                    <a href="#" class="btn btn-danger mb-5">Export PDF</a>
                    <button type="button" id="importkelas" class="btn btn-success mb-5" data-bs-toggle="modal" data-bs-target="#importModal">Import Data kelas</button>
                    <table id="table-kelas" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Siswa -->
<div class="modal fade bd-example-modal-lg view-siswa" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-siswa">Lihat Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" width="100%">
                            <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                            </thead>
                            <tbody id="data-siswa">
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger mb-5">Export Siswa</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal View Siswa -->

<!-- Modal Tambah kelas -->
<div class="modal fade bd-example-modal-lg" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Tambah Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formkelas" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <ul id="save_errorList"></ul>
                    <div class="row g-3">
                        <div class="mb-3">
                            <label class="form-label">Nama kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" required>
                        </div>
                        <div class="form-floating col-md-6">
                            <fieldset class="form-group">
                                <select class="js-states form-control" name="guru_id" id="optionGuru" tabindex="-1" style="display: none; width: 100%">
                                    <option selected disabled>-- Pilih Guru --</option>
                                    @foreach ($guru as $gr)
                                    <option value="{{ $gr->id }}">{{ $gr->nama_guru }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-floating col-md-6">
                            <fieldset class="form-group">
                                <select class="js-states form-control" name="jurusan_id" id="optionJurusan" tabindex="-1" style="display: none; width: 100%">
                                    <option selected disabled>-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $jr)
                                    <option value="{{ $jr->id }}">{{ $jr->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block" id="btn-simpan" value="create">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Tambah kelas -->

<!-- Modal Edit kelas -->
<div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Edit Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" name="formEdit" class="form-horizontal">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <ul class="alert alert-warning d-none" id="modalJudulEdit"></ul>
                    <div class="row g-3">
                        <div class="mb-3">
                            <label class="form-label">Nama kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" required>
                        </div>
                        <div class="form-floating col-md-6">
                            <fieldset class="form-group">
                                <select class="js-states form-control" name="guru_id" id="guru_id" tabindex="-1" style="display: none; width: 100%">
                                    <option selected disabled>-- Pilih Guru --</option>
                                    @foreach ($guru as $gr)
                                    <option value="{{ $gr->id }}">{{ $gr->nama_guru }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-floating col-md-6">
                            <fieldset class="form-group">
                                <select class="js-states form-control" name="jurusan_id" id="jurusan_id" tabindex="-1" style="display: none; width: 100%">
                                    <option selected disabled>-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $jr)
                                    <option value="{{ $jr->id }}">{{ $jr->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
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
<!-- End Modal Edit kelas -->

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
            </div>
            <div class="modal-body">
                <p><b>Jika menghapus kelas maka</b></p>
                <p>*data kelas tersebut hilang selamanya, apakah anda yakin?</p>
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

    // Load Datatable
    // script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
        $('#table-kelas').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            ajax: {
                url: "/kelas",
                type: 'GET'
            },
            columns: [{
                    data: 'kode_kelas',
                    name: 'kode_kelas'
                },
                {
                    data: 'nama_kelas',
                    name: 'nama_kelas'
                },
                {
                    data: 'guru',
                    name: 'guru'
                },
                {
                    data: 'jurusan',
                    name: 'jurusan'
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

    // Fungsi Untuk Memanggil Modal Tambah
    $('#btn_tambah').click(function() {
        $('#btn-simpan').val("tambah-kelas");
        $('#guru_id').val();
        $('#formkelas').trigger("reset");
        $('#modal-judul').html("Tambah kelas");
        $('#tambahModal').modal('show');
        $('#optionGuru').select2({
            dropdownParent: $('#tambahModal')
        });
        $('#optionJurusan').select2({
            dropdownParent: $('#tambahModal')
        });
    });

    // Fungsi untuk memanggil modal view siswa/Menampilkan Data Siswa Berdasarkan
    // Id kelas yang dimiliki oleh siswa
    $(document).on('click', '.view-siswa', function (e) {
        e.preventDefault();
        var parent = $(this).data('id');
        $('#viewModal').modal('show');
        $.ajax({
            type:"GET",
            data:"id=" + parent,
            url:"/kelas/view",
            success: function(response) {
                // console.log(response);
                var siswa = "";
                if(response){
                    $.each(response,function(index, val){
                    $('#judul-siswa').text('Lihat Data Siswa ' + val.kelas);
                    siswa += "<tr>";
                        siswa += "<td>"+val.nisn+"</td>";
                        siswa += "<td>"+val.nama_depan+"</td>";
                        siswa += "<td>"+val.jenis_kelamin+"</td>";
                    siswa+="</tr>";
                    });
                    $("#data-siswa").html(siswa);
                }
            }
        });
        
    });

    // Fungsi untuk memanggil modal edit dan memunculkan data berdasarkan id kelas
    $(document).on('click', '.edit-kelas', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editModal').modal('show');
        $('#guru_id').select2({
            dropdownParent: $('#editModal')
        });
        $('#jurusan_id').select2({
            dropdownParent: $('#editModal')
        });
        $.ajax({
            type: "GET",
            url: "/kelas/edit/" + id,
            success: function(response) {
                console.log(response);
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').modal('hide');
                } else {
                    $('#id').val(id);
                    $('#kode_kelas').val(response.kode_kelas);
                    $('#nama_kelas').val(response.nama_kelas);
                    $('#guru_id').val(response.guru_id);
                    $('#jurusan_id').val(response.jurusan_id);
                }
            }
        });
        $('.btn-close').find('input').val('');

    });

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika id = formkelas panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    if ($("#formkelas").length > 0) {
        $("#formkelas").validate({
            submitHandler: function(form) {
                var actionType = $('#btn-simpan').val();
                // Mengubah data menjadi objek agar file image bisa diinput kedalam database
                var formData = new FormData($('#formkelas')[0]);
                $.ajax({
                    data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                    url: "/kelas/store", //url simpan data
                    type: "POST", //data tipe kita kirim berupa JSON
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var oTable = $('#table-kelas').dataTable(); //inialisasi datatable
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
                            $('#modalJudul').html("");
                            $('#formkelas').find('input').val('');
                            toastr.success(response.message);

                            $('#tambahModal').modal('hide');

                        }
                    }
                });
            }
        })
    }

    // Fungsi untuk menyimpan data setelah melakukan edit data
    $(document).on('submit', '#formEdit', function(e) {
        e.preventDefault();
        var id = $('#id').val();

        // Mengubah data menjadi objek agar file image bisa diinput kedalam database
        var EditFormData = new FormData($('#formEdit')[0]);

        $.ajax({
            type: "POST",
            url: "/kelas/update/" + id,
            data: EditFormData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                var oTable = $('#table-kelas').dataTable(); //inialisasi datatable
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
                    toastr.success(response.message);
                }
                else if(response.status == 200)
                {
                    $('#modalJudulEdit').html("");
                    toastr.success(response.message);

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
            url: "/kelas/delete/" + id, //eksekusi ajax ke url ini
            type: 'delete',
            beforeSend: function() {
                $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
            },
            success: function(response) { //jika sukses
                setTimeout(function() {
                    $('#modalHapus').modal('hide');
                    var oTable = $('#table-kelas').dataTable();
                    oTable.fnDraw(false); //reset datatable
                    if(response.status == 404)
                    {
                        toastr.success(response.message);
                    }
                    else if(response.status == 200)
                    {
                        toastr.success(response.message);
                    }
                });
            }
        })
    });
</script>
@endsection