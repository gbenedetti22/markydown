<li x-data="{ showContext: false, posX: 0, posY: 0 }">
    @if($item['type'] === "directory")
        <details open>
            <summary @contextmenu.prevent="$dispatch('close-all-dropdowns'); showContext = true;">
                <!-- Icona della cartella -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/>
                </svg>
                {{ $item['name'] }}
            </summary>

            <!-- Menu contestuale -->
            <div x-show="showContext"
                 x-transition
                 @click.away="showContext = false"
                 @close-all-dropdowns.window="showContext = false"
                 :style="`position: absolute;`"
                 class="bg-white rounded-lg shadow-lg z-50">
                <ul class="py-2 w-56">
                    <!-- Voce normale -->
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <button @click="showContext = false" class="flex items-center w-full text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Nuova pagina</span>
                        </button>
                    </li>

                    <!-- Voce con sottomenu -->
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer relative group">
                        <div class="flex items-center justify-between w-full">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span>Nuovo</span>
                            </div>
                            <svg class="w-4 h-4 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>

                        <!-- Area invisibile per prevenire la chiusura del menu -->
                        <div class="absolute top-0 right-0 w-8 h-full translate-x-full"></div>

                        <!-- Sottomenu -->
                        <ul class="absolute left-full top-0 mt-0 ml-1 hidden group-hover:block bg-white shadow-lg rounded-lg py-2 w-56 z-50">
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                <button @click="showContext = false;"
                                        class="flex items-center w-full text-left">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>File Markdown</span>
                                </button>


                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                <button @click="showContext = false; $dispatch('create-file-dialog', '{{ $item['path'] }}'); create_file_dialog.showModal()" class="flex items-center w-full text-left">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>File</span>
                                </button>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                <button @click="showContext = false; $wire.createFolder('folder', '{{ $item['path'] }}')" class="flex items-center w-full text-left">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                    <span>Cartella</span>
                                </button>
                            </li>
                        </ul>
                    </li>

                    <!-- Altre voci -->
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <button @click="showContext = false" class="flex items-center w-full text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            <span>Rinomina</span>
                        </button>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <button @click="showContext = false" class="flex items-center w-full text-left text-red-600">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            <span>Elimina</span>
                        </button>
                    </li>
                </ul>
            </div>

            <ul>
                @foreach($item['children'] as $child)
                    @include('file-manager-item', ['item' => $child])
                @endforeach
            </ul>
        </details>
    @else
        <a @contextmenu.prevent="$dispatch('close-all-dropdowns'); showContext = true;">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-4 w-4">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            {{ $item['name'] }}
        </a>

        <div x-show="showContext"
             x-transition
             @click.away="showContext = false"
             @close-all-dropdowns.window="showContext = false"
             :style="`position: absolute;`"
             class="bg-white rounded-lg shadow-lg z-50">
            <ul class="py-2 w-56 m-0 static px-0">
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                    <a class="block w-full">Rinomina</a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                    <a class="block w-full">Elimina</a>
                </li>
            </ul>
        </div>
    @endif
</li>
