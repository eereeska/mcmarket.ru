@if ($file->cover_path)
    <section class="mb-6">
        <img src="{{ $file->getCover() }}" alt="{{ $file->title }}" class="w-full rounded-md">
    </section>
@elseif (auth()->id() == $file->user_id)
    <section class="mb-6">
        <a href="{{ route('file.edit', ['id' => $file->id])  . '#cover' }}" class="block bg-gray-200 rounded-md px-2 py-2 font-semibold text-center hover:text-blue-500">Добавьте обложку</a>
    </section>
@endif