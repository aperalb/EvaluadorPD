<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Medicamento;
use Auth;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        User::validaRol('MEDICO');
        $medicamentos=Medicamento::all();
        $categorias= Medicamento::categorias();
        return view('medicamento.index',['medicamentos'=>$medicamentos,'categorias'=>$categorias]);
    }



    public function show($id)
{
    User::validaRol('MEDICO');
    $medicamento=Medicamento::find($id);
    return view('medicamento.show',['medicamento'=>$medicamento]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        User::validaRol('MEDICO');
        $categorias= Medicamento::categorias();

        return view('medicamento.create', ['categorias'=>$categorias]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::validaRol('MEDICO');
        $medicamento = new Medicamento();
        if($request->get('categoriaNueva') != '' && $request->get('categoriaNueva') != null ){
            $medicamento->categoria = $request->get('categoriaNueva');
        }else{
            $categoria = Medicamento::categorias()[$request->get('categoriaExistente')];
            $medicamento->categoria = $categoria;
        }
        $medicamento->nombre = $request->get('nombre');
        $medicamento->descripcion = $request->get('descripcion');
        $medicamento->save();
        return redirect('medicamento')->with('success', 'Elemento agregado correctamente');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        User::validaRol('MEDICO');
        $medicamento = Medicamento::find($id);
        $categorias = Medicamento::categorias();
        return view('medicamento.edit', ['medicamento'=>$medicamento, 'categorias'=>$categorias]);

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
        //
    }
    public function delete($id)
    {
        User::validaRol('MEDICO');
        $medicamento = Medicamento::find($id);
        $medicamento->delete();
        return redirect()->route('medicamento.index')->with('danger', 'Elemento eliminado correctamente');
    }
}
