<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Modal extends Component
{
    public $id;
    public $title;
    public $size;
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $title = null, $size = null, $type = 'default')
    {
        $this->id = $id;
        $this->title = $title;
        $this->size = $size;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.modal');
    }
}
