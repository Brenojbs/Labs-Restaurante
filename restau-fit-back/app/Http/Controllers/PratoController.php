<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use Illuminate\Http\Request;

class PratoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {

        $pratos = Prato::get(['id','nome','categoria', 'imagem', 'preço']);
        return response()->json($pratos);
    }

    public function get($id)
    {
        $prato = Prato::findOrFail($id);
        return response()->json($prato);
    }

    public function store(Request $request)
    {
// editar para colocar as verificações dos pratos.
        $this->validate($request,[
            'nome'=>'required|string|min:3',
            'categoria'=>'required|string',
            'image' => 'required|url',
            'preço' => 'required|integer'
        ]);
// salvar um novo prato.
        $pratos = Prato::create([
            'nome'=>$request->input('nome'),
            'categoria'=> $request->input('categoria'),
            'image' => $request->input('image'),
            'preço' => $request->input('preço')
        ]);

        return response()->json($pratos);
    }

    public function update($id, Request $request)
    {
        // editar a verificação.
        $this->validate($request,[
            'nome'=>'sometimes|required|string|min:3',
            'categoria'=>'sometimes|required|string',
            'image' => 'sometimes|required|url',
            'preço' => 'sometimes|required|integer'
        ]);
// achar o prato por id.
        $prato = Prato::findOrFail($id);
        // salvar o prato atualizado
        $prato->update($request->only('nome', 'categoria', 'image', 'preço'));

        return response()->json($prato);
    }

    public function destroy($id){
        $prato = Prato::findOrFail($id);
        return response()->json($prato->delete());
    }

}
