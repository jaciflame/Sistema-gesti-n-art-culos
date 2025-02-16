<?php

namespace App\Livewire\Forms;

use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormUpdateTag extends Form
{
    public ?Tag $tag = null;
    //VALIDACIONES
    #[Rule(['required', 'string', 'min:3', 'max:100', 'unique:tags,name'])]
    public string $name="";
    
    #[Rule(['nullable', 'string', 'min:15', 'max:300'])]
    public ?string $description = null;

    public function setTag(Tag $tag) {
        $this->tag=$tag;
        $this->name=$tag->name;
        $this->description=$tag->description;
    }
    // GUARDAR EL FORMULARIO
    public function formUpdateTag()
    {
        $this->validate();
        $this->tag->update([
            'name' => $this->name,
            'description' => $this->description
        ]);
    }
    public function formReset()
    {
        $this->resetValidation();
        $this->reset();
    }
}
