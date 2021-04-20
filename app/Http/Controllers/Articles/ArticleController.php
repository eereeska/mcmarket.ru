<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index');
    }

    public function create()
    {
        return view('articles.create');
    }

    public function edit($id)
    {
        $article = Article::where('id', $id)->first();

        if (!$article) {
            return redirect('home');
        }

        return view('articles.edit', compact($article));
    }
}
