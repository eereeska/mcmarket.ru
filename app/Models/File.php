<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'category',
        'title',
        'name',
        'type',
        'description',
        'path',
        'extension',
        'version',
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

    public function getTabTitle()
    {
        $types = [
            'free' => 'Бесплатно',
            'paid' => 'Платно',
            'nulled' => 'Nulled'
        ];

        return $types[$this->type] . ' » ' . ($this->category ? $this->category->title . ' » ' : '') . $this->title . ($this->version ? ' ' . $this->version . ' ' : '');
    }
}