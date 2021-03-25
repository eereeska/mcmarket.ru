<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $role_id
 * @property float $balance
 * @property string $ip
 * @property string|null $avatar
 * @property string|null $password
 * @property int $verified
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $last_seen_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $followers
 * @property-read int|null $followers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $ownGroups
 * @property-read int|null $own_groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Conversation[] $participiedConversations
 * @property-read int|null $participied_conversations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $purchasedFiles
 * @property-read int|null $purchased_files_count
 * @property-read \App\Models\Role $role
 * @property-read \App\Models\UserSettings|null $settings
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastSeenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerified($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'ip'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'ip'
    ];

    protected $dates = [
        'last_seen_at',
        'email_verified_at',
        'updated_at',
        'created_at'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function settings()
    {
        return $this->hasOne(UserSettings::class, 'user_id', 'id');
    }

    public function files()
    {
        return $this->belongsToMany(File::class);
    }

    public function purchasedFiles()
    {
        return $this->belongsToMany(File::class, 'file_purchases', 'user_id', 'id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_followers');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_members');
    }

    public function ownGroups()
    {
        return $this->belongsToMany(Group::class, null, 'id', 'owner_id');
    }

    public function participiedConversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_participants', 'user_id', 'id');
    }

    public function conversations()
    {
        return $this->hasMany(ConversationParticipant::class)->pluck('conversation');
    }

    public function hasRole($role)
    {
        return ($this->roles && $this->roles->pluck('name')->contains($role));
    }

    public function hasPurchasedFile($file)
    {
        return FilePurchase::where([
            'file_id' => $file->id,
            'user_id' => $this->id
        ])->exists();
    }

    public function getAvatar()
    {
        return $this->avatar ? asset('avatars/' . $this->avatar) : asset('images/default_avatar.svg');
    }

    public function getInitials($length = 1)
    {
        preg_match_all('#([A-Z0-9]+)#', strtoupper($this->name), $capitals);

        if (count($capitals[1]) >= $length) {
            return substr(implode('', $capitals[1]), 0, $length);
        }

        return strtoupper(substr($this->name, 0, $length));
    }

    public function getOnlineStatus()
    {
        if (is_null($this->last_seen_at)) {
            return 'Оффлайн';
        }
        
        if ($this->last_seen_at->gt(now()->subMinutes(5))) {
            return 'Сейчас онлайн';
        } else {
            return 'Был(-а) онлайн ' . $this->last_seen_at->ago();
        }
    }
}