<?php

namespace App\Livewire\Forms;

use App\Models\Article;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormUpdateArticle extends Form
{
    public ?Article $article = null;
    //VALIDACIONES
    #[Rule(['required', 'string', 'min:3', 'max:100', 'unique:articles,title'])]
    public string $title="";
    
    #[Rule(['required','string', 'min:15', 'max:300'])]
    public string $content="";

    #[Rule(['required', 'exists:tags,id'])]    
    public int $tag_id=-1;

    public function setArticle(Article $article) {
        $this->article=$article;
        $this->title=$article->title;
        $this->content=$article->content;
        $this->tag_id=$article->tag_id;
    }
    // GUARDAR EL FORMULARIO
    public function formUpdateArticle()
    {
        $this->validate();
        $this->article->update([
            'title' => $this->title,
            'content' => $this->content,
            'tag_id' => $this->tag_id,
        ]);
    }
    public function formReset()
    {
        $this->resetValidation();
        $this->reset();
    }
}
