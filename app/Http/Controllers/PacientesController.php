<?php

namespace App\Http\Controllers;

use App\Models\pacientes;
use Illuminate\Http\Request;


class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = pacientes::all();
        return response()->json($pacientes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'            =>  'required',
            'apellido'          =>  'required',
            'dni'               =>  'required',
            'fecha_nacimiento'  =>  'required'
        ]);
        $carbon_fecha_nacimiento= \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_nacimiento);
        $request->fecha_nacimiento = $carbon_fecha_nacimiento;

        pacientes::create($request->all());
        return response()->json(['message'=>'Ingresado correctamente'],204);
    }

    public function show($id)
    {
        $paciente = pacientes::where('id',$paciente->id);
        return response()->json($paciente);
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'nombre'            =>  'required',
            'apellido'          =>  'required',
            'dni'               =>  'required',
            'fecha_nacimiento'  =>  'required'
        ]);
        $carbon_fecha_nacimiento= \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_nacimiento);
        $request->fecha_nacimiento = $carbon_fecha_nacimiento;

        pacientes::where('id','=', $request->id)->update($request->except('id'));
        return response()->json(['message'=>'Ingresado correctamente'],204);
    }

    
    public function destroy($id)
    {
        $delete = pacientes::where('id',$id)->delete();

        return response()->json(['message'=>'borrado correctamente'],201);
    }
}
