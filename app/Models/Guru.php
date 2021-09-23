<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = "guru";
    protected $fillable = [
        'user_id',
        'nign',
        'nama_guru',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'telepon',
        'alamat',
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
        return $this->hasMany(Mapel::class);
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
