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
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-bg">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Mata Pelajaran</h5>
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
    </div>
@endsection