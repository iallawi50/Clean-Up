<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center leading-tight">
            {{ __('اعلان جديد') }}
        </h2>
    </x-slot>


    <div class="container mt-5 pt-5 text-right">
        <div class="bg-white text-blue-500 p-4">
            <form action="/ads/{{ $ad->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="flex flex-col">
                    <label for="title">العنوان</label>
                    <input name="title" type="text" class="rounded mt-2" value="{{ $ad->title }}">
                    @error('title')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col mt-5">
                    <label for="body">الوصف</label>
                    <input name="body" type="text" class="rounded mt-2" value="{{ $ad->body }}">
                    @error('body')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col mt-5">
                    <label for="image_path">رفع صورة</label>
                    <input name="image_path" type="file" class="rounded bg-blue-100 p-2 mt-2 w-100" dir="rtl">
                    @error('image_path')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-5">
                    <label >التصنيف</label>
                    <div class="flex flex-col sm:flex-row justify-end" style="user-select: none">

                        <label for="category-1"
                            class="block mt-4 bg-gray-200 mx-3 p-2 px-4 inline-flex items-center justify-end  transition hover:bg-gray-300">
                            <span class="mr-2 text-sm text-black">غسيل سيارات</span>
                            <input id="category-1" type="radio" value="غسيل سيارات"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200"
                                name="category" {{ $ad->category == 'غسيل سيارات' ? 'checked' : '' }}>

                        </label>


                        <label for="category-2"
                            class="block mt-4 bg-gray-200 mx-3 p-2 px-4 transition hover:bg-gray-300 inline-flex items-center justify-end">
                            <span class="mr-2 text-sm text-black">غسيل سجادات</span>
                            <input id="category-2" type="radio" value="غسيل سجادات"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200"
                                name="category" {{ $ad->category == 'غسيل سجادات' ? 'checked' : '' }}>
                        </label>


                        <label for="category-3"
                            class="block mt-4 bg-gray-200 mx-3 p-2 px-4 transition hover:bg-gray-300 inline-flex items-center justify-end">
                            <span class="mr-2 text-sm text-black">غسيل منازل</span>
                            <input id="category-3" type="radio" value="غسيل منازل"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200"
                                name="category" {{ $ad->category == 'غسيل منازل' ? 'checked' : '' }}>
                        </label>


                    </div>
                </div>

                @error('category')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="text-left mt-5">
                    <button class="text-left px-5 btn-warning ">تعديل</button>
                </div>
                {{-- @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </form> --}}

        </div>
    </div>
</x-app-layout>
