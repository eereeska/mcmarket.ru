<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserSettings
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $about
 * @property int $is_search_engine_visible
 * @property int $is_online_status_visible
 * @property string $groups_visible
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSettings whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSettings whereGroupsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSettings whereIsOnlineStatusVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSettings whereIsSearchEngineVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSettings whereUserId($value)
 * @mixin \Eloquent
 */
class UserSettings extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'about',
        'is_search_engine_visible',
        'is_online_status_visible',
        'is_activity_visible'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}