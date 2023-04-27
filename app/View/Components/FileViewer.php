<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FileViewer extends Component
{

    public $name;

    public $file;

    public $path;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "", $file = "", $path = "")
    {
        $this->name = $name;
        $this->file = $file;
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.file-viewer');
    }
}
