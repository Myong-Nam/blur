<?php

namespace App\Livewire\Forms;

use App\Models\Exhibition;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Livewire\WithFileUploads;

class ExhibitionForm extends Form
{

    use WithFileUploads;

    public $exhibition;

    #[Rule('required')]
    public $title = '';

    #[Rule('required|integer')]
    public $type_id;

    #[Rule('required|integer')]
    public $description;

    public $thumbnail_image;

    public function setExhibition(Exhibition $exhibition)
    {
        $this->exhibition = $exhibition;
        $this->title = $exhibition->title;
        $this->type_id = $exhibition->type_id;
        $this->description = $exhibition->description;
        $this->thumbnail_image = $exhibition->thumbnail_image;
    }

    public function update()
    {
        if ($this->thumbnail_image != null) {
            $image = $this->thumbnail_image->store('exhibition_images');
            $this->thumbnail_image = $image;
            $this->exhibition->thumbnail_image = $image;
        }

        $this->exhibition->title = $this->title;
        $this->exhibition->type_id = $this->type_id;
        $this->exhibition->description = $this->description;

        $this->exhibition->update(
            $this->exhibition->toArray()
        );

    }
}
