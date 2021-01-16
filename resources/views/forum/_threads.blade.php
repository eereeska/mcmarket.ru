@forelse ($threads as $thread)
<div class="data">
    <div class="avatar" @if ($thread->author->avatar) style="background-image: url({{ $thread->author->avatar }})" @endif>{{ $thread->author->getInitials() }}</div>
    <div class="data__info">
        <h3 class="data__value"><a href="{{ route('forum-thread-show', ['id' => $thread->id]) }}">{{ $thread->title }}</a></h3>
        <div class="data__desc">
            <a href="{{ route('user-show', ['name' => $thread->author->name]) }}">{{ $thread->author->name }}</a>
            <time datetime="{{ $thread->created_at->format('Y-m-d\TH:i:s.uP') }}">{{ $thread->created_at->ago() }}</time>
            <span>— {{ $thread->views}} {{ trans_choice('просмотр|просмотра|просмотров', $thread->views, [], 'ru') }}, {{ $thread->replies_count > 0 ? trans_choice('ответ|ответа|ответов', $thread->replies_count, [], 'ru') : 'нет ответов' }}</span>
        </div>
    </div>
</div>
@empty
<p class="alert empty small">Ничего не найдено</p>
@endforelse
{{ $threads->onEachSide(0)->links() }}