@extends('writers.layouts.writer')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Orders') }}
</h2>
@endsection

@section('main')
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div x-data="{active: 0}">
                <div class="flex overflow-hidden -mb-px">
                    <button class="border-0 hover:border-transparent  px-4 py-2 w-full" x-on:click.prevent="active = 0"
                        x-bind:class="{'bg-indigo-700 text-white': active === 0}">Available</button>
                    <button class="border-0 hover:border-transparent  px-4 py-2 w-full" x-on:click.prevent="active = 1"
                        x-bind:class="{'bg-indigo-700 text-white': active === 1}">In Progress</button>
                    <button class="border-0 hover:border-transparent  px-4 py-2 w-full" x-on:click.prevent="active = 2"
                        x-bind:class="{'bg-indigo-700 text-white': active === 2}">Completed</button>
                    <button class="border-0 hover:border-transparent  px-4 py-2 w-full" x-on:click.prevent="active = 3"
                        x-bind:class="{'bg-indigo-700 text-white': active === 3}">Revision</button>
                    <button class="border-0 hover:border-transparent  px-4 py-2 w-full" x-on:click.prevent="active = 4"
                        x-bind:class="{'bg-indigo-700 text-white': active === 4}">Finished</button>
                </div>
                <div class="bg-indigo-700 bg-opacity-10 -mt-px">

                    <table class="min-w-full leading-normal my-10">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Title
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Deadline
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Pages
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Cost
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $order)
                            <tr x-show="active === 0">
                                @livewire('orders.writer', ['order' => $order])
                            </tr>
                            @endforeach

                            @foreach ($myOrders as $item)
                            @if ($item->status === "processing")
                            <tr x-show="active === 1">
                                @livewire('orders.writer', ['order' => $item])
                            </tr>
                            @endif
                            @if ($item->status === "completed" || $item->status === "approved")
                            <tr x-show="active === 2">
                                @livewire('orders.writer', ['order' => $item])
                            </tr>
                            @endif
                            @if ($item->status === "revision")
                            <tr x-show="active === 3">
                                @livewire('orders.writer', ['order' => $item])
                            </tr>
                            @endif

                            @if ($item->status === "finished")
                            <tr x-show="active === 4">
                                @livewire('orders.writer', ['order' => $item])
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


</div>
@endsection