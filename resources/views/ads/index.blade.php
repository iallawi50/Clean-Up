<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="container mt-5 py-5">

        @if (count($ads))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" dir="rtl">
        @endif
        @forelse ($ads as $ad)
            <div class="bg-white text-blue-500 relative flex flex-col justify-between">

                <div>
                    <div class="frame-ad  ">
                        <span
                            class="absolute z-10 mt-2 bg-blue-500 text-xs p-1 rounded-sm text-white ms-3">{{ $ad->category }}</span>
                        <img src="storage/{{ $ad->image_path }}" alt="{{ $ad->title }}">
                    </div>

                    <div class="p-2">
                        <h3 class="text-xl">{{ $ad->title }}</h3>
                        {{-- <p class="text-md mt-4">{{ $ad->body }}</p> --}}
                    </div>
                </div>
                <div class="bg-gray-100 p-2 flex justify-between items-center">
                    <p class="text-gray-500">من {{ $ad->user->name }} - {{ $ad->created_at->diffForHumans() }}</p>
                    <a href="/ads/{{$ad->id}}" class="custom-primary-button text-xs">التفاصيل</a>
                </div>
            </div>
        @empty
            <div class="text-center">
                <p class="my-14 text-blue-600 font-bold">لاتوجد اعلانات</p>
                <a href="/ads/create" role="button"
                    class="py-2 px-4 bg-white text-blue-600 shadow-md hover:bg-blue-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:text-white focus:ring-opacity-75 transition-all	">
                    أضف اعلان الآن
                </a>
            </div>
        @endforelse




        @if (count($ads))
    </div>
    @endif
    </div>


</x-app-layout>
