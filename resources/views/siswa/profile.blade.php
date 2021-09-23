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
                            <li><i class="fas fa-list-ol m-r-xxs"></i><span>Nomor Induk Siswa: <a href="javascript:void(0)">{{ $siswa->nisn}}</a></span></li>
                            <li><i class="far fa-user m-r-xxs"></i><span>Nama Lengkap: <a href="javascript:void(0)">{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</a></span></li>
                            <li><i class="fas fa-city m-r-xxs"></i><span>Tempat Lahir: <a href="javascript:void(0)">{{ $siswa->tempat_lahir }}</a></span></li>
                            <li><i class="fas fa-calendar-alt m-r-xxs"></i><span>Tanggal Lahir: <a href="javascript:void(0)">{{ $siswa->tanggal_lahir }}</a></span></li>
                            <li><i class="fas fa-venus-mars m-r-xxs"></i><span>Jenis Kelamin: <a href=javascript:void(0)">{{ $siswa->jenis_kelamin }}</a></span></li>
                            <li><i class="fas fa-male m-r-xxs"></i><span>Nama Ayah: <a href=javascript:void(0)">{{ $siswa->nama_ayah }}</a></span></li>
                            <li><i class="fas fa-female m-r-xxs"></i><span>Nama Ibu: <a href=javascript:void(0)">{{ $siswa->nama_ibu }}</a></span></li>
                            <li><i class="fas fa-pray m-r-xxs"></i><span>Agama: <a href="javascript:void(0)">{{ $siswa->agama }}</a></span></li>
                            <li><i class="far fa-address-book m-r-xxs"></i><span>Alamat: <a href="javascript:void(0)">{{ $siswa->alamat }}</a></span></li>
                            <li><i class="far fa-building m-r-xxs"></i><span>Kelas: <a href="javascript:void(0)">{{ $siswa->kelas->nama_kelas }}</a></span></li>
                            <li><i class="fas fa-desktop m-r-xxs"></i><span>Jurusan: <a href="javascript:void(0)">{{ $siswa->jurusan->nama_jurusan }}</a></span></li>
                            <li><i class="fas fa-book m-r-xxs"></i><span>Mata Pelajaran: <a href="javascript:void(0)">{{ $siswa->mapel->count() }}</a></span></li>
                            <li><i class="far fa-edit m-r-xxs"></i><span>Rata-Rata Nilai: <a href="javascript:void(0)">{{ $siswa->avg() }}</a></span></li>
                            <li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $siswa->id }}" data-original-title="Edit" class="edit btn btn-secondary btn-sm m-t-md edit-siswa">Edit Data Siswa</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-pills mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Kelas 10</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Kelas 11</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Kelas 12</a>
                    </li>
                </ul>
                <div class="card card-bg">
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <h5 class="mb-5">Daftar Nilai Siswa</h5>
                                <button type="button" class="btn btn-primary mb-5" id="btn_tambah" data-bs-toggle="modal" data-bs-target="#tambahNilai">Tambah Nilai</button>
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
                                            <td><a href="{{$mapel->id}}/deletenilai"><i class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                Placeholder content for the tab panel. This one relates to the home tab. Takes you miles high, so high, 'cause she’s got that one international smile. There's a stranger in my bed, there's a pounding in my head. Oh, no. In another life I would make you stay. ‘Cause I, I’m capable of anything. Suiting up for my crowning battle. Used to steal your parents' liquor and climb to the roof. Tone, tan fit and ready, turn it up cause its gettin' heavy. Her love is like a drug. I guess that I forgot I had a choice.
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                Placeholder content for the tab panel. This one relates to the home tab. Takes you miles high, so high, 'cause she’s got that one international smile. There's a stranger in my bed, there's a pounding in my head. Oh, no. In another life I would make you stay. ‘Cause I, I’m capable of anything. Suiting up for my crowning battle. Used to steal your parents' liquor and climb to the roof. Tone, tan fit and ready, turn it up cause its gettin' heavy. Her love is like a drug. I guess that I forgot I had a choice.
                            </div>
                        </div>
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
    <div class="modal fade" id="tambahNilai" style="overflow:hidden;" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <select class="form-control" name="mapel" id="selectmapel" tabindex="-1" style="display: none; width: 100%" required>
                                        <option selected disabled>-- Pilih Mata Pelajaran --</option>
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
                        <button type="submit" class="btn btn-primary tambah_data">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Nilai -->

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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        $(document).ready(function() {
            $('#myTab a').on('click', function (event) {
                event.preventDefault()
                $(this).tab('show')
            })
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

        $('#btn_tambah').click(function() {
            $('#tambahNilai').modal('show');
            $('#selectmapel').select2({
                dropdownParent: $('#tambahNilai')
            });
        });

        var chart = new ApexCharts(document.querySelector("#chartNilai"), options);
        chart.render();

        $(document).on('click', '.edit-siswa', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#editModal').modal('show');
            $('#jenis_kelamin').select2({
                dropdownParent: $('#editModal')
            });
            $('#kelas_id').select2({
                dropdownParent: $('#editModal')
            });
            $('#jurusan_id').select2({
                dropdownParent: $('#editModal')
            });
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
                        $('#nisn').val(response.nisn);
                        $('#nama_depan').val(response.nama_depan);
                        $('#nama_belakang').val(response.nama_belakang);
                        $('#tempat_lahir').val(response.tempat_lahir);
                        $('#tanggal_lahir').val(response.tanggal_lahir);
                        $('#jenis_kelamin').val(response.jenis_kelamin);
                        $('#nama_ibu').val(response.nama_ibu);
                        $('#nama_ayah').val(response.nama_ayah);
                        $('#agama').val(response.agama);
                        $('#alamat').val(response.alamat);
                        $('#avatar').val();
                        $('#kelas_id').val(response.kelas_id);
                        $('#jurusan_id').val(response.jurusan_id);
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

        $(document).ready(function () {
            $('#myTab a').on('click', function (event) {
                event.preventDefault()
                $(this).tab('show')
            })
            $('#myTab li:first-child a').tab('show') // Select first ta
        });
    </script>
@endsection