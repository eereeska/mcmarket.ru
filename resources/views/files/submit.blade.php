@extends('layouts.app')

@section('meta.title', 'Добавление файла')
@section('meta.robots', 'noindex')

@section('content')
<div class="flex flex-wrap gap-10 w-full max-w-screen-lg mx-auto px-4 my-12 lg:flex-nowrap lg:px-0">
    <main class="w-full md:w-2/5 mx-auto">
        <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="mb-6">
                <label for="category" class="block mb-3 text-gray-500">Категория <span class="text-red-500">*</span></label>
                <select name="category" class="w-full">
                    <option disabled selected value>Не указана</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}" @if ($category->name == request()->get('category')) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <p class="mt-2 text-red-600">{{ $errors->first('category') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="title" class="block mb-3 text-gray-500">Заголовок <span class="text-red-500">*</span></label>
                <input type="text" name="title" placeholder="От 4 до 80 символов" value="{{ old('title') }}" required minlength="4" maxlength="80" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('title'))
                    <p class="mt-2 text-red-600">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-3 text-gray-500">Название <span class="text-red-500">*</span></label>
                <input type="text" name="name" placeholder="От 3 до 24 символов" value="{{ old('name') }}" required minlength="3" maxlength="24" class="w-full border rounded-md px-3 py-2 
                focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('name'))
                    <p class="mt-2 text-red-600">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-3 text-gray-500">Файл <span class="text-red-500">*</span></label>
                <div class="flex items-center mb-3">
                    <input id="file_submit_type-upload" name="file_submit_type" type="radio" value="upload" class="w-4 h-4 text-blue-500 focus:ring-indigo-400">
                    <label for="file_submit_type-upload" class="ml-2 font-medium text-gray-700">Загрузка <span class="text-gray-500">(до 5 мб)</span></label>
                </div>
                <div x-data="{selected: null}" class="pl-7">
                    <input type="file" name="file" class="hidden" accept=".{{ implode(',.', config('mcm.files.allowed_extensions')) }}" x-on:change="selected = $event.target.files.length ? $event.target.files[0].name : null">
                    <p x-show="selected != null" x-text="selected" class="mb-2 break-words"></p>
                    <button type="button" class="bg-gray-200 rounded-md px-3 py-2 hover:bg-gray-300 focus:shadow-outline focus:outline-none" onclick="mcm.click('input[name=file]'); mcm.check('#file_submit_type-upload')">Выберите файл</button>
                </div>
                @if ($errors->has('file'))
                    <p class="mt-2 text-red-600">{{ $errors->first('file') }}</p>
                @endif
                @if ($errors->has('file_already_exists'))
                    <p class="my-4 text-red-600">{{ $errors->first('file_already_exists') }}</p>
                    @if (session()->has('existed_file'))
                        @include('files.components._preview', ['file' => session()->get('existed_file')])
                    @endif
                @endif
                <div class="flex items-center mt-4 mb-3">
                    <input id="file_submit_type-url" name="file_submit_type" type="radio" value="url" class="w-4 h-4 text-blue-500 focus:ring-indigo-400">
                    <label for="file_submit_type-url" class="ml-2 font-medium text-gray-700">Прямая ссылка на скачивание</label>
                </div>
                <div class="pl-7">
                    <input type="text" name="url" placeholder="Yandex.Disk, Google Drive, AnonFiles" value="{{ old('url') }}" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300" onfocus="mcm.check('#file_submit_type-url')">
                </div>
                @if ($errors->has('name'))
                    <p class="mt-2 text-red-600">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="cover" class="block mb-3 text-gray-500">Обложка <span class="text-gray-500">(до 5 мб)</span></label>
                <div x-data="mcm.imageViewer()" class="text-center border-2 border-dashed border-gray-300 rounded-md px-6 py-6 transition-colors select-none" :class="{'border-blue-300' : dragOver}" x-on:dragover.prevent="dragOver = true" x-on:dragleave.prevent="dragOver = false" x-on:drop.prevent="drop">
                    <input type="file" name="cover" class="hidden opacity-0" accept="image/*" x-ref="cover" x-on:change="fileChosen">
                    <template x-if="url">
                        <img :src="url" class="bg-no-repeat bg-center bg-cover rounded-md mx-auto mb-4">
                    </template>
                    <p class="mb-4">Перенесите в это поле и бросьте или</p>
                    <button type="button" class="bg-gray-200 rounded-md px-3 py-2 hover:bg-gray-300 focus:shadow-outline focus:outline-none" x-on:click="$refs.cover.click()">Выберите файл</button>
                </div>
                @if ($errors->has('cover'))
                    <p class="mt-2 text-red-600">{{ $errors->first('cover') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-3 text-gray-500">Описание</label>
                <div contenteditable placeholder="От 3 символов" data-name="description" class="bg-white border rounded-md px-3 py-2 space-y-3 focus:outline-none focus:ring-2 focus:border-blue-500"></div>
                @if ($errors->has('description'))
                    <p class="mt-2 text-red-600">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="price" class="block mb-3 text-gray-500">Стоимость</label>
                <input type="number" name="price" placeholder="От 1 до 100.000 рублей" value="{{ old('price') }}" min="1" max="100000" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:border-blue-300">
                @if ($errors->has('price'))
                    <p class="mt-2 text-red-600">{{ $errors->first('price') }}</p>
                @endif
            </div>
            <button type="submit" class="w-full bg-blue-500 rounded-md px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-blue-300">Добавить</button>
        </form>
    </main>
</div>
@endsection

@section('footer.scripts')
    <script src="{{ asset('js/files/submit.js') }}" defer></script>
@endsection