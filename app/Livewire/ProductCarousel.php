<?php

namespace App\Livewire;

use Livewire\Component;

class ProductCarousel extends Component
{
    public $images = [];

    public function mount($images)
    {
        $this->images = $images;
    }

    public function render()
    {
        return view('product_detail.product-carousel');
    }
}
