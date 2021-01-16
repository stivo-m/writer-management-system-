<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="w-full h-300 grid grid-cols-1 gap-4 bg-white py-3 px-5">
                <div>
                    Invoice Number #{{$invoice->id}}
                    <hr class="my-3">
                </div>
                <div>
                    Total Orders: {{$invoice->orders}} Orders
                    <hr class="my-3">
                </div>
                <div>
                    Total Amount: Ksh. {{number_format($invoice->total)}}
                    @if ($invoice->status === 'not paid')
                    <hr class="my-3">
                    @endif
                </div>
                @if ($invoice->status === 'not paid')
                <form action="{{route('money.pay.all', $invoice)}}" method="post">
                    @csrf
                    <button
                        class="bg-pink-500 disabled:opacity-75 {{$invoice->status === 'paid' ? 'cursor-not-allowed': null}} text-white hover:bg-pink-600 hover:text-white border border-r-0 border-pink-500 rounded-lg px-4 py-2 mx-0 outline-none focus:shadow-outline">Pay
                        Invoice
                    </button>
                </form>
                @endif

            </div>




            <table class="min-w-full leading-normal my-10">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ID
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Order
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Amount
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Pay Status
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Writer
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoiceList as $inv)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                # {{$inv->id}}
                            </p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                <a href="{{route('order.show', $inv->order_id)}}"># {{$inv->order_id}}</a>
                            </p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                Ksh. {{number_format($inv->amount)}}
                            </p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{$inv->pay_status}}
                            </p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                # {{$inv->writer_id}}
                            </p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex justify-center rounded-lg text-sm align-items-center" role="group">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    @if ($inv->pay_status == 'paid')
                                    <div class="text-white px-6 py-1 w-200 border-0 rounded relative mb-2 bg-pink-500">

                                        <span class="inline-block align-middle mr-8">
                                            <b class="capitalize">No Further Action Allowed
                                        </span>

                                    </div>
                                    @else
                                    <form action="{{route('money.invoice.list', $inv)}}" method="post">
                                        <button
                                            class="bg-yellow-500 text-white hover:bg-yellow-600 hover:text-white border border-r-0 border-yellow-500 rounded-lg px-4 py-2 mx-0 mb-0 cursor-pointer outline-none focus:shadow-outline">Remove

                                        </button>
                                    </form>
                                    @endif
                                </p>

                            </div>
                        </td>
                    </tr>


                    @empty
                    <tr>
                        <p>No Invoices Found</p>
                    </tr>
                    @endforelse

                    <tr>
                        <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                Totals
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap text-lg">
                                Ksh. {{number_format($invoice->total)}}
                            </p>
                        </td>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>