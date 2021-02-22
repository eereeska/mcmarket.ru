@foreach ($users as $user)
<div class="select__option" data-value="{{ $user->id }}">
    <div class="data">
        <div class="data__icon data__icon--small avatar" style="background-image: url({{ $user->getAvatar() }});"></div>
        <div class="data__info">
            <h3 class="data__value">{{ $user->name }}</h3>
        </div>
    </div>
</div>
@endforeach