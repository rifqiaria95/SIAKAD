@extends('master.template')
@section('master.intro-header')

<div class="main-wrapper">
    <div class="row">
        <div class="col">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Semua User</h5>
                    <table id="table-user" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Join Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
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
                <p><b>Jika menghapus user maka</b></p>
                <p>*data user tersebut hilang selamanya, apakah anda yakin?</p>
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
        $('#table-user').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            ajax: {
                url: "/user",
                type: 'GET'
            },
            columns: [{
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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

    // //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
    // $('body').on('click', '.delete', function() {
    //     id = $(this).attr('id');
    //     $('#modalHapus').modal('show');
    // });
    // //jika tombol hapus pada modal konfirmasi di klik maka
    // $('#btn-hapus').click(function() {
    //     $.ajax({
    //         url: "/user/delete/" + id, //eksekusi ajax ke url ini
    //         type: 'delete',
    //         beforeSend: function() {
    //             $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
    //         },
    //         success: function(response) { //jika sukses
    //             setTimeout(function() {
    //                 $('#modalHapus').modal('hide');
    //                 var oTable = $('#table-user').dataTable();
    //                 oTable.fnDraw(false); //reset datatable
    //                 if(response.status == 404)
    //                 {
    //                     alert(response.message);
    //                 }
    //                 else if(response.status == 200)
    //                 {
    //                     $('#success_message').addClass('alert alert-success');
    //                     $('#success_message').text(response.message);
    //                 }
    //             });
    //         }
    //     })
    // });
</script>
@endsection