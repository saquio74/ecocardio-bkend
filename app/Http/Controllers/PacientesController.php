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
            'tipo_dni'          =>  'required',
            'fecha_nacimiento'  =>  'required',
            'direccion'         =>  'required',
            'localidad'         =>  'required',
            'provincia'         =>  'required',
            'telefono'          =>  'required',
            'celular'           =>  'required',
            'email'             =>  'required',
            'cobertura'         =>  'required',
            'tipo_de_af'        =>  'required',
            'cuit'              =>  'required|unique:pacientes',
            'n_af'              =>  'required',
            
        ]);

        $carbon_fecha_nacimiento= \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_nacimiento);
        $request->fecha_nacimiento = $carbon_fecha_nacimiento;

        pacientes::create($request->all());
        return response()->json(['message'=>'Ingresado correctamente'],204);
    }

    public function show($dni)
    {
        $paciente = pacientes::where('dni','=',$dni)->first();
        if($paciente){

            return response()->json($paciente);
        }else{
            return response()->json(['message'=>'no existe paciente'],422);
        }
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'nombre'            =>  'required',
            'apellido'          =>  'required',
            'dni'               =>  'required',
            'tipo_dni'          =>  'required',
            'fecha_nacimiento'  =>  'required',
            'direccion'         =>  'required',
            'localidad'         =>  'required',
            'provincia'         =>  'required',
            'telefono'          =>  'required',
            'celular'           =>  'required',
            'email'             =>  'required',
            'cobertura'         =>  'required',
            'tipo_de_af'        =>  'required',
            'cuit'              =>  'required',
            'n_af'              =>  'required',
        ]);
        $carbon_fecha_nacimiento= \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_nacimiento);
        $request->fecha_nacimiento = $carbon_fecha_nacimiento;

        pacientes::where('id','=', $request->id)->update($request->except('id','created_at','updated_at'));
        return response()->json(['message'=>'actualizado correctamente'],201);
    }

    
    public function destroy($id)
    {
        $delete = pacientes::where('id',$id)->delete();

        return response()->json(['message'=>'borrado correctamente'],201);
    }
}
