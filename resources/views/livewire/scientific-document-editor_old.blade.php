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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 12h8a4 4 0 004-4 4 4 0 00-4-4H6v8zm0 0h8a4 4 0 014 4 4 4 01-4 4H6v-8z"/>
                </svg>
            </button>

            <button
                    wire:click="applyStyle('italic', window.getSelection().toString(), [window.selectionStart, window.selectionEnd], window.currentPageIndex)"
                    class="p-2 hover:bg-gray-100 rounded"
                    title="Italic"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5.248 20.246H9.05m0 0h3.696m-3.696 0 5.893-16.502m0 0h-3.697m3.697 0h3.803"/>
                </svg>
            </button>

            <button
                    wire:click="applyStyle('underline', window.getSelection().toString(), [window.selectionStart, window.selectionEnd], window.currentPageIndex)"
                    class="p-2 hover:bg-gray-100 rounded"
                    title="Underline"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17.995 3.744v7.5a6 6 0 1 1-12 0v-7.5m-2.25 16.502h16.5"/>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
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

    <!-- Contenitore principale -->
    <div class="flex flex-grow h-screen">
        <!-- File tree (20%) -->
        <div class="w-1/5 bg-white border-r border-gray-200 p-4 overflow-auto flex flex-col h-full">
            <ul class="menu rounded-lg w-full">
                <li>
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        resume.pdf
                    </a>
                </li>
                <li>
                    <details open>
                        <summary>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/>
                            </svg>
                            My Files
                        </summary>
                        <ul>
                            <li>
                                <a>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                    Project-final.psd
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>
            </ul>
        </div>

        <!-- Editor (40%) -->
        <div class="w-2/5 p-4 flex flex-col h-full overflow-hidden">
            @foreach($pages as $index => $page)
                <div wire:key="page-{{ $index }}" class="mb-4 flex-1">
                    <div class="text-sm text-gray-500 mb-1">Pagina {{ $index + 1 }}</div>
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
                            class="w-full h-full p-4 rounded-lg focus:outline-none resize-none border border-gray-300 textarea overflow-auto"
                    ></textarea>
                </div>
            @endforeach
        </div>

        <!-- Preview (40%) -->
        <div class="w-2/5 p-4 overflow-auto border-l border-gray-200">
            @foreach($pages as $index => $page)
                <div wire:key="preview-page-{{ $index }}" class="mb-4">
                    <div class="text-sm text-gray-500 mb-1 invisible">Anteprima Pagina {{ $index + 1 }}</div>
                    <div
                            class="bg-white shadow-lg prose max-w-none p-4 rounded-lg"
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
