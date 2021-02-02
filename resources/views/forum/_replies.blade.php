<div class="comment">
    <div class="avatar" @if ($reply->author->avatar) style="background-image: url({{ $reply->author->getAvatar() }})" @endif>{{ $reply->author->getInitials() }}</div>
    <div class="comment__info">
        <h3 class="comment__label">
            <a href="{{ route('user-show', ['name' => $reply->author->name]) }}">{{ $reply->author->name }}</a>
        </h3>
        <div class="comment__body">{!! $reply->body !!}</div>
    </div>
</div>