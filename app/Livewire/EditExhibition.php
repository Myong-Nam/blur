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
        $validatedData = $this->form->validate();
        // 파일 업로드 처리
        if (array_key_exists('uploaded_thumbnail_image', $validatedData) && $validatedData['uploaded_thumbnail_image']) {
            $imagePath = $validatedData['uploaded_thumbnail_image']->store('exhibition_images');
            $this->exhibitionId->thumbnail_image = $imagePath;
        }

        // 데이터베이스 업데이트를 위해 uploaded_thumbnail_image 필드 제거
        unset($validatedData['uploaded_thumbnail_image']);

        $this->exhibitionId->update($validatedData);
        $this->successMessage = 'Exhibition updated successfully.';
        $this->showSuccessMessage = true;

    }

    public function render()
    {
        return view('livewire.edit-exhibition')->with('types', Type::all());
    }
}
