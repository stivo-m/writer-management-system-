<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>


    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-1 sm:grid-cols-1">
                <div class="col-span-2">
                    <div
                        class="bg-white lg:order-3 lg:row-span-2 2xl:row-span-1 lg:col-span-1 rounded-lg shadow-xl mb-5 p-5 lg:mb-0 2xl:mb-8">
                        <div class="mx-8 my-12 lg:my-10">

                            <h1
                                class="primary-color-blackish-blue text-xs md:text-base 2xl:text-2xl  2xl:pl-24 -mt-8 md:-mt-10 2xl:-mt-16">
                                Status: <span
                                    class="relative inline-block px-3 py-1 uppercase font-semibold text-green-900 leading-tight">
                                    <span aria-hidden
                                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">{{$order->status}}</span>
                                </span></h1>
                            @if ($order->status != 'available')
                            <h2
                                class="primary-color-blackish-blue-opacity text-xs md:text-base 2xl:text-2xl my-2 2xl:pl-24">
                                Assigned to Writer ID
                                <span
                                    class="relative inline-block px-3 py-1 uppercase font-semibold text-green-900 leading-tight">
                                    <span aria-hidden
                                        class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                    <span class="relative">#{{$assignedWriter->id}} {{$assignedWriter->name}}</span>
                                </span>
                            </h2>
                            @endif
                        </div>
                        <div class="mt-5 ml-5 mr-11">
                            <p
                                class="mt-5 primary-color-blackish-blue text-xl 2xl:text-4xl font-bold lg:-mt-5 2xl:mt-12 2xl:pb-6">
                                <small class="font-normal text-xs">Title: </small>
                                <br>
                                {{$order->title}}</p>
                            <br />
                            <div class="grid grid-cols-2 gap-4 md:grid-cols-2 sm:grid-cols-1 my-10">
                                <div>
                                    <p> <b>Pages: </b> {{$order->pages}} Pages</p>
                                </div>
                                <!-- ... -->
                                <div>
                                    <p> <b>Sources: </b> {{$order->sources}} Sources</p>
                                </div>
                                <div>
                                    <p> <b>Deadline: </b>
                                        {{ \Carbon\Carbon::parse($order->deadline)->diffForHumans()  }}</p>
                                </div>
                                <!-- ... -->
                                <div>
                                    <p> <b>Format: </b> {{$order->format}}</p>
                                </div>
                                <div>
                                    <p> <b>Slides: </b> {{$order->slides}} <small>Powerpoint Slides</small></p>
                                </div>
                                <!-- ... -->
                                <div>
                                    <p> <b>Cost: </b> Ksh. {{number_format($order->cpp * $order->pages)}}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="grid grid-cols-1 my-5">
                                <div>
                                    <h3 class="text-1xl font-bold my-5">Instructions</h3>
                                    <p> {{$order->instructions}}</p>
                                </div>

                            </div>


                            <hr>
                        </div>
                    </div>
                </div>
                <div class="bg-white mx-auto rounded-lg shadow-xl w-full mb-5 lg:mb-0 2xl:mb-8 h-auto">
                    <div class="mx-8 my-10 lg:my-8">
                        <img class="w-8 md:w-9 2xl:w-20 h-8 md:h-9 2xl:h-20 rounded-full border-2 -mt-3 -ml-1 lg:-ml-0"
                            src="{{Auth::user()->profile_photo_url}}" />
                        <h1
                            class="primary-color-blackish-blue text-xs md:text-base 2xl:text-2xl pl-11 md:pl-12 2xl:pl-24 -mt-8 md:-mt-10 2xl:-mt-16">
                            {{Auth::user()->name}}</h1>
                        <h2
                            class="primary-color-blackish-blue-opacity text-xs md:text-base 2xl:text-2xl pl-11 md:pl-12 2xl:pl-24">
                            {{Auth::user()->role}}</h2>
                    </div>
                    <div class="-mt-4 ml-5 mr-11">
                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-bold px-2 lg:px-3 -mt-6 lg:-mt-5 2xl:mt-12 2xl:pb-6 mb-4">
                            Admin Actions</p>
                        <hr />
                        <div class="flex justify-center rounded-lg my-5 text-sm px-2 align-items-center" role="group">
                            @if ($order->status === 'finished')
                            <div class="text-white px-6 py-4 w-full border-0 rounded relative mb-4 bg-pink-500">

                                <span class="inline-block align-middle mr-8">
                                    <b class="capitalize">No Further Action Allowed
                                </span>

                            </div>
                            @endif
                            @if ($order->status === 'available')
                            <form action="{{route('order.assign', $order)}}" method="post">
                                @csrf
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-2">
                                        <label for="writer">Choose Writer</label>
                                        <select required name="writer" id="writer" class="appearance-none rounded-none relative block
                                            w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md
                                            focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10
                                            sm:text-sm">
                                            <option selected value="">Chose Writer</option>
                                            @forelse ($writers as $writer)
                                            <option value="{{$writer->id}}">{{$writer->name }} :
                                                {{$writer->email}}</option>
                                            @empty
                                            <div
                                                class="text-white px-6 py-4 w-full border-0 rounded relative mb-4 bg-pink-500">

                                                <span class="inline-block align-middle mr-8">
                                                    <b class="capitalize">No Writers were found
                                                </span>

                                            </div>
                                            @endforelse
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="bg-green-500 text-white hover:bg-green-600 hover:text-white border border-r-0 border-green-500 rounded-lg px-4 py-2 mx-0 outline-none focus:shadow-outline">Assign
                                    </button>
                                </div>

                            </form>
                            @endif

                            @if ( $order->status === 'processing' || $order->status ===
                            'revision' || $order->status ===
                            'approved')
                            <form action="{{route('order.reassign', $order)}}" method="post">
                                @csrf
                                <button type="submit"
                                    class="bg-yellow-500 text-white hover:bg-yellow-600 hover:text-white border border-r-0 border-yellow-500 rounded-lg px-4 py-2 mx-0 outline-none focus:shadow-outline">Reassign
                                </button>
                            </form>
                            @endif

                            @if ($order->status === 'completed')
                            <form action="{{route('order.reassign', $order)}}" method="post">
                                @csrf
                                <button type="submit"
                                    class="bg-yellow-500 text-white hover:bg-yellow-600 hover:text-white border border-r-0 border-yellow-500 rounded-l-lg px-4 py-2 mx-0 outline-none focus:shadow-outline">Reassign
                                    Order</button>
                            </form>
                            <form action="{{route('order.revision', $order)}}" method="post">
                                @csrf
                                <button
                                    class="bg-yellow-500 text-white hover:bg-yellow-600 hover:text-white border border-yellow-500  px-4 py-2 mx-0 outline-none focus:shadow-outline">Revision</button>
                            </form>
                            <form action="{{route('order.approve', $order)}}" method="post">
                                @csrf
                                <button type="submit"
                                    class="bg-green-500 text-white hover:bg-green-600 hover:text-white border border-r-0 border-green-500 rounded-r-lg px-4 py-2 mx-0 outline-none focus:shadow-outline">Approve</button>
                            </form>
                            @endif

                            @if ($order->status === 'approved' )
                            <form action="{{route('order.revision', $order)}}" method="post">
                                @csrf
                                <button
                                    class="bg-yellow-500 text-white hover:bg-yellow-600 hover:text-white border border-yellow-500  px-4 py-2 mx-0 outline-none focus:shadow-outline">Revision</button>
                            </form>
                            <form action="{{route('order.dispute', $order)}}" method="post">
                                @csrf
                                <button
                                    class="bg-red-500 text-white hover:bg-red-600 hover:text-white border border-red-500  px-4 py-2 mx-0 border-l-0 outline-none focus:shadow-outline">Dispute</button>
                            </form>

                            <form action="{{route('order.finish', $order)}}" method="post">
                                @csrf
                                <button
                                    class="bg-blue-500 text-white hover:bg-blue-600 hover:text-white border border-l-0 border-blue-500 rounded-r-lg px-4 py-2 mx-0 outline-none focus:shadow-outline">Finish</button>
                            </form>
                            @endif
                        </div>
                        <div class="flex w-full h-50 my-3 items-center justify-center bg-grey-lighter">
                            <form class="w-full text-xs" action="{{route('order.upload', $order)}}"
                                enctype="multipart/form-data" method="post">
                                @csrf
                                <label
                                    class="w-full flex flex-col items-center px-4 py-1 bg-white text-gray-600 rounded-lg shadow-xl tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-black">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Upload Files</span>
                                    <input type='file' name="files[]" multiple="multiple" class="hidden" />
                                </label>

                                <button type="submit"
                                    class="bg-green-500 my-5 w-full text-white hover:bg-green-600 hover:text-white border border-r-0 border-green-500 rounded-lg px-4 py-2 mx-0 outline-none focus:shadow-outline">Upload
                                    Files
                                </button>
                            </form>
                        </div>

                        {{-- Showing order files --}}
                        <div>
                            @if ($files)
                            @foreach ($files as $file)
                            <div class="flex items-center bg-white pl-2 pr-4 py-2 rounded-lg my-1">
                                <div class="flex-1 px-3">
                                    <span class="text-gray-800 text-sm ">

                                        <a class="w-full h-auto flex justify-items-center"
                                            href="{{route('download', $file)}}">
                                            <span class="inline "><svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg></span> {{$file->name}}
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <hr>
                            @endforeach
                            @else
                            <div class="text-white px-6 py-4 w-full border-0 rounded relative mb-4 bg-red-500">

                                <span class="inline-block align-middle mr-8">
                                    <b class="capitalize">No Files found
                                </span>

                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>