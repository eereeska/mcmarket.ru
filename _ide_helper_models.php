<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Articles{
/**
 * App\Models\Articles\Article
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 */
	class Article extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ban
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $by_id
 * @property string|null $reason
 * @property string|null $expire_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $by
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Ban newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ban newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ban query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ban whereById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ban whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ban whereExpireAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ban whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ban whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ban whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ban whereUserId($value)
 */
	class Ban extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Conversation
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConversationParticipant[] $participants
 * @property-read int|null $participants_count
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereUpdatedAt($value)
 */
	class Conversation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ConversationMessage
 *
 * @property int $id
 * @property int $conversation_id
 * @property int $participant_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conversation $conversation
 * @property-read \App\Models\User $participant
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereUpdatedAt($value)
 */
	class ConversationMessage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ConversationParticipant
 *
 * @property int $id
 * @property int $conversation_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conversation $conversation
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereUserId($value)
 */
	class ConversationParticipant extends \Eloquent {}
}

namespace App\Models\Files{
/**
 * App\Models\Files\File
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $user_id
 * @property string $state
 * @property string $title
 * @property string $name
 * @property string $description
 * @property string|null $price
 * @property string|null $keywords
 * @property string|null $donation_url
 * @property string|null $source_code_url
 * @property int $views_count
 * @property int $downloads_count
 * @property string|null $cover_updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Files\FileCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Files\FileMedia[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Files\FilePurchase[] $purchases
 * @property-read int|null $purchases_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCoverUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDonationUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDownloadsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSourceCodeUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereViewsCount($value)
 */
	class File extends \Eloquent {}
}

namespace App\Models\Files{
/**
 * App\Models\Files\FileCategory
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $icon
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Files\File[] $files
 * @property-read int|null $files_count
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileCategory whereTitle($value)
 */
	class FileCategory extends \Eloquent {}
}

namespace App\Models\Files{
/**
 * App\Models\Files\FileMedia
 *
 * @property int $id
 * @property int|null $file_id
 * @property string $name
 * @property string $type
 * @property string|null $url
 * @property-read \App\Models\Files\File|null $file
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileMedia whereUrl($value)
 */
	class FileMedia extends \Eloquent {}
}

namespace App\Models\Files{
/**
 * App\Models\Files\FilePurchase
 *
 * @property int $id
 * @property int $user_id
 * @property int $file_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Files\File $file
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilePurchase whereUserId($value)
 */
	class FilePurchase extends \Eloquent {}
}

namespace App\Models\Files{
/**
 * App\Models\Files\FileVersion
 *
 * @property int $id
 * @property int $file_id
 * @property string $state
 * @property string|null $title
 * @property string|null $description
 * @property string|null $url
 * @property string|null $hash
 * @property string|null $extension
 * @property int|null $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Files\File $file
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileVersion whereUrl($value)
 */
	class FileVersion extends \Eloquent {}
}

namespace App\Models\Groups{
/**
 * App\Models\Groups\Group
 *
 * @property int $id
 * @property int|null $owner_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string $type
 * @property \Illuminate\Support\Carbon $cover_updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Groups\GroupMember[] $members
 * @property-read int|null $members_count
 * @property-read \App\Models\User|null $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCoverUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUpdatedAt($value)
 */
	class Group extends \Eloquent {}
}

namespace App\Models\Groups{
/**
 * App\Models\Groups\GroupMember
 *
 * @property int $id
 * @property int $group_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereUserId($value)
 */
	class GroupMember extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property string $gateway_id
 * @property int $user_id
 * @property float $sum
 * @property string|null $complete_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCompleteAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property float $balance
 * @property string|null $ip
 * @property string|null $avatar
 * @property string|null $password
 * @property int $is_admin
 * @property int $is_moderator
 * @property int $is_verified
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $last_seen_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Files\File[] $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $followers
 * @property-read int|null $followers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Files\File[] $purchasedFiles
 * @property-read int|null $purchased_files_count
 * @property-read \App\Models\UserSettings|null $settings
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsModerator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastSeenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
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
 */
	class UserFollower extends \Eloquent {}
}

namespace App\Models{
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
 */
	class UserSettings extends \Eloquent {}
}

