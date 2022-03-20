<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $posts = Post::latest('id')->paginate(7);
//        return $posts;
        return view('index',['posts'=>$posts]);
    }

    public function detail($slug){
//        $post = Post::where('slug',$slug)->first();
        $post = Post::where('slug',$slug)->with(['comments','galleries'])->firstOrFail();
        return view('post.detail',['post'=>$post]);
    }

    public function jobTest(){

        //store in job table
        dispatch(function (){
//            sleep(3);
            logger("JOB TESTING");
        })->delay(now()->addSecond(5));

        return "Hello Job";
    }
}
