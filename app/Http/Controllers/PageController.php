<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $posts = Post::latest('id')->get();
        return view('index',['posts'=>$posts]);
    }

    public function detail($slug){
        $post = Post::where('slug',$slug)->first();
        return view('post.detail',['post'=>$post]);
    }
}
