@if ($users->count() > 0)
<table class="table">
    <thead>
        <tr>
            <th>Пользователь</th>
            <th>Баланс</th>
            <th>Регистрация</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Пользователь</th>
            <th>Баланс</th>
            <th>Регистрация</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                <a href="{{ route('admin.user.edit', ['id' => $user->id] )}}" class="data">
                    <div class="data__icon data__icon_small avatar" style="background-image: url({{ $user->getAvatar() }})"></div>
                    <div class="data__info">
                        <h3 class="data__value">{{ $user->name }}</h3>
                    </div>
                </a>
            </td>
            <td>{{ $user->balance }}</td>
            <td title="{{ $user->created_at->format('h:i:s d.m.Y') }}">{{ $user->created_at->ago() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@else
@include('components._empty')
@endif