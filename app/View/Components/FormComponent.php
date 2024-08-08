<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FormComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $fields, public $isEditing, public $actionRoute, public $editRoute, public $isSEOEnabled, public $model, public $updateBtnText, public $submitBtnText)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-component');
    }
}
