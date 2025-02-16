<?php

namespace App\Http\Controllers;

use App\Models\Article;

class IndexController extends Controller
{
    public function index(){
        $articles=Article::with('user', 'tag')->orderBy('id', 'desc')->paginate(5);
        return view('welcome', compact('articles'));
    }
}
