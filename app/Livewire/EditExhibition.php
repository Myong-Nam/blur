<?php

namespace App\Livewire;

use App\Livewire\Forms\ExhibitionForm;
use App\Models\Exhibition;
use App\Models\Type;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditExhibition extends Component
{
    public ExhibitionForm $form;
    public Exhibition $exhibitionId;

    public function updateExhibition()
    {
        $this->form->update();

        return $this->redirect('/exhibition/' . $this->exhibitionId->id);
    }

    #[Layout('layouts.app')]
    public function mount(Exhibition $exhibitionId)
    {
        $this->exhibitionId = $exhibitionId;
        $this->form->setExhibition($exhibitionId);

    }

    public function render()
    {
        return view('livewire.edit-exhibition')->with('types', Type::all());
    }
}
