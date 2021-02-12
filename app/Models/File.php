<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'category',
        'title',
        'short_title',
        'type',
        'description',
        'version',
        'custom_url',
        'donation_url',
        'keywords',
        'version_updated_at'
    ];

    protected $casts = [
        'vt_stats' => 'json',
        'version_updated_at' => 'datetime'
    ];
    
    public function category()
    {
        return $this->belongsTo(FileCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(FilePurchase::class);
    }
    
    public function media()
    {
        return $this->hasMany(FileMedia::class);
    }

    public function getSizeForHumans()
    {
        $units = ['Б', 'КБ', 'МБ', 'ГБ', 'ТБ', 'ПБ'];

        for ($i = 0; $this->size > 1024; $i++) {
            $this->size /= 1024;
        }

        return round($this->size, 2) . ' ' . $units[$i];
    }
}