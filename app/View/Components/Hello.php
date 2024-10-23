<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hello extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * Create a new component instance.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
        <div>
            Hello {{ $name }}!
        </div>
        blade;
    }
}
