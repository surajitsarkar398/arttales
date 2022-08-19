<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Validator;
use App\Http\Utility\CustomVerfication;
use DB;
use Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $register_id=Auth::user()->regisetr_id;
        $postlist = Post::join('users','posts.register_id','=','users.register_id')
         ->select('posts.*','users.name')->where('posts.register_id','=',$register_id)
        ->orderBy('post_id', 'DESC')
        ->get();


        return view('post.viewpost', compact('postlist'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $post_details = Post::join('users','posts.register_id','=','users.register_id')
        ->select('posts.*','users.name')->where('post_id',$id)
       ->orderBy('post_id', 'DESC')
       ->get();
        return view('post/viewpostdetails',compact('post_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Postt::where('post_id','=',$id)->delete();
        return redirect('/post/viewpost/')->with('success','Post Has Deleted');
    }
}
