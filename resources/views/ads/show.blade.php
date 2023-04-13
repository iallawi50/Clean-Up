<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="container mt-5 py-5" dir="rtl">


        <div class="bg-white text-blue-500 relative flex flex-col justify-between">

            <span class="absolute mt-2 bg-blue-500 text-xs p-1 rounded-sm text-white ms-3">{{ $ad->category }}</span>
            <div>
                <div class="frame-ad-show p-2">
                    <img src="../storage/{{ $ad->image_path }}" alt="{{ $ad->title }}">
                </div>

                <div class="p-2">
                    <h3 class="text-3xl">{{ $ad->title }}</h3>
                    <p class="text-md mt-4">{{ $ad->body }}</p>
                </div>
            </div>
            <div class="bg-gray-100 p-2 flex justify-between items-center">
                <p class="text-gray-500">من {{ $ad->user->name }} - {{ $ad->created_at->diffForHumans() }}</p>
                @if (Auth::Check())
                    @can('update', $ad)
                        <div class="flex flex-row items-center">
                            <form action="/ads/{{ $ad->id }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('هل انت متأكد من حذف هذا الإعلان ؟')" type="submit"
                                    class="btn-danger px-10">حذف</button>
                            </form>
                            <a class="btn-warning mr-2 px-3" href="/ads/{{$ad->id}}/edit">تعديل الاعلان</a>
                        </div>
                    @endcan
                    @cannot('update', $ad)
                        <a href="{{ $ad->id }}/order" class="btn-success px-10">حجز</a>
                    @endcannot
                @else
                    <a href="{{ route('login') }}" class="custom-primary-button text-sm ">
                        {{ __('Log In') }}</a>
                @endif
            </div>
        </div>





    </div>


</x-app-layout>
