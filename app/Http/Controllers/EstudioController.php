<?php

namespace App\Http\Controllers;

use App\Models\estudio;
use Illuminate\Http\Request;

class EstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudio = estudio::all();
        return response()->json($estudio);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required',
            'user_id' => 'required',
            'diametros' => 'required',
            'auricula_izquierda' => 'required',
            'cavidades_derechas' => 'required',
            'funcion' => 'required',
            'espesor' => 'required',
            'motilidad' => 'required',
            'valvula_mitral' => 'required',
            'raiz_aorta' => 'required',
            'valvula_aortica' => 'required',
            'valvula_tricuspide' => 'required',
            'valvula_pulmonar' => 'required',
            'pericardio_masas' => 'required',
            'vci' => 'required',
            'tabiques' => 'required',
            'patron' => 'required',
            'valvulopatias' => 'required',
            'conclusion' => 'required',
        ]);
        estudio::create($request->all());
        return response()->json(['message'=>'estudio creado correctamente'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudio = estudio::where('id',$id);
        return response()->json($estudio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estudio $estudio)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(estudio $estudio)
    {
        //
    }
}
