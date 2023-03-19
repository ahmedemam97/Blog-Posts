<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        if ($posts == null) {
            return view('404');
        }
        return view('blog.index')->with('posts', Post::get());   // we send data as a variable to view page
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(([
            'title' => 'required',
            'content' => 'min:20|required',
            'image' => 'max:2048|mimes:png,jpg,webp'
        ]));

        $image = uniqid() . '-' . $request->title . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('image_for_web'), $image);                //public_path() ==> helper function



        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $image,
            'user_id' => auth()->user()->id,
            'author' => auth()->user()->name
        ]);


        return redirect('/blog');
        // $data = new Post;
        // $data->title = $request->title;
        // $data->content = $request->content;

        // $data->save();
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        return view('blog.show')->with('posts', Post::where('id', $id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('blog.edit')->with('posts', Post::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(([
            'title' => 'required',
            'content' => 'min:20|required',
            'image' => 'max:2048|mimes:png,jpg,webp'
        ]));

        $image = uniqid() . '-' . $request->title . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('image_for_web'), $image);

        Post::where('id', $id)->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $image,
            'user_id' => auth()->user()->id,
            'author' => auth()->user()->name
        ]);

        return redirect('/blog/' . $id)->with('message', 'Update Complete');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/blog')->with('message', 'Post Deleted');
    }


    
}
