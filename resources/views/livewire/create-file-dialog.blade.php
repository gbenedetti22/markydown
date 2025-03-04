<dialog id="create_file_dialog" class="modal"
        x-data="{ filePath: '' }"
        x-init="$nextTick(() => $refs.fileNameInput.focus())"
        @create-file-dialog.window="filePath = $event.detail; $nextTick(() => $refs.fileNameInput.focus())"
        @close-modal="$el.close();"
        wire:ignore.self>

    <div class="modal-box p-6 space-y-4">
        <h3 class="text-xl font-bold text-gray-800">Crea un nuovo file</h3>

        <form wire:submit.prevent="createFile(filePath)" class="space-y-3">
            <div>
                <label for="fileName" class="block text-sm font-medium text-gray-700">Nome del file</label>
                <input
                    x-ref="fileNameInput"
                    id="file_name"
                    name="fileName"
                    type="text"
                    class="input input-bordered w-full mt-1"
                    placeholder="Es: documento.md"
                    wire:model="fileName"
                    autocomplete="off"
                >

                <x-input-error for="fileName" class="mt-1 text-red-500 text-sm"/>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" class="btn" @click="$el.closest('dialog').close()">Annulla</button>
                <button type="submit" class="btn btn-primary">Conferma</button>
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
