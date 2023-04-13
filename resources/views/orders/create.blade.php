<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center leading-tight">
            {{ __('حجز الخدمة') }}
        </h2>
        <p class="text-center mt-2 text-sm text-gray-600">{{ $ad->title }}</p>
    </x-slot>


    <div class="container mt-5 pt-5 text-right">
        <div class="bg-white text-blue-500 p-4">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col">
                    <label for="address">العنوان</label>
                    <input name="address" type="text" class="rounded mt-2" value="{{ old('address') }}">
                    @error('address')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col mt-5">
                    <label for="urlmap">رابط موقع العنوان</label>
                    <input name="urlmap" type="text" class="rounded mt-2" value="{{ old('urlmap') }}">
                    @error('urlmap')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col mt-5" >
                    <label for="date">الموعد</label>

                    <input name="date" type="date" class="rounded mt-2 w-100" dir="rtl" value="{{ old("date") }}">
                    @error('date')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-left mt-5">
                    <button class="btn-success px-10">حجز</button>
                </div>
                {{-- @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </form> --}}

        </div>
    </div>
</x-app-layout>
