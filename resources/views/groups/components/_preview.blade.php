<div class="flex items-center gap-x-3 gap-y-3">
    <a href="{{ route('group.show', ['slug' => $group->slug]) }}" class="w-16 h-16 bg-gray-200 bg-no-repeat bg-center bg-cover rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="background-image: url({{ $group->getCover() }})"></a>
    <div class="flex-grow space-y-1">
        <ul class="flex flex-wrap items-center gap-x-2 text-gray-500">
            <li class="font-semibold text-black hover:text-blue-500">
                <a href="{{ route('group.show', ['slug' => $group->slug]) }}" class="focus:outline-none focus:text-blue-500">{{ $group->name }}</a>
            </li>
        </ul>
        <ul class="flex flex-wrap items-center gap-x-2 text-gray-500 ">
            <li>
                <i class="far fa-users"></i>
                <span>0 участников</span>
            </li>
        </ul>
    </div>
</div>