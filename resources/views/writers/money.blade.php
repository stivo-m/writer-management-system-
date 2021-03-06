@extends('writers.layouts.writer')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Invoices') }}
</h2>
@endsection


@section('main')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="min-w-full leading-normal my-10">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Orders
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Amount
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>


                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions</th>


                </tr>
            </thead>
            <tbody>
                @forelse ($invoices as $invoice)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            # {{$invoice->id}}
                        </p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{$invoice->orders}} Orders
                        </p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            Ksh. {{number_format($invoice->total)}}
                        </p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{$invoice->status}}
                        </p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex justify-center rounded-lg text-sm align-items-center" role="group">
                            <p class="text-gray-900 whitespace-no-wrap">
                                <a href="{{route('writer.money.list', $invoice)}}"
                                    class="bg-indigo-500 text-white hover:bg-indigo-600 hover:text-white border border-r-0 border-indigo-500 rounded-lg px-4 py-2 mx-0 mb-0 cursor-pointer outline-none focus:shadow-outline">View
                                    Invoice
                                </a>
                            </p>

                        </div>
                    </td>
                </tr>


                @empty
                <tr>
                    <td colspan="5">
                        <p>No Invoices Found</p>
                    </td>
                </tr>
                @endforelse


            </tbody>
        </table>
    </div>
</div>
@endsection