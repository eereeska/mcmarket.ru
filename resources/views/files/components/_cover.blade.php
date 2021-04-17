@if ($file->cover_path)
    <img src="{{ $file->getCover() }}" alt="{{ $file->title }}" class="rounded-md">
@else
    <a href="{{ route('file.edit', ['id' => $file->id])  . '#cover' }}" class="block bg-gray-200 rounded-md px-2 py-2 font-semibold text-center hover:text-blue-500">Добавьте обложку</a>
@endif