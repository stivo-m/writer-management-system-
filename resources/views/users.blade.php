<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button
                class="modal-open px-4 py-2 my-10 bg-indigo-700 text-gray-300 inline-flex items-center border border-gray-300 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:text-white focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">New
                User</button>
            @livewire('users')
        </div>

        <!--Modal-->
        <div
            class="modal opacity-0 pointer-events-none fixed w-full h-full  top-0 left-0 flex items-center justify-center">
            <div class="modal-overlay absolute w-full h-full  bg-gray-900 opacity-50"></div>

            <div
                class="modal-container bg-white w-1/2 my-15 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-scroll">
                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                    <form action="{{route('users.add')}}" method="post">
                        @csrf
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">New User</p>
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

                        <div class="grid grid-cols-1 gap-2 ">

                            <div class="my-3">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" required
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="Name">
                            </div>
                            <div class="my-3">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" required
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="Email">
                            </div>

                            <div class="my-3">
                                <label for="role">Role</label>
                                <select required name="role" id="role" class="appearance-none rounded-none relative block
                                    w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md
                                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10
                                    sm:text-sm">
                                    <option selected value="writer">Writer</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                        </div>

                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Add
                                User</button>
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