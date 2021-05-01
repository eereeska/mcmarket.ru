<div class="flex items-center gap-x-3 gap-y-3">
    <a href="{{ route('file.show', ['id' => $file->id]) }}" class="w-16 h-16 bg-gray-200 bg-no-repeat bg-center bg-cover rounded-md" style="background-image: url({{ $file->getCover() }})"></a>
    <div class="flex-grow space-y-1">
        <ul class="flex flex-wrap items-center gap-x-2 text-gray-500">
            <li class="font-semibold text-black hover:text-blue-500">
                <a href="{{ route('file.show', ['id' => $file->id]) }}">{{ $file->name }}</a>
            </li>
            @if ($file->version)
                <li>
                    <i class="far fa-angle-right"></i>
                </li>
                <li class="text-gray-500">{{ $file->version }}</li>
            @endif
            @if ($file->price)
                <li class="ml-auto font-semibold">
                    <span>{{ $file->price }}</span>
                    <i class="far fa-ruble-sign text-sm"></i>
                </li>
            @endif
        </ul>
        <ul class="flex flex-wrap items-center gap-x-2 text-gray-500 ">
            <li class="hover:text-blue-500">
                <i class="far fa-user text-sm"></i>
                <a href="{{ route('user.show', ['name' => $file->user->name]) }}">{{ $file->user->name }}</a>
            </li>
            <li class="hover:text-blue-500">
                <i class="far fa-folder text-sm"></i>
                <a href="{{ route('home', ['category' => $file->category->name]) }}">{{ $file->category->title }}</a>
            </li>
            @if ($file->version_updated_at and $file->version_updated_at != $file->created_at)
                <li title="Обновлён {{ $file->version_updated_at->format('d.m.Y h:i:s') }}">
                    <i class="far fa-history text-sm"></i>
                    <time datetime="{{ $file->version_updated_at->toAtomString() }}">{{ $file->version_updated_at->ago() }}</time>
                </li>
            @else
                <li title="Добавлен {{ $file->created_at->format('d.m.Y h:i:s') }}">
                    <i class="far fa-clock text-sm"></i>
                    <time datetime="{{ $file->created_at->toAtomString() }}">{{ $file->created_at->ago() }}</time>
                </li>
            @endif
        </ul>
    </div>
</div>