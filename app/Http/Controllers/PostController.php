<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = \DB::table('posts')
                    ->select('users.name','posts.id','title','description','user_id','img','posts.created_at')
                    ->join('users','user_id','=','users.id')
                    ->orderBy('posts.id','desc')
                    ->paginate(2);
        
        return response()->json(['pagination'=>[
            'total'         => $post->total(),
            'current_page'  => $post->currentPage(),
            'per_page'      => $post->perPage(),
            'last_page'     => $post->lastPage(),
            'from'          => $post->firstItem(),
            'to'            => $post->lastPage(),
        ],'posts'           =>$post]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         =>  'required',
            'description'   =>  'required',
            'user_id'       =>  'required',
            'img'           =>  'required'
        ]);
        if($request->hasFile('img')){
            if ($request->file('img')->isValid()) {
                $name = $request->img->getClientOriginalName();
                $request->img->storeAs('public/img',$name);
                
                $post = new post;
                $post->title = $request->title;
                $post->description = $request->description;
                $post->user_id = $request->user_id;
                $post->img = $name;
                $post->save();
                //post::create($request->all());
                return response()->json(['message'=>'post saved succesfully',$request->title],201);
            }else{
                return response()->json(['error'=>'File no valid'],401);
            }

            
        }else{
            return response()->json(['error'=>'no image detected'],401);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::where('id',$id)->first();
        //dd($post);
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
