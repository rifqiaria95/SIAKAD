<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    // protected $table = "post";
    protected $dates = ['created_at'];

    protected $fillable = [
        'title',
        'content',
        'thumbnail',
        'slug',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail()
    {
        if(!$this->thumbnail) {
            return asset('thumbnail.png');
        }
        return $this->thumbnail;
    }
}
