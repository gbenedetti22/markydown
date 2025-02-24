<div class="min-h-screen flex flex-col bg-gray-100">
    <!-- Toolbar -->
    <div class="bg-white border-b border-gray-200 py-2 px-4">
        <div class="max-w-7xl mx-auto flex items-center space-x-2">
            <button
                wire:click="applyStyle('bold', window.getSelection().toString(), [window.selectionStart, window.selectionEnd], window.currentPageIndex)"
                class="p-2 hover:bg-gray-100 rounded"
                title="Grassetto"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h8a4 4 0 004-4 4 4 0 00-4-4H6v8zm0 0h8a4 4 0 014 4 4 4 0 01-4 4H6v-8z"/>
                </svg>
            </button>

            <button
                wire:click="applyStyle('italic', window.getSelection().toString(), [window.selectionStart, window.selectionEnd], window.currentPageIndex)"
                class="p-2 hover:bg-gray-100 rounded"
                title="Italic"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.248 20.246H9.05m0 0h3.696m-3.696 0 5.893-16.502m0 0h-3.697m3.697 0h3.803" />
                </svg>

            </button>

            <button
                wire:click="applyStyle('underline', window.getSelection().toString(), [window.selectionStart, window.selectionEnd], window.currentPageIndex)"
                class="p-2 hover:bg-gray-100 rounded"
                title="Underline"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.995 3.744v7.5a6 6 0 1 1-12 0v-7.5m-2.25 16.502h16.5" />
                </svg>


            </button>


            <div class="flex items-center space-x-1">
                <button
                    wire:click="adjustZoom('out')"
                    class="p-2 hover:bg-gray-100 rounded"
                    title="Riduci zoom"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                    </svg>
                </button>
                <span class="text-sm">{{ round($zoom * 100) }}%</span>
                <button
                    wire:click="adjustZoom('in')"
                    class="p-2 hover:bg-gray-100 rounded"
                    title="Aumenta zoom"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </button>
                <button
                    wire:click="adjustZoom('reset')"
                    class="text-sm text-gray-600 hover:text-gray-900"
                    title="Reimposta zoom"
                >
                    Reset
                </button>
            </div>
        </div>
    </div>

    @error('*')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <!-- Editor Container -->
    <div class="join">
        <!-- File tree -->
        <div class="join-item relative"
             x-data="{
         isDragging: false,
         startX: 0,
         startWidth: 300,
         currentWidth: 300,

         startDrag(e) {
             this.isDragging = true
             this.startX = e.clientX
             this.startWidth = this.currentWidth
             document.body.classList.add('select-none', 'cursor-ew-resize')
         },

         duringDrag(e) {
             if (!this.isDragging) return
             const delta = e.clientX - this.startX
             this.currentWidth = Math.max(200, this.startWidth + delta)
         },

         stopDrag() {
             this.isDragging = false
             document.body.classList.remove('select-none', 'cursor-ew-resize')
         }
     }"
             @mouseup.window="stopDrag"
             @mousemove.window="duringDrag">
            <!-- File tree content -->
            <div class="p-4" style="width: 300px; overflow-x: auto;">
                <ul class="menu rounded-lg w-full max-w-xs" >
                    <li>
                        <a>
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
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            resume.pdf
                        </a>
                    </li>
                    <li>
                        <details open>
                            <summary>
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
                                        d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                </svg>
                                My Files
                            </summary>
                            <ul>
                                <li>
                                    <a>
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
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        Project-final.psd
                                    </a>
                                </li>
                                <li>
                                    <a>
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
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        Project-final-2.psd
                                    </a>
                                </li>
                                <li>
                                    <details open>
                                        <summary>
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
                                                    d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                            </svg>
                                            Images
                                        </summary>
                                        <ul>
                                            <li>
                                                <a>
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
                                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                    </svg>
                                                    Screenshot1.png
                                                </a>
                                            </li>
                                            <li>
                                                <a>
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
                                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                    </svg>
                                                    Screenshot2.png
                                                </a>
                                            </li>
                                            <li>
                                                <details open>
                                                    <summary>
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
                                                                d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                                        </svg>
                                                        Others
                                                    </summary>
                                                    <ul>
                                                        <li>
                                                            <a>
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
                                                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                                </svg>
                                                                Screenshot3.png
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </details>
                                            </li>
                                        </ul>
                                    </details>
                                </li>
                            </ul>
                        </details>
                    </li>
                    <li>
                        <a>
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
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            reports-final-2.pdf
                        </a>
                    </li>
                </ul>
            </div>
            <div class="absolute right-0 top-0 bottom-0 w-6 cursor-ew-resize hover:bg-blue-200 active:bg-blue-300 transition-colors duration-100"
                 :class="{ 'bg-blue-300': isDragging }"
                 style="margin-right: -12px; z-index: 10"
                 @mousedown.prevent="startDrag">
            </div>
        </div>

        <!-- Markdown Editor -->
        <div class="join-item min-w-0 p-4 overflow-y-auto">
            @foreach($pages as $index => $page)
                <div wire:key="page-{{ $index }}" class="mb-4">
                    <div class="text-sm text-gray-500 mb-1">Pagina {{ $index + 1 }}</div>
                    <div class="relative" style="width: {{ $page['width'] }}; height: {{ $page['height'] }};">
                    <textarea
                        x-data="{ pageIndex: {{ $index }} }"
                        x-init="window.currentPageIndex = pageIndex"
                        x-on:focus="window.currentPageIndex = pageIndex"
                        x-on:select="
                            window.selectionStart = $el.selectionStart
                            window.selectionEnd = $el.selectionEnd
                        "
                        @apply-style.window="
                            const eventData = $event.detail[0]
                            if (eventData.pageIndex === pageIndex) {
                                $el.setRangeText(
                                    eventData.text,
                                    $el.selectionStart,
                                    $el.selectionEnd,
                                    'select'
                                )
                            }
                        "
                        wire:model.live="pages.{{ $index }}.markdown_content"
                        class="absolute inset-0 w-full h-full p-4 rounded-lg focus:outline-none resize-none border-gray-300 textarea"
                    ></textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Preview -->
        <div class="join-item min-w-0 p-4 overflow-y-auto">
            <div class="flex flex-col items-center gap-4" style="transform: scale({{ $zoom }});">
                @foreach($pages as $index => $page)
                    <div wire:key="preview-page-{{ $index }}" class="mb-4">
                        <div class="text-sm text-gray-500 mb-1 invisible">Pagina {{ $index + 1 }}</div>
                        <div
                            class="bg-white shadow-lg prose max-w-none"
                            style="
                        width: {{ $page['width'] }};
                        height: {{ $page['height'] }};
                        margin-top: {{ $page['margin_top'] }};
                        margin-right: {{ $page['margin_right'] }};
                        margin-bottom: {{ $page['margin_bottom'] }};
                        margin-left: {{ $page['margin_left'] }};
                        overflow: hidden;
                    "
                        >
                            <x-markdown>
                                {!! $page['markdown_content'] !!}
                            </x-markdown>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
