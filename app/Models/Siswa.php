<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = "siswa";
    
    protected $fillable = [
        'nisn',
        'nama_depan',
        'nama_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_ibu',
        'nama_ayah',
        'agama',
        'alamat',
        'user_id',
        'kelas_id',
        'jurusan_id',
        'avatar'
    ];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/default.png');
        }

        return asset('images/'.$this->avatar);
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai']);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avg()
    {
        // Mengambil Nilai Siswa
        $total = 0;
        $hitung = 0;
        foreach($this->mapel as $mapel) {
            $total += $mapel->pivot->nilai;
            $hitung++;
        }
        

        return $hitung == 0 ? 0 : round($total / $hitung);
    }

    public function nama_lengkap()
    {
        return $this->nama_depan. ' ' .$this->nama_belakang;
    }
}
