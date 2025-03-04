<div id="container" class="flex min-h-screen w-full">
    <div wire:ignore.self id="div1" class="resizable box-border">
        <livewire:file-manager :project-name="'Markydown Project Test'"/>
    </div>

    <div wire:ignore.self id="div2" class="resizable box-border max-h-screen">
        <textarea wire:model.live="pages.{{ $index }}.markdown_content"
            class="w-full rounded-none h-full focus:outline-none resize-none textarea overflow-auto" autofocus></textarea>
    </div>

    <div id="div3" wire:ignore.self class="box-border max-h-screen">
        <div id="page" class="bg-white h-full max-w-full w-auto break-words overflow-auto prose">
            <x-markdown>
                {!! $pages[$index]['markdown_content'] !!}
            </x-markdown>
        </div>
    </div>

</div>

@script
<script>
    const div1 = document.getElementById('div1')
    const div2 = document.getElementById('div2')
    const div3 = document.getElementById('div3')

    const totalWidth = innerWidth
    const width1 = totalWidth * 0.2; // 20%
    const width2 = totalWidth * 0.4; // 40%
    const width3 = totalWidth * 0.4; // 40%

    div1.style.width = width1 + "px"
    div2.style.width = width2 + "px"
    div3.style.width = width3 + "px"

    window.onresize = (_) => {
        const newWidth = calcNewWidth()
        Object.assign(div3.style, {
            width: `${newWidth}px`
        })
    }

    interact('.resizable')
        .resizable({
            edges: {right: true},
            ignoreFrom: 'dialog, .modal-backdrop, .modal',
            listeners: {
                move: function (event) {
                    Object.assign(event.target.style, {
                        width: `${event.rect.width}px`,
                    })

                    const newWidth = calcNewWidth()
                    Object.assign(div3.style, {
                        width: `${newWidth}px`
                    })

                    document.body.style.userSelect = "none"
                    document.body.style.touchAction = "none"
                },

                end: function () {
                    document.body.style.userSelect = ""
                    document.body.style.touchAction = ""
                }

            }
        })

    function calcNewWidth() {
        return Math.abs(window.innerWidth - div1.getBoundingClientRect().width - div2.getBoundingClientRect().width);
    }
</script>
@endscript
