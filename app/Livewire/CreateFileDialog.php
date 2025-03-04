<?php

namespace App\Livewire;

use Livewire\Component;
use Storage;

class CreateFileDialog extends Component
{
    public string $projectName;
    public string $fileName;
    private string $filePath;

    public function createFile($path): void
    {
        $this->filePath = $path;

        $this->validate();
        $this->dispatch('create-file', name: $this->fileName, path: $this->filePath);
        $this->dispatch('close-modal');

        $this->reset();
    }

    public function rules(): array
    {
        return [
            'fileName' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (Storage::disk('local')->exists($this->filePath . DIRECTORY_SEPARATOR . $this->fileName)) {
                        $fail('Il file esiste già');
                    }
                },
            ],
        ];
    }
}
