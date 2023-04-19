<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListFileViewer extends Component
{   
    public $files;

    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $files = [], $name = "")
    {
        $this->files = $files;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-file-viewer');
    }
}
