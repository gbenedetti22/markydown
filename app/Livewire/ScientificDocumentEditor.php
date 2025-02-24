<?php

namespace App\Livewire;

use App\Models\Page;
use App\PaperSize;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Str;

#[Layout('layouts.app')]
class ScientificDocumentEditor extends Component
{
    public array $pages = [];
    public float $zoom = 1.0;
    public array $paperSize = PaperSize::A4;

    protected $rules = [
        'pages.*.markdown_content' => 'nullable|string|not_regex:/<[^>]*script/i|not_regex:/<\/?script/i|not_regex:/javascript:/i',
    ];

    protected $messages = [
        'pages.*.markdown_content.not_regex' => 'Script tag not allowed',
    ];

    public function mount(): void
    {
        if (empty($this->pages)) {
            $this->addNewPage();
        }
    }

    /**
     * @throws Exception
     */
    public function updated($propertyName): void
    {
        try{
            $this->validate();
        }catch (Exception $e) {
            if(Str::startsWith($propertyName, "pages")) {
                foreach ($this->pages as $pageIndex => $page) {
                    if (isset($this->pages[$pageIndex]['markdown_content'])) {
                        $this->pages[$pageIndex]['markdown_content'] = Str::replace('<script', '', $this->pages[$pageIndex]['markdown_content']);
                    }
                }

                throw $e;
            }
        }
    }

    public function addNewPage(): void
    {
        $this->pages[] = [
            'markdown_content' => '',
            'width' => $this->paperSize[0],
            'height' => $this->paperSize[1],
            'margin_top' => '0mm',
            'margin_right' => '0mm',
            'margin_bottom' => '0mm',
            'margin_left' => '0mm',
        ];

    }

    public function applyStyle($style, string $selectedText, array $selectionIndex, $pageIndex): void
    {
        $styles = [
            'bold' => ['prefix' => '**', 'suffix' => '**'],
            'italic' => ['prefix' => '*', 'suffix' => '*'],
            'underline' => ['prefix' => '<u>', 'suffix' => '</u>'],
        ];

        if (isset($styles[$style])) {
            $text = $styles[$style]['prefix'] . $selectedText . $styles[$style]['suffix'];
            $this->pages[$pageIndex]['markdown_content'] = Str::substrReplace($this->pages[$pageIndex]['markdown_content'], $text, $selectionIndex[0], $selectionIndex[1]);

            $this->dispatch('apply-style', [
                'text' => $styles[$style]['prefix'] . $selectedText . $styles[$style]['suffix'],
                'pageIndex' => $pageIndex
            ]);
        }
    }

    public function adjustZoom($direction): void
    {
        if ($direction === 'in' && $this->zoom < 2.0) {
            $this->zoom += 0.1;
        } elseif ($direction === 'out' && $this->zoom > 0.3) {
            $this->zoom -= 0.1;
        } elseif ($direction === 'reset') {
            $this->zoom = 1.0;
        }
    }

}
