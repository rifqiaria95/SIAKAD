@extends('master.template')
@section('master.intro-header')
    <div class="main-wrapper">
        <div class="row">
            <div class="col-xl-12">
                <div class="profile-cover"></div>
                <div class="profile-header">
                    <div class="profile-img">
                        <img src="{{ $guru->getAvatar() }}" alt="Avatar">
                    </div>
                    <div class="profile-name">
                        <h3>{{ $guru->nama }}</h3>
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
                        <h5 class="card-title">Biodata Guru</h5>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam, corrupti.</p>
                        <ul class="list-unstyled profile-about-list">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-bg">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Mata Pelajaran Yang Diajar</h5>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guru->mapel as $mapel)
                                <tr>
                                    <td>{{$mapel->kode}}</td>
                                    <td>{{$mapel->nama}}</td>
                                    <td>{{$mapel->semester}}</td>
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
@endsection