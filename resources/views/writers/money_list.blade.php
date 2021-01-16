@extends('writers.layouts.writer')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Invoices') }}
</h2>
@endsection


@section('main')

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

            </div>

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
                            <a href="{{route('writer.orders.show', $inv->order_id)}}"># {{$inv->order_id}}</a>
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


                </tr>


                @empty
                <tr>
                    <p>No Invoices Found</p>
                </tr>
                @endforelse

                <tr class="bg-gray-200">
                    <td colspan="3" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
@endsection