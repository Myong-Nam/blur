<?php

namespace App\Livewire\Forms;

use App\Models\Exhibition;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ExhibitionForm extends Form
{

    public $exhibition;

    #[Rule('required')]
    public $title = '';

    #[Rule('required|integer')]
    public $type_id;

    public function setExhibition(Exhibition $exhibition)
    {
        $this->exhibition = $exhibition;
        $this->title = $exhibition->title;
        $this->type_id = $exhibition->type_id;
    }

    public function update()
    {
        $this->exhibition->title = $this->title;
        $this->exhibition->type_id = $this->type_id;
        $this->exhibition->update(
            $this->exhibition->toArray()
        );

    }
}
