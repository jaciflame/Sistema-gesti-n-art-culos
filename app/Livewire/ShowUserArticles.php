<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateArticle;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUserArticles extends Component
{
    use WithPagination;

    public string $campo = "id", $orden = "desc";
    public string $buscar = "";

    public FormUpdateArticle $uform;
    public bool $openUpdate=false;
    public bool $openDetalle=false;
    public ?Article $articleDetalle=null;
    //MOSTRAR ARTICULOS
    #[On('onArticleCreado')]
    public function render()
    {
        $articles = DB::table('articles')
            ->join('tags', 'tag_id', '=', 'tags.id')
            ->select('articles.*', 'name', 'description')
            ->where('user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('title', 'like', "%{$this->buscar}%")
                    ->orWhere('content', 'like', "%{$this->buscar}%")
                    ->orWhere('name', 'like', "%{$this->buscar}%");
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);

            $tags=Tag::select('name', 'id')
            ->orderBy('name')->get();

        return view('livewire.show-user-articles', compact('articles', 'tags'));
    }

    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == 'asc') ? 'desc' : 'asc';
        $this->campo = $campo;
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }
    //BORRAR ARTICULO
    public function confirmarDelete(Article $article){
        $this->authorize('delete', $article);
        $this->dispatch('onBorrarArticle', $article->id);
    }

    #[On('borrarOk')]
    public function delete(Article $article){
        $this->authorize('delete', $article);
        $article->delete();
        $this->dispatch('mensaje', 'Articulo Eliminado');
    }
    // EDITAR ARTICULO
    public function editArticle(article $article){  
        $this->authorize('update', $article);
        $this->uform->setArticle($article);
        $this->openUpdate=true;
    }
    public function update(){
        $this->authorize('update', $this->uform->article);
        $this->uform->formUpdateArticle();
        $this->cancelar();
        $this->dispatch('mensaje', 'Articulo editado');
    }
    public function cancelar(){
        $this->openUpdate=false;
        $this->uform->formReset();
    }
    //ABRIL MODAL Y MOSTRAR DETALLES
    public function detalle(Article $article){
        $this->articleDetalle=$article;
        $this->openDetalle=true;
    }
    public function cerrarDetalle(){
        $this->reset('articleDetalle', 'openDetalle');
    }
}
