<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * The alert icon
     */
    public $icon;


    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param string $icon
     * @return void
     */
    public function __construct($type = 'info', $icon ="fa fa-bell-o")
    {
        $this->type = $type;
        $this->icon = $icon;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
