<x-app-layout>


    <div dir="rtl" class="pt-10 mt-10">
        <div class="container">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-auto w-full">
                            <table class="min-w-full text-center text-sm font-light">
                                <thead class="border-b bg-blue-500 font-medium text-white">
                                    <tr>
                                        <th scope="col" class=" px-6 py-4">الخدمة</th>
                                        <th scope="col" class=" px-6 py-4">مقدم الخدمة</th>
                                        <th scope="col" class=" px-6 py-4">المنطقة</th>
                                        <th scope="col" class=" px-6 py-4">حالة الخدمة</th>
                                        <th scope="col" class=" px-6 py-4">الغاء الطلب</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $order)
                                        <tr
                                            class="border-b {{ $order->id % 2 == 0 ? 'bg-white' : 'bg-gray-200' }} text-black">
                                            <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $order->ad->title }}
                                            </td>
                                            <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                                {{ App\Models\User::find($order->ad->user_id)->name }}</td>
                                            <td class="whitespace-nowrap  px-6 py-4 font-medium text-blue-600"><a
                                                    href="{{ $order->urlmap }}">{{ $order->address }}</a></td>
                                            <td class="whitespace-nowrap  px-6 py-4 font-medium text-blue-600">
                                                @switch($order->status)
                                                    @case(1)
                                                        <span class="bg-orange-500 text-white rounded-md px-4 py-2 text-xs">
                                                            تحت المعالجة</span>
                                                    @break

                                                    @case(2)
                                                        <span class="bg-green-500 text-white rounded-md px-4 py-2 text-xs">
                                                            مكتمل</span>
                                                    @break

                                                    @case(3)
                                                        <span class="bg-red-500 text-white rounded-md px-4 py-2 text-xs">
                                                            ملغي</span>
                                                    @break

                                                    @case(4)
                                                        <span class="bg-red-900 text-white rounded-md px-4 py-2 text-xs">
                                                            مرفوض</span>
                                                    @break

                                                    @default
                                                        <span class="bg-gray-500 text-white rounded-md px-4 py-2 text-xs">قيد
                                                            الانتظار</span>
                                                @endswitch

                                            </td>
                                            <td class="whitespace-nowrap  px-6 py-4 font-medium text-blue-600">
                                                @if (!$order->status)
                                                    <form action="orders/{{ $order->id }}/delete" method="post">
                                                        @csrf
                                                        @method('patch')
                                                        <input name="status" type="number" value="3" hidden>
                                                        <button type="submit"
                                                            class="btn-danger rounded-md px-4 py-2 text-xs">الغاء
                                                            الطلب</button>

                                                    </form>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
