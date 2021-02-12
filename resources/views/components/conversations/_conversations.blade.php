@foreach ($conversations as $conversation)
<div class="data data_compact">
    <div class="data__icon avatar" style="background-image: url({{ $conversation->participants->where('user_id', '<>', auth()->user()->id)->first()->user->avatar }});"></div>
    <div class="data__info">
        <p class="data__value">123</p>
    </div>
</div>
@endforeach