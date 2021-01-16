@if ($user->avatar)
<div class="avatar{{ (isset($large) and $large) ? ' large' : '' }}" style="background-image: url({{ $user->getAvatar() }})"></div>
@else
<div class="avatar{{ (isset($large) and $large) ? ' large' : '' }}" style="background-image: url({{ $user->getAvatar() }})">{{ $user->getInitials() }}</div>
@endif