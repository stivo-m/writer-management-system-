<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
    <p class="text-gray-900 whitespace-no-wrap">
        # {{$order->id}}
    </p>
</td>
<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
    <p class="text-gray-900 whitespace-no-wrap">

        {{Str::limit($order->title, 50)}}
    </p>
</td>
<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
    <p class="text-gray-900 whitespace-no-wrap">
        {{\Carbon\Carbon::parse($order->deadline)->diffForHumans()}}
    </p>
</td>
<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
    <p class="text-gray-900 whitespace-no-wrap">
        {{$order->pages}} Pages
    </p>
</td>
<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
    <p class="text-gray-900 whitespace-no-wrap">
        Ksh. {{number_format($order->cpp * $order->pages)}}
    </p>
</td>

<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
    <span class="relative inline-block px-3 py-1 uppercase font-semibold text-green-900 leading-tight">
        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
        <span class="relative">{{$order->status}}</span>
    </span>
</td>

<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
    <p class="text-gray-900 whitespace-no-wrap">
        <a href="{{route("order.show", $order)}}"
            class="cursor-pointer px-4 py-2 my-2 bg-indigo-700 text-gray-300 inline-flex items-center border border-gray-300 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:text-white focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
            View Order</a>
    </p>
</td>