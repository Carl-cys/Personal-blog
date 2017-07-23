<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use App\Models\Figure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function about(Request $request)
    {
        $about = About::select(['title', 'abstract', 'content'])->first();
        //图片加格言
        $figure =  Figure::select([ 'url','motto', 'img', 'id' ])->get();
        return view('home.about', compact('about','figure','request'));
    }
}
