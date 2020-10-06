<?php

namespace App\Http\Controllers;

use App\Models\post;
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
        $post = post::all();
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         =>  'required',
            'desciption'    =>  'required',
            'user_id'       =>  'required',
            'img'           =>  'required'
        ]);
        post::create($request->all());
        return response()->json(['message'=>'post saved succesfully'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::where('id',$id);
        return response()->json($post);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'         =>  'required',
            'description'   =>  'required',
            'user_id'       =>  'required',
            'img'           =>  'required'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        post::where('id',$id)->delete();
        return response()->json(['message'=>'Borrado Correctamente'],201);
    }
}
