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
    #[Rule('max:255', message: 'The title may not be greater than 255 characters')]
    public $title = '';

    #[Rule('required', message: 'The category field is required')]
    public $type_id;

    #[Rule('required')]
    #[Rule('min:10', message: 'The description must be at least 10 characters')]
    public $description;

    #[Rule('nullable')]
    public $thumbnail_image;

    #[Rule('required', message: 'The start date field is required')]
    public $start_date;

    #[Rule('nullable')]
    #[Rule('after_or_equal:start_date', message: 'The end date must not be earlier than the start date')]
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
        unset($this->uploaded_thumbnail_image);
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
