<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $articleTitle = $request->input("articleTitle");
        $articleType = $request->input("articleType");
        $articleContent = $request->input("articleContent");

        if($articleTitle==null || trim($articleTitle)==""){
          return back()->with('error_title', 'Please input title of article');
        }

        if($articleContent==null || trim($articleContent)==""){
          echo "<script>alert('Content of article cannot be empty');</script>";
          return back()->with('error_content', 'Please input content');
        }

        $username = $request->session()->get("username");
        $matchThese = [
          'name'=>$username
        ];
        $user = User::where($matchThese)->firstOrFail();
        $user_id = $user->id;
        $newPost = new Post(['title'=>$articleTitle, 'type'=>$articleType, 'content'=>$articleContent, 'owner_id'=>$user_id]);
        $isSaved = $newPost->save();
        var_dump($isSaved);
        return "PostController.store() ".$articleContent.$articleType." ".$articleTitle." ".$username;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
