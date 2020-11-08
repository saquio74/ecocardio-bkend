<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
                    ->select('users.name','posts.id','title','description','user_id','img','like','dislike','posts.created_at')
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
                $post->title        = $request->title;
                $post->description  = $request->description;
                $post->user_id      = $request->user_id;
                $post->img          = $name;
                $post->like         = 0;
                $post->dislike      = 0;
                $post->save();
                //post::create($request->all());
                return response()->json(['message'=>'post saved succesfully'],201);
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
        return response()->json($post);
    }
    public function myPosts($id)
    {
        //$post = post::where('user_id',$id)->paginate(2);
        $post = \DB::table('posts')
                    ->select('users.name','posts.id','title','description','user_id','like','dislike','img','posts.created_at')
                    ->join('users','user_id','=','users.id')
                    ->where('user_id','=',$id)
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

    public function update(Request $request)
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
                
                $post = post::where('id',$request->id)->first();
                //Storage::delete('public/img'.$post->img);
                File::delete('public/img',$post->img);
                $post->title = $request->title;
                $post->description = $request->description;
                $post->user_id = $request->user_id;
                $post->img = $name;
                $post->save();
                return response()->json(['message'=>'post saved succesfully'],201);
                //post::create($request->all());
            }else{
                return response()->json(['error'=>'File no valid'],401);
            }

            
        }else{
            return response()->json(['error'=>'no image detected'],401);
        }
    }

    public function likeDislike(Request $request){
        
        $request->validate([
            'user_id'   =>  'required',
            'post_id'   =>  'required',
            'tipo'      =>  'required',
        ]);
        try {
            $vote = votes::where('user_id',$request->user_id)
                        ->where('post_id',$request->post_id)->first();
            $post = post::where('id','=',$request->post_id)->first();
            
            if($vote){
                if($vote->tipo == 'like'){
                    $post->like --;
                }else{
                    $post->dislike--;
                }
                $vote->delete();
                $post->save();
                return response()->json(['message'=>'voto quitado correctamente'],201);
            }
            if($request->tipo == 'like'){
                $post->like++;
            }else{
                $post->dislike++;
            }
            $post->save();
            $newVote = new votes;
            $newVote->user_id   =   $request->user_id;
            $newVote->post_id   =   $request->post_id;
            $newVote->tipo      =   $request->tipo ;
            $newVote->save();
            return response()->json(['message'=>'ha votado correctamente'],201);
        } catch (\Throwable $th) {
            return response()->json(['error'=>'ha ocurrido un error'],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::where('id',$id)->first();
        File::delete('public/img',$post->img);
        $post->delete();
        return response()->json(['message'=>'Borrado Correctamente'],201);
    }
}
