<?php

namespace App\Livewire;

use App\Models\Exhibition;
use Livewire\Component;

class Exhibitions extends Component
{

    public $perPage = 12;

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function render()
    {
        // $exhibitions = Exhibition::latest()->paginate(12);
        $exhibitions = Exhibition::where('start_date', '<', now())
            ->where('end_date', '>', now())
            ->orderBy('created_at')
            ->paginate($this->perPage);
        return view('livewire.exhibitions', ['exhibitions' => $exhibitions]);
    }

}
