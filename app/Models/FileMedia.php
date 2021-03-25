<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FileMedia
 *
 * @property int $id
 * @property int|null $file_id
 * @property string $name
 * @property string $type
 * @property string|null $url
 * @property-read \App\Models\File|null $file
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereUrl($value)
 * @mixin \Eloquent
 */
class FileMedia extends Model
{
    public $timestamps = false;

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}