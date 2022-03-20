<?php

namespace App\Http\Controllers;

use App\Classes\FileControl;
use App\Jobs\CreateFile;
use App\Mail\PostMail;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Image;

class PostController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        /**
         * Move in Request
        **/
//        $request->validate([
//            'title'=> 'required|unique:posts,title|min:5',
//            'description'=>'required|min:15',
//            'cover' => 'required|file|mimes:png,jpeg|max:5000',
//        ]);

        /**
         * Using Classes
        **/
//        $dir = "public/cover/";
//        $newName = "cover_".uniqid().".".$request->file('cover')->extension();
//        $request->file('cover')->storeAs($dir,$newName);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,100);
        $post->cover = FileControl::FileSave('cover');
        $post->user_id = auth()->id();
        $post->save();

        /**
         * Mail Send
         * App/Mail/PostMail
        **/

//        Mail::to('kyaingthinswe1528@gmail.com')->send(new PostMail($post));

//        $PostMail = new PostMail($post);
//        $PostMail->from("kts@mms-student.online","စမ်းပို့ကြည့်တာပါ")
//            ->subject("Hello Everyone!");
//        Mail::to('kyaingthinswe1528@gmail.com')->send($PostMail);

//        $userMails = ['kyaingthinswe1528@gmail.com','ktstu97@gmail.com'];
//        foreach ($userMails as $u){
////            Mail::to($u)->send(new PostMail($post));
//            Mail::to($u)->later(now()->addSecond(10),new PostMail($post));
//        }

        /**
         * Version ခွဲပြီး သိမ်းကြည့်
         * App/Jobs/CreateFile.php
        **/

//        CreateFile::dispatch($newName)->delay(now()->addSecond(5));
//        CreateFile::dispatch(FileControl::FileSave('cover','cover'))->delay(now()->addSecond(5));

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return redirect()->route('post.detail',$post->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update',$post);
        return view('post.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

//        $request->validate([
//            'title'=> "required|unique:posts,title,$post->id|min:5",
//            'description'=>'required|min:15',
//            'cover' => 'nullable|file|mimes:png,jpeg|max:5000',
//        ]);


        $post->title = $request->title;
        $post->slug = Str::slug($post->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($post->description,80);

        if ($request->hasFile('cover')){

            Storage::delete('public/cover/'.$post->cover);

//            $dir = "public/cover/";
//            $newName = "cover_".uniqid()."_".$request->file('cover')->extension();
//            $request->file('cover')->storeAs($dir,$newName);

//            $post->cover = $newName;
            $post->cover = FileControl::FileSave('cover');

        }
        $post->update();


        return redirect()->route('post.detail',$post->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete',$post);
//        Storage::delete('public/cover/'.$post->cover);
        $post->delete();
        return redirect()->route('index');
    }
}
