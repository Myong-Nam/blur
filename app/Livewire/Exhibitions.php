<?php

namespace App\Livewire;

use App\Models\Exhibition;
use Livewire\Component;

class Exhibitions extends Component
{
    public function render()
    {
        $exhibitions = Exhibition::all();
        return view('livewire.exhibitions', ['exhibitions' => $exhibitions]);
    }
}
