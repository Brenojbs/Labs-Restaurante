<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
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

    public function index(Request $request)
    {
        //  ['email', 'senha']
        $usuario = Usuario::where('email', $request->email)->get();
        return response()->json($usuario[0]->nome);
    }

//     public function get($id)
//     {
//         $usuario = Usuario::findOrFail($id);
//         return response()->json($usuario);
//     }

//     public function store(Request $request)
//     {
// // editar para colocar as verificações dos usuario.
//         $this->validate($request,[
//             'nome'=>'required|string|min:3',
//             'email'=>'required|string',
//         ]);
// // salvar um novo prato.
//         $usuario = Prato::create([
//             'nome'=>$request->input('nome'),
//             'email'=> $request->input('email'),
//         ]);

//         return response()->json($usuario);
//     }

//     public function update($id, Request $request)
//     {
//         // editar a verificação.
//         $this->validate($request,[
//             'nome'=>'required|string|min:3',
//             'email'=>'required|string',
//         ]);
// // achar o usuario por id.
//         $usuario = Usuario::findOrFail($id);
//         // salvar o usuario atualizado
//         $usuario->update($request->only('nome', 'email'));

//         return response()->json($usuario);
//     }

//     public function destroy($id){
//         $usuario = Usuario::findOrFail($id);
//         return response()->json($usuario->delete());
//     }

}
