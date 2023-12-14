<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use App\Models\Exhibition;
use Livewire\Component;

class Exhibitions extends Component
{

    #[Url]
    public $tag = '';

    public $perPage = 12;

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function render()
    {
        $exhibitions = Exhibition::where('start_date', '<', now())
            ->where('end_date', '>', now())
            ->where('tags', 'like', '%' . $this->tag . '%')
            ->orderBy('created_at')
            ->paginate($this->perPage);
        return view('livewire.exhibitions', ['exhibitions' => $exhibitions]);
    }

}
