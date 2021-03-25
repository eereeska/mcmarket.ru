<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FileVersion
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion query()
 * @mixin \Eloquent
 */
class FileVersion extends Model
{
    protected $fillable = [
        'file_id',
        'version',
        'description'
    ];
}