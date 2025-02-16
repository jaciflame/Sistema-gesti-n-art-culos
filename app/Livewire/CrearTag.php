<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCrearTag;
use App\Models\Tag;
use Livewire\Component;

class CrearTag extends Component
{
    public bool $openCrear=false;

    public FormCrearTag $cform;

    public function render()
    {
        return view('livewire.crear-tag');
    }
    //GUARDAR TAG
    public function store(){
        $this->cform->formStore();
        $this->cancelar();
        $this->dispatch('onTagCreado')->to(ShowTags::class);
        $this->dispatch('mensaje', 'Tag Creado');
    }
    public function cancelar(){
        $this->openCrear=false;
        $this->cform->formReset();
    }
}
