<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\File
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $category_id
 * @property string $title
 * @property string $name
 * @property string $type
 * @property string $path
 * @property int $size
 * @property float|null $price
 * @property string|null $cover_path
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $version
 * @property string|null $extension
 * @property string|null $donation_url
 * @property string|null $vt_id
 * @property string|null $vt_status
 * @property array|null $vt_stats
 * @property string|null $vt_hash
 * @property int $views_count
 * @property int $downloads_count
 * @property int $is_visible
 * @property int $is_approved
 * @property \Illuminate\Support\Carbon|null $version_updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\FileCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FileMedia[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FilePurchase[] $purchases
 * @property-read int|null $purchases_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCoverPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDonationUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDownloadsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereVersionUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereViewsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereVtHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereVtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereVtStats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereVtStatus($value)
 * @mixin \Eloquent
 */
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