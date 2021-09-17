<?php

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Mapel;

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

function totalGuru()
{
    return Guru::count();
}

function totalMapel()
{
    return Mapel::count();
}