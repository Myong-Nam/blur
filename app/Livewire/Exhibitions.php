<?php

namespace App\Livewire;

use App\Models\Exhibition;
use Livewire\Attributes\Url;
use Livewire\Component;

class Exhibitions extends Component
{

    #[Url]
    public $tag = '';

    #[Url]
    public $search = '';

    #the number of exhibitions to show per page
    public $perPage = 12;

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function render()
    {

        $now = now();
        $query = Exhibition::where('start_date', '<', $now)
            ->where('end_date', '>', $now)
            ->orderBy('created_at');

        if ($this->tag !== '') {
            $query->where('tags', 'like', '%' . $this->tag . '%');
        } elseif ($this->search !== '') {
            $query->where(function ($q) {
                $searchTerm = '%' . $this->search . '%';
                $q->where('title', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm)
                    ->orWhere('location', 'like', $searchTerm)
                    ->orWhere('museum', 'like', $searchTerm)
                    ->orWhere('address', 'like', $searchTerm)
                    ->orWhere('tags', 'like', $searchTerm);
            });
        }

        $exhibitions = $query->paginate($this->perPage);

        return view('livewire.exhibitions', ['exhibitions' => $exhibitions]);
    }

}
