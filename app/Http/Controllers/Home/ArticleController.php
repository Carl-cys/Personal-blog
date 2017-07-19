<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function article()
    {
        $article = Article::where('deleted_status', '=', 0)
            ->select(['title','clicks','content','author','created_at','id','img','abstract'])
            ->take(10)->get();
        return view('home.article', compact('article'));
    }

}
