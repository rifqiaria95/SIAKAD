@extends('master.template')
@section('master.intro-header')

<div class="main-wrapper">
    <div class="row">
        <div class="col">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Mata Pelajaran</h5>
                    <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
                    <a href="#" class="btn btn-success mb-5">Export Excel</a>
                    <a href="#" class="btn btn-danger mb-5">Export PDF</a>
                    <button type="button" id="importmapel" class="btn btn-success mb-5" data-bs-toggle="modal" data-bs-target="#importModal">Import Data Mapel</button>
                    <table id="table-mapel" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Mata Pelajaran</th>
                                <th>Semester</th>
                                <th>Guru</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah mapel -->
<div class="modal fade bd-example-modal-lg" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Tambah Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formMapel" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <ul id="save_errorList"></ul>
                    <div class="row g-3">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama Mapel</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Semester</label>
                            <input type="text" name="semester" class="form-control">
                        </div>
                        <div class="form-floating">
                            <fieldset class="form-group">
                                <select class="js-states form-control" name="guru_id" id="optionGuru" tabindex="-1" style="display: none; width: 100%">
                                    <option selected disabled>-- Pilih Guru --</option>
                                    @foreach ($guru as $gr)
                                    <option value="{{ $gr->id }}">{{ $gr->nama_guru }}</option>
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
<!-- End Modal Tambah mapel -->

<!-- Modal Edit mapel -->
<div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul">Edit Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" name="formEdit" class="form-horizontal">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <ul class="alert alert-warning d-none" id="modalJudulEdit"></ul>
                    <div class="row g-3">
                        <div class="mb-3 col-md-6">
                            <label for="nama" class="form-label">Nama Mapel</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Semester</label>
                            <input type="text" name="semester" class="form-control" id="semester" value="">
                        </div>
                        <select class="js-states form-control" name="guru_id" id="guru_id" tabindex="-1" style="display: none; width: 100%">
                            <optgroup label="Pilih Guru">
                                @foreach ($guru as $gr)
                                <option value="{{ $gr->id }}">{{ $gr->nama_guru }}</option>
                                @endforeach
                            </optgroup>
                        </select>
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
<!-- End Modal Edit mapel -->

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
            </div>
            <div class="modal-body">
                <p><b>Jika menghapus mapel maka</b></p>
                <p>*data mapel tersebut hilang selamanya, apakah anda yakin?</p>
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
        $('#table-mapel').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            ajax: {
                url: "/mapel",
                type: 'GET'
            },
            columns: [{
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'semester',
                    name: 'semester'
                },
                {
                    data: 'guru',
                    name: 'guru'
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
        $('#btn-simpan').val("tambah-mapel");
        $('#guru_id').val();
        $('#formMapel').trigger("reset");
        $('#modal-judul').html("Tambah Mapel");
        $('#tambahModal').modal('show');
        $('#optionGuru').select2({
            dropdownParent: $('#tambahModal')
        });
    });

    $(document).on('click', '.edit-mapel', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editModal').modal('show');
        $('#guru_id').select2({
            dropdownParent: $('#editModal')
        });
        $.ajax({
            type: "GET",
            url: "/mapel/edit/" + id,
            success: function(response) {
                console.log(response);
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').modal('hide');
                } else {
                    $('#id').val(id);
                    $('#kode').val(response.kode);
                    $('#nama').val(response.nama);
                    $('#semester').val(response.semester);
                    $('#guru_id').val(response.guru_id);
                }
            }
        });
        $('.btn-close').find('input').val('');

    });

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika id = formMapel panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    if ($("#formMapel").length > 0) {
        $("#formMapel").validate({
            submitHandler: function(form) {
                var actionType = $('#btn-simpan').val();
                // Mengubah data menjadi objek agar file image bisa diinput kedalam database
                var formData = new FormData($('#formMapel')[0]);
                $.ajax({
                    data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                    url: "/mapel/store", //url simpan data
                    type: "POST", //data tipe kita kirim berupa JSON
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var oTable = $('#table-mapel').dataTable(); //inialisasi datatable
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
                            $('#formMapel').find('input').val('');
                            toastr.success(response.message);

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
            url: "/mapel/update/" + id,
            data: EditFormData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                var oTable = $('#table-mapel').dataTable(); //inialisasi datatable
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
            url: "/mapel/delete/" + id, //eksekusi ajax ke url ini
            type: 'delete',
            beforeSend: function() {
                $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
            },
            success: function(response) { //jika sukses
                setTimeout(function() {
                    $('#modalHapus').modal('hide');
                    var oTable = $('#table-mapel').dataTable();
                    oTable.fnDraw(false); //reset datatable
                    if(response.status == 404)
                    {
                        alert(response.message);
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