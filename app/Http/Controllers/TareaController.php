<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TareaaController extends Controller
{
    public function CrearTarea(Request $request){
        $validation = Validator::make($request->all(), [
            'Titulo' => 'required|max:16|min:1',
            'Contenido' => 'required|max:64|min:1',
            'autor' => 'required|max:16|min:1'
        ]);

        if($validation->fails())
            return response($validation->errors(), 401);
            $tarea = new Tarea();
            $tarea -> Titulo = $request -> post('Titulo');
            $tarea -> Contenido = $request -> post('Contenido');
            $tarea -> Estado = 'En Curso';
            $tarea -> autor = $request -> post('autor');
            $tarea -> save();
            return $tarea;
    }

    public function ListarTodasLasTareas(Request $request){
        return Tarea::all();
    }

    public function ListarUnaTarea(Request $request, $id){
        return Tarea::FindOrFail($id);
    }

    public function ActualizarTarea(Request $request, $id){
            $validation = Validator::make($request->all(), [
            'Titulo' => 'max:16|min:1',
            'Contenido' => 'max:64|min:1',
            'Estado' => 'in:Finalizado,En Curso',
            'autor' => 'max:16|min:1'
        ]);

        if($validation->fails())
            return response($validation->errors(), 401);
            $tarea = Tarea::FindOrFail($id);
            $tarea -> Titulo = $request -> input('Titulo', $tarea->Titulo);
            $tarea -> Contenido = $request -> input('Contenido',$tarea->Contenido);
            $tarea -> Estado = $request -> input('Estado',$tarea->Estado);
            $tarea -> autor = $request -> input('autor', $tarea->autor);
            $tarea -> save();
            return $tarea;
    }

    public function EliminarTarea(Request $request, $id){
        Tarea::FindOrFail($id) -> delete();
    }

    public function buscarTareas(Request $request){
        $nombre = $request->input('nombre');
        $estado = $request->input('estado');
        $autor = $request->input('autor');

        $tareas = Tarea::query();

        if ($nombre){
            $tareas->where('nombre', "$nombre");
        }
    
        if ($estado){
        $tareas->where('estado', $estado);
        }

        if ($autor) {
        $tareas->where('autor', 'like', "%$autor%");
        }   

        $resultados = $tareas->get();

        return view('tareas.blade.php', compact('resultados'));
}
}
