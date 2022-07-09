<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    /**
     * Get user actual
     *
     * @return void
     */
    public function me()
    {
        return response()->json(
            auth()->user()
        );
    }

    /**
     * Get list of users
     *
     * @return void
     */
    public function getUsers()
    {
        return response()->json([
            'list' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->get();
        if ($user) {
            return 'Email existente!';
        }
        $this->validate($request,[
            'nome'=>'required|string|min:3',
            'email'=>'required|string',
            'password'=>'required|string',
            'categoria'=>'required|string',
        ]);
        $senha = Hash::make($request->input('password'));
        $user = User::create([
            'nome'=>$request->input('nome'),
            'email'=> $request->input('email'),
            'password'=> $senha,
            'categoria'=> $request->input('categoria'),
        ]);

        return response()->json($user);
    }
}

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;

// class UserController extends Controller
// {
//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         //
//     }

    // public function index(Request $request)
//     {
//         //  ['email', 'password']
//         $user = User::where('email', $request->email)->get();
//         return response()->json($user[0]->nome);
//     }

// //     public function get($id)
// //     {
// //         $user = User::findOrFail($id);
// //         return response()->json($user);
// //     }

// //     public function store(Request $request)
// //     {
// //         $this->validate($request,[
// //             'nome'=>'required|string|min:3',
// //             'email'=>'required|string',
// //         ]);
// //         $user = User::create([
// //             'nome'=>$request->input('nome'),
// //             'email'=> $request->input('email'),
// //         ]);

// //         return response()->json($user);
// //     }

// //     public function update($id, Request $request)
// //     {
// //         // editar a verificação.
// //         $this->validate($request,[
// //             'nome'=>'required|string|min:3',
// //             'email'=>'required|string',
// //         ]);
// // // achar o user por id.
// //         $user = User::findOrFail($id);
// //         // salvar o user atualizado
// //         $user->update($request->only('nome', 'email'));

// //         return response()->json($user);
// //     }

// //     public function destroy($id){
// //         $user = User::findOrFail($id);
// //         return response()->json($user->delete());
// //     }

// }
