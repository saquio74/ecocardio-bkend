<?php

namespace App\Http\Controllers;

use App\Models\comentarios;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{

    public function index($id)
    {
        $comentarios = \DB::table('comentarios')
                    ->select('users.name','comentarios.id','comentario','user_id','comentarios.created_at','comentarios.updated_at')
                    ->join('users','user_id','=','users.id')
                    ->where('comentarios.post_id','=',$id)
                    ->orderBy('comentarios.id','desc')
                    ->paginate(5);
        
        return response()->json(['pagination'=>[
            'total'         => $comentarios->total(),
            'current_page'  => $comentarios->currentPage(),
            'per_page'      => $comentarios->perPage(),
            'last_page'     => $comentarios->lastPage(),
            'from'          => $comentarios->firstItem(),
            'to'            => $comentarios->lastPage(),
        ],'comentarios'     => $comentarios]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'user_id'       =>  'required',
            'post_id'       =>  'required',
            'comentario'    =>  'required|max:200'
        ]);
        
            $comentario = new comentarios;
            $comentario->user_id        = $request->user_id;
            $comentario->post_id        = $request->post_id;
            $comentario->comentario     = $request->comentario;
            $comentario->save();
            return response()->json(['message'=>'Comentario guardado exitosamente'],204);
        
    }

    public function show($id)
    {
        $comentarios = \DB::table('comentarios')
                            ->select('user_id','post_id','comentario','comentarios.created_at','users.name')
                            ->join('users','users.id','=','user_id')
                            ->where('post_id','=',$id)
                            ->get();
        return response()->json($comentarios);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this.validate($request,[
            'id'            =>  'required',
            'user_id'       =>  'required',
            'post_id'       =>  'required',
            'comentario'    =>  'required|max:200'
        ]);
        try {
            $comentario = comentarios::whereId($request->id)->first();
            $comentario->user_id        = $request->user_id;
            $comentario->post_id        = $request->post_id;
            $comentario->comentario     = $request->comentario;
            $comentario->save();
            return response()->json(['message'=>'Comentario actualizado exitosamente'],204);
        } catch (\Throwable $th) {
            return response()->json(['Ocurrio un error al guardar','errors'=>$th],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //code...
            $comentario = comentarios::whereId($id)->first();
            $comentario->delete();
            return response()->json(['message'=>'borrado correctamente'],204);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'ocurrio un error','errors'=>$th],500);
        }
    }
}
