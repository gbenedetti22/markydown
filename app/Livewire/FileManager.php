<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Storage;

class FileManager extends Component
{
    public string $projectName;

    public array $tree;

    public function mount(): void
    {
        if (!Storage::disk('local')->exists($this->projectName)) {
            Storage::disk('local')->makeDirectory($this->projectName);
        }

        $this->tree[] = [
            'type'     => 'directory',
            'name'     => $this->projectName,
            'path'     => $this->projectName,
            'children' => $this->buildTree($this->projectName),
        ];

    }

    #[On('create-file')]
    public function createFile($name, $path): void
    {
        $filePath = $path . DIRECTORY_SEPARATOR . $name;

        // Crea il file
//        Storage::disk('local')->put($filePath, "");

        $this->addToTree($name, $filePath, 'file');
    }

    public function createFolder($name, $path): void
    {
        $dirPath = $path . DIRECTORY_SEPARATOR . $name;

        $this->addToTree($name, $dirPath, 'directory');
    }

    private function addToTree($name, $path, $type): void
    {
        $parentPath = dirname($path);
        $parentNode = &$this->findNode($this->tree, $parentPath);

        if ($parentNode) {
            foreach ($parentNode['children'] as $child) {
                if ($child['type'] === 'file' && $child['name'] === $name) {
                    return;
                }
            }

            $parentNode['children'][] = [
                'type'     => $type,
                'name'     => $name,
                'path'     => $path,
                'children' => ($type === 'directory') ? [] : null
            ];
        }
    }

    private function &findNode(&$tree, $path)
    {
        foreach ($tree as &$node) {
            if ($node['path'] === $path) {
                return $node;
            }

            if (!empty($node['children'])) {
                $result = &$this->findNode($node['children'], $path);
                if ($result !== null) {
                    return $result;
                }
            }
        }

        $null = null;
        return $null;
    }

    private function buildTree($path): array
    {
        $items = [];

        // Recupera file e directory (non in modo ricorsivo)
        $files = Storage::disk('local')->files($path);
        $directories = Storage::disk('local')->directories($path);

        // Aggiungi i file
        foreach ($files as $file) {
            $items[] = [
                'type' => 'file',
                'name' => basename($file),
                'path' => $file,
            ];
        }

        // Aggiungi le directory e chiama ricorsivamente per i figli
        foreach ($directories as $dir) {
            $items[] = [
                'type'     => 'directory',
                'name'     => basename($dir),
                'path'     => $dir,
                'children' => $this->buildTree($dir),
            ];
        }

        return $items;
    }
}
