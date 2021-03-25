<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserFollower
 *
 * @property int $id
 * @property int $user_id
 * @property int $follower_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $follower
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower whereFollowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollower whereUserId($value)
 * @mixin \Eloquent
 */
class UserFollower extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}