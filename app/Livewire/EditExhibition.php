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

    public function updateExhibition()
    {
        $this->form->update();
        $this->successMessage = 'Exhibition updated successfully.';
        $this->showSuccessMessage = true;

    }

    public function render()
    {
        return view('livewire.edit-exhibition')->with('types', Type::all());
    }
}
