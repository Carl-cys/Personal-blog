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
        $figure = Figure::figure();
        if( is_file( "./templates/static/about/about.html" ) ){
            //存在就读取静态文件
            return file_get_contents("./templates/static/about/about.html");

        } else {

            $aboutstatic = view('home.about', compact('about','figure','request'))->__toString();

            file_put_contents("./templates/static/about/about.html" , $aboutstatic );

            return view('home.about', compact('about','figure','request'));
        }

    }
}

