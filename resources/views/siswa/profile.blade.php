@extends('master.template')
@section('master.intro-header')
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl-12">
                <div class="profile-cover"></div>
                <div class="profile-header">
                    <div class="profile-img">
                        <img src="{{ $siswa->getAvatar() }}" alt="">
                    </div>
                    <div class="profile-name">
                        <h3>{{ $siswa->nama_depan }}</h3>
                    </div>
                    <div class="profile-header-menu">
                        <ul class="list-unstyled">
                            <li><a href="#">Edit Banner</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Biodata Siswa</h5>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam, corrupti.</p>
                        <ul class="list-unstyled profile-about-list">
                            <li><i class="far fa-user m-r-xxs"></i><span>Nama Lengkap <a href="#">{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</a></span></li>
                            <li><i class="fas fa-venus-mars m-r-xxs"></i><span>Jenis Kelamin: <a href="">{{ $siswa->jenis_kelamin }}</a></span></li>
                            <li><i class="fas fa-pray m-r-xxs"></i><span>Agama: <a href="#">{{ $siswa->agama }}</a></span></li>
                            <li><i class="far fa-address-book m-r-xxs"></i><span>Alamat: <a href="#">{{ $siswa->alamat }}</a></span></li>
                            <li><i class="fas fa-book m-r-xxs"></i><span>Mata Pelajaran: <a href="#">{{ $siswa->mapel->count() }}</a></span></li>
                            <li><i class="far fa-building m-r-xxs"></i><span>Rata-Rata Nilai <a href="#">{{ $siswa->avg() }}</a></span></li>
                            <li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $siswa->id }}" data-original-title="Edit" class="edit btn btn-secondary btn-sm m-t-md edit-siswa">Edit Data Siswa</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-bg">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Mata Pelajaran</h5>
                        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahNilai">Tambah Nilai</button>
                        @if(session('sukses'))
                            <div class="alert alert-success" role="alert">
                            {{ session('sukses') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                            </div>
                        @endif
                        <table id="zero-conf" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Mata Pelajaran</th>
                                    <th>Semester</th>
                                    <th>Nilai</th>
                                    <th>Guru</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa->mapel as $mapel)
                                <tr>
                                    <td>{{ $mapel->kode }}</td>
                                    <td>{{ $mapel->nama }}</td>
                                    <td>{{ $mapel->semester }}</td>
                                    <td>{{ $mapel->pivot->nilai }}</td>
                                    <td><a href="/guru/{{$mapel->guru_id}}/profile">{{ $mapel->guru->nama_guru }}</a></td>
                                    <td><a href="{{$mapel->id}}/deletenilai" class="btn btn-danger btn-sm mr-1 mb-1">Hapus</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-bg">
                    <div id="chartNilai" class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Nilai -->
    <div class="modal fade" id="tambahNilai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formSiswa" action="addnilai" method="POST">
                    @csrf
                    <div class="modal-body">
                        <ul id="save_errList"></ul>
                        <div class="row g-3">
                            <div class="form-floating" {{ $errors->has('mapel') ? 'has-error' : '' }}>
                                <fieldset class="form-group">
                                    <select class="form-control" name="mapel" required>
                                        @foreach ($matapelajaran as $mp)
                                            <option value="{{ $mp->id }}">{{ $mp->nama }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('mapel'))
                                        <span class="help-block">{{ $errors->first('mapel') }}</span>
                                    @endif
                                </fieldset>
                            </div>
                            <div class="mb-3" {{ $errors->has('nilai') ? 'has-error' : '' }}>
                                <label for="nilai" class="form-label">Nilai</label>
                                <input type="text" name="nilai"  class="nilai form-control" value="{{old('nilai') }}" required>
                                @if($errors->has('nilai'))
                                    <span class="help-block">{{ $errors->first('nilai') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success tambah_data">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Nilai -->

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

    <script src="{{ asset('template/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        var options = {
            series: [{
            name: 'Nilai',
            data: {!!json_encode ($data)!!},
            }],
            chart: {
            type: 'bar',
            height: 350
            },
            plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
            },
            dataLabels: {
            enabled: false
            },
            stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
            },
            xaxis: {
            categories: {!!json_encode ($categories)!!},
            },
            yaxis: {
            title: {
                text: 'Nilai'
            }
            },
            fill: {
            opacity: 1
            },
            tooltip: {
            y: {
                formatter: function (val) {
                return "" + val + ""
                }
            }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartNilai"), options);
        chart.render();

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
    </script>
@endsection