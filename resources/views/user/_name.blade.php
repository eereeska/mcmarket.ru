@if ($user->verified)
<h1>{{ $user->name }}<span class="badge verified" data-tooltip="Верифицированный участник"></span></h1>
@else
<h1>{{ $user->name }}</h1>
@endif