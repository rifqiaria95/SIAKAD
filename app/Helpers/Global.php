<?php

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;

function ranking5Besar()
{
    $siswa = Siswa::all();
    $siswa->map(function($s){
        $s->rataRataNilai = $s->avg();
        return $s;
    });
    $siswa = $siswa->sortByDesc('rataRataNilai')->take(5);
    return $siswa;
}

function totalSiswa()
{
    return Siswa::count();
}

function totalKelas()
{
    return Kelas::count();
}

function totalGuru()
{
    return Guru::count();
}

function totalMapel()
{
    return Mapel::count();
}