<?php

namespace App\Livewire\Forms;

use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormCrearTag extends Form
{
    #[Rule(['required', 'string', 'min:3', 'max:100', 'unique:tags,name'])]
    public string $name="";
    
    #[Rule(['string', 'min:15', 'max:300'])]
    public string $description="";
    // GUARDAR EL FORMULARIO
    public function formStore(){
        $this->validate();
        Tag::create([
            'name'=>$this->name,
            'description'=>$this->description,
        ]);

    }
    public function formReset(){
        $this->resetValidation();
        $this->reset();
    }
}
