<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);

        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name','id')->all();
        $tags = Tag::lists('name','id')->all();
        
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd($request);
        $this->validate($request,[
            'title'         => 'required|max:255',
            'slug'          => 'required|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
            'body'          => 'required'
        ]);

        $post = new Post;

        $post->title    = $request->title;
        $post->slug     = $request->slug;
        $post->category_id = $request->category_id;
        $post->body     = $request->body;
        
        //save image
        if($request->hasFile('featured_image')){
            $image  = $request->file('featured_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);

            Image::make($image)->resize(800,400)->save($location);

            $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false);




        Session::flash('success','The blog post was successfully save!');

        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        $categories = Category::lists('name','id')->all();
        $tags = Tag::lists('name','id')->all();

        return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);


        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => "required|min:5|max:255|unique:posts,slug,$id",
            'category_id'=> 'required|integer',
            'body' => 'required',
            'featured_image'=>'image'
        ]);


        $post = Post::find($id);

        $post->title    = $request->input('title');
        $post->slug     = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body     = $request->input('body');

        if($request->hasFile('featured_image')){
            //add new photo
            $image  = $request->file('featured_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);

            Image::make($image)->resize(800,400)->save($location);
            $oldFilename = $post->image;
            //update the database
            $post->image = $filename;
            //Delete old photo
            Storage::delete($oldFilename);
        }


        $post->save();

        if(isset($request->tags)){
            $post->tags()->sync($request->tags);//true : delete old data, then overwrite data
        } else {
            $post->tags()->sync([]);
        }


        Session::flash('success','This post was successfully saved.');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        $post->tags()->detach();
        Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The post was successfully deleted.');

        return redirect()->route('posts.index');
    }




}
