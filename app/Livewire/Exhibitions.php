<?php

namespace App\Livewire;

use App\Models\Exhibition;
use Livewire\Component;

class Exhibitions extends Component
{
    public function render()
    {
        $exhibitions = Exhibition::paginate(12);
        return view('livewire.exhibitions', ['exhibitions' => $exhibitions]);
    }

}
