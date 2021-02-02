@if ($user->avatar)
<div @if (isset($id)) id="{{ $id }}" @endif class="avatar{{ (isset($large) and $large) ? ' large' : '' }}" style="background-image: url({{ $user->getAvatar() }})"></div>
@else
<div @if (isset($id)) id="{{ $id }}" @endif class="avatar{{ (isset($large) and $large) ? ' large' : '' }}"></div>
@endif