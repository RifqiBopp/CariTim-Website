<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DashboardLayout extends Component
{
    /**
     * The title of the page.
     *
     * @var string|null
     */
    public $title;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.dashboard');
    }
}
