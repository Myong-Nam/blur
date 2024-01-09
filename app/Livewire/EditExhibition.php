<?php

namespace App\Livewire;

use App\Livewire\Forms\ExhibitionForm;
use App\Models\Exhibition;
use App\Models\Type;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditExhibition extends Component
{

    use WithFileUploads;

    public ExhibitionForm $form;
    public Exhibition $exhibitionId;
    public $showSuccessMessage = false;
    public $successMessage = '';

    #[Layout('layouts.app')]
    public function mount(Exhibition $exhibitionId)
    {
        $this->exhibitionId = $exhibitionId;
        $this->form->setExhibition($exhibitionId);

    }

    // Method to handle the exhibition update process
    public function updateExhibition()
    {
        $validatedData = $this->form->validate();
        $this->handleFileUpload($validatedData);
        $this->exhibitionId->update($validatedData);
        $this->successMessage = 'Exhibition updated successfully.';
        $this->showSuccessMessage = true;

    }

    // Method to handle file upload logic
    //Pass $validatedData by reference to modify the original array directly within this function
    private function handleFileUpload(&$validatedData)
    {
        if (array_key_exists('uploaded_thumbnail_image', $validatedData) && $validatedData['uploaded_thumbnail_image']) {
            $imagePath = $validatedData['uploaded_thumbnail_image']->store('exhibition_images');
            $this->exhibition->thumbnail_image = $imagePath;
        }
        unset($validatedData['uploaded_thumbnail_image']);
    }

    public function render()
    {
        return view('livewire.edit-exhibition')->with('types', Type::all());
    }
}
