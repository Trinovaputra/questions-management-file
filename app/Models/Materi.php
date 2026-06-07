<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materi extends Model
{
    use SoftDeletes;

    protected $table = 'materi';

    protected $fillable = [
        'title',
        'description',
        'type',
        'file_path',
        'youtube_url',
        'created_by'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getYoutubeIdAttribute()
    {
        if (!$this->youtube_url) {
            return null;
        }

        preg_match(
            '/(?:youtube\.com.*v=|youtu\.be\/)([^&]+)/',
            $this->youtube_url,
            $matches
        );

        return $matches[1] ?? null;
    }
}
