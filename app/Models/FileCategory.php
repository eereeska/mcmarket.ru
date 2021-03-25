<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FileCategory
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $icon
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $files
 * @property-read int|null $files_count
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory whereTitle($value)
 * @mixin \Eloquent
 */
class FileCategory extends Model
{
    public $timestamps = false;
    
    public function files()
    {
        return $this->belongsToMany(File::class);
    }
}