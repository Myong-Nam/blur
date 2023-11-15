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

    #[Rule('nullable')]
    public $thumbnail_image;

    #[Rule('required|date')]
    public $start_date;

    #[Rule('nullable|after_or_equal:start_date')]
    public $end_date;

    #[Rule('nullable|image|max:1024')]
    public $uploaded_thumbnail_image = null;

    #[Rule('required')]
    public $location;

    #[Rule('required')]
    public $tags;

    public function setExhibition(Exhibition $exhibition)
    {
        $this->exhibition = $exhibition;
        $this->title = $exhibition->title;
        $this->type_id = $exhibition->type_id;
        $this->description = $exhibition->description;
        $this->thumbnail_image = $exhibition->thumbnail_image;
        $this->start_date = $exhibition->start_date;
        $this->end_date = $exhibition->end_date;
        $this->location = $exhibition->location;
        $this->tags = $exhibition->tags;
    }

    public function update()
    {
        if ($this->uploaded_thumbnail_image) {
            $image = $this->uploaded_thumbnail_image->store('exhibition_images');
            $this->exhibition->thumbnail_image = $image;
        }

        $this->exhibition->title = $this->title;
        $this->exhibition->type_id = $this->type_id;
        $this->exhibition->description = $this->description;
        $this->exhibition->start_date = $this->start_date;
        $this->exhibition->end_date = $this->end_date;
        $this->exhibition->location = $this->location;
        $this->exhibition->tags = $this->tags;

        $this->exhibition->update(
            $this->exhibition->toArray()
        );

    }
}
