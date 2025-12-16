<?php

namespace App\View\Components;

use Closure;
use App\Models\Promo;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class PromoBanner extends Component
{
    public $promos;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->promos = Promo::activenow()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.promo-banner');
    }
}
