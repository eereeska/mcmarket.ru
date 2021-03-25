<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FilePurchase
 *
 * @property int $id
 * @property int $file_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\File $file
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereUserId($value)
 * @mixin \Eloquent
 */
class FilePurchase extends Model
{
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}