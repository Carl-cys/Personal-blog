<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function about()
    {
        $about = About::select(['title', 'abstract', 'content'])->first();
        return view('home.about', compact('about'));
    }
}
