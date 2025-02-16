<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateTag;
use App\Models\Tag;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTags extends Component
{
    use WithPagination;

    public string $campo = "id", $orden = "desc";
    public string $buscar = "";

    public FormUpdateTag $uform;
    public bool $openUpdateTag=false;
    public bool $openDetalleTag=false;
    public ?Tag $tagDetalle=null;
    //MOSTRAR LOS TAGS
    #[On('onTagCreado')]
    public function render()
    {
        $tags = Tag::query()
            ->select('id', 'name', 'description')
            ->where(function ($query) {
                $query->where('name', 'like', "%{$this->buscar}%")
                    ->orWhere('description', 'like', "%{$this->buscar}%");
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);

        return view('livewire.show-tags', compact('tags'));
    }
    //ORDENAR LOS TAGS
    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == 'asc') ? 'desc' : 'asc';
        $this->campo = $campo;
    }
    //BUSCAR LOS TAGS
    public function updatingBuscar()
    {
        $this->resetPage();
    }
    //BORRAR TAG
    public function confirmarDelete(Tag $tag){
        $this->authorize('delete', $tag);
        $this->dispatch('onBorrarTag', $tag->id);
    }

    #[On('borrarOk')]
    public function delete(Tag $tag){
        $this->authorize('delete', $tag);
        $tag->delete();
        $this->dispatch('mensaje', 'Tag Eliminado');
    }
    // EDITAR TAG
    public function edit(Tag $tag){  
        $this->authorize('update', $tag);
        $this->uform->setTag($tag);
        $this->openUpdateTag=true;
    }
    public function update(){
        $this->authorize('update', $this->uform->tag);
        $this->uform->formUpdateTag();
        $this->cancelar();
        $this->dispatch('mensaje', 'Tag Editado');
    }
    public function cancelar(){
        $this->openUpdateTag=false;
        $this->uform->formReset();
    }
    //ABRIL MODAL Y MOSTRAR DETALLES
    public function detalle(Tag $tag){
        $this->tagDetalle=$tag;
        $this->openDetalleTag=true;
    }
    public function cerrarDetalle(){
        $this->reset('tagDetalle', 'openDetalleTag');
    }
}
