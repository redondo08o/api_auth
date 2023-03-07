<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cursos;
class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Cursos::all();
        return $cursos;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $curso = new Cursos();
        $curso->nombre=$request->nombre;  
        $curso->descripcion = $request->descripcion;
        $curso->img = $request->img;  
        
        $curso->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $curso = Cursos::findOrfail($request->id);
        $curso->nombre=$request->nombre;  
        $curso->descripcion = $request->descripcion;
        $curso->img = $request->img;  
        
        $curso->save();
        return $curso;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       $curso =  Cursos::destroy($request->id);
    }
}
