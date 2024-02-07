<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;
    public $from=0;
    public $to=500;
    public function render()
    {
        dd($this->from);
        $product = Product::when(request()->filled('from') && request()->filled('to'), function ($query) {
            $query->where('price_after_discount', '>', request()->input('from'))
                  ->where('price_after_discount', '<', request()->input('to'));
        })
        ->paginate(12);
        dd($this->to);
        return view('livewire.filter',['products'=>$product]);
    }
}
