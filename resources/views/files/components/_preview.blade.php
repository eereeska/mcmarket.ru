<div class="flex items-center gap-x-3 gap-y-3">
    <a href="{{ route('admin.file.edit', ['id' => $file->id]) }}" class="w-16 h-16 bg-gray-200 bg-no-repeat bg-center bg-cover rounded-md" style="background-image: url({{ $file->getCover() }})"></a>
    <div class="flex-grow space-y-1">
        <ul class="flex items-center gap-x-2 text-gray-500">
            @if (request()->category != $file->category->name)
                <li class="hover:text-blue-500">
                    <a href="{{ route('home', ['category' => $file->category->name]) }}">{{ $file->category->title }}</a>
                </li>
                <li>
                    <i class="far fa-angle-right"></i>
                </li>
            @endif
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
        <ul class="flex items-center gap-x-2">
            <li>
                <a href="{{ route('user.show', ['user' => $file->user]) }}" class="text-blue-500">{{ $file->user->name }}</a>
            </li>
        </ul>
    </div>
</div>