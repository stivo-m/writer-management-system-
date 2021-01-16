<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>


    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button
                class="modal-open px-4 py-2 my-10 bg-indigo-700 text-gray-300 inline-flex items-center border border-gray-300 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:text-white focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">New
                Orders</button>


            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div x-data="{active: 0}">
                    <div class="flex overflow-hidden -mb-px">
                        <button class="px-4 py-2 w-full" x-on:click.prevent="active = 0"
                            x-bind:class="{'bg-indigo-700 text-white': active === 0}">Available</button>
                        <button class="px-4 py-2 w-full" x-on:click.prevent="active = 1"
                            x-bind:class="{'bg-indigo-700 text-white': active === 1}">In Progress</button>
                        <button class="px-4 py-2 w-full" x-on:click.prevent="active = 2"
                            x-bind:class="{'bg-indigo-700 text-white': active === 2}">Completed</button>
                        <button class="px-4 py-2 w-full" x-on:click.prevent="active = 3"
                            x-bind:class="{'bg-indigo-700 text-white': active === 3}">Revision</button>
                        <button class="px-4 py-2 w-full" x-on:click.prevent="active = 4"
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

                                @if ($order->status === "available")
                                <tr x-show="active === 0">
                                    @livewire('orders.index', ['order' => $order])
                                </tr>
                                @endif


                                @if ($order->status === "processing")
                                <tr x-show="active === 1">
                                    @livewire('orders.index', ['order' => $order])
                                </tr>
                                @endif
                                @if ($order->status === "completed" || $order->status === "approved")
                                <tr x-show="active === 2">
                                    @livewire('orders.index', ['order' => $order])
                                </tr>
                                @endif
                                @if ($order->status === "revision")
                                <tr x-show="active === 3">
                                    @livewire('orders.index', ['order' => $order])
                                </tr>
                                @endif

                                @if ($order->status === "finished")
                                <tr x-show="active === 4">
                                    @livewire('orders.index', ['order' => $order])
                                </tr>
                                @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        <!--Modal-->
        <div
            class="modal opacity-0 pointer-events-none fixed w-full h-full  top-0 left-0 flex items-center justify-center">
            <div class="modal-overlay absolute w-full h-full  bg-gray-900 opacity-50"></div>

            <div
                class="modal-container bg-white w-1/2 my-15 md:max-w-md mx-auto rounded shadow-lg z-50 h-full overflow-y-scroll">



                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4  text-left px-6">
                    <form action="{{route('order.add')}}" method="post">
                        @csrf
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">New Order</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <!--Body-->

                        <div class="grid grid-cols-2 gap-4 ">

                            <div class="my-3">
                                <label for="topic">Topic</label>
                                <input id="topic" name="topic" type="text" required
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="Topic">
                            </div>
                            <div class="my-3">
                                <label for="pages">Pages</label>
                                <input id="pages" name="pages" min="1" max="100" value="1" type="number" required
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="Pages">
                            </div>
                            <div class="my-3">
                                <label for="sources">Sources</label>
                                <input id="sources" name="sources" min="1" max="100" value="1" type="number" required
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="Sources">
                            </div>
                            <div class="my-3">
                                <label for="format">Format</label>
                                <select required name="format" id="format" class="appearance-none rounded-none relative block
                                                            w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md
                                                            focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10
                                                            sm:text-sm">
                                    <option selected value="APA">APA</option>
                                    <option value="HAVARD">HAVARD</option>
                                    <option value="CHICAGO">CHICAGO</option>
                                    <option value="MLA">MLA</option>
                                    <option value="OTHER">OTHER</option>
                                </select>
                            </div>
                            <div class="my-3">
                                <label for="spacing">Spacing</label>
                                <select required name="spacing" id="spacing" class="appearance-none rounded-none relative block
                                    w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md
                                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10
                                    sm:text-sm">
                                    <option selected value="SINGLE">SINGLE</option>
                                    <option value="DOUBLE">DOUBLE</option>
                                </select>
                            </div>

                            <div class="my-3">
                                <label for="date_deadline">Date Deadline</label>
                                <input id="date_deadline" name="date_deadline" type="date" required
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="Deadline">
                            </div>
                            <div class="my-3">
                                <label for="time_deadline">Time Deadline</label>
                                <input id="time_deadline" name="time_deadline" type="time" required
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="Deadline">
                            </div>
                        </div>


                        <div class="my-3">
                            <label for="instructions">Order Instructions</label>
                            <textarea id="instructions" name="instructions" required rows="5"
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Detailed Instructions"></textarea>
                        </div>



                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Add
                                Order</button>
                            <button
                                class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
          openmodal[i].addEventListener('click', function(event){
        	event.preventDefault()
        	toggleModal()
          })
        }
        
        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)
        
        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
          closemodal[i].addEventListener('click', toggleModal)
        }
        
        document.onkeydown = function(evt) {
          evt = evt || window.event
          var isEscape = false
          if ("key" in evt) {
        	isEscape = (evt.key === "Escape" || evt.key === "Esc")
          } else {
        	isEscape = (evt.keyCode === 27)
          }
          if (isEscape && document.body.classList.contains('modal-active')) {
        	toggleModal()
          }
        };
        
        
        function toggleModal () {
          const body = document.querySelector('body')
          const modal = document.querySelector('.modal')
          modal.classList.toggle('opacity-0')
          modal.classList.toggle('pointer-events-none')
          body.classList.toggle('modal-active')
        }
        
         
    </script>


</x-app-layout>