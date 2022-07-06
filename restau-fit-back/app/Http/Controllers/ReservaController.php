<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
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

        $reservas = Reserva::get(['id','nome', 'data']);
        return response()->json($reservas);
    }

    public function get($id)
    {
        $reserva = Reserva::findOrFail($id);
        return response()->json($reserva);
    }

    public function store(Request $request)
    {
// editar para colocar as verificações dos reservas.
        $this->validate($request,[
            'nome'=>'required|string|min:3',
            'data'=>'required|string',
        ]);
// salvar um novo reserva.
        $reservas = Reserva::create([
            'nome'=>$request->input('nome'),
            'data'=> $request->input('data'),
        ]);

        return response()->json($reservas);
    }

    public function update($id, Request $request)
    {
        // editar a verificação.
        $this->validate($request,[
            'nome'=>'sometimes|required|string|min:3',
            'data'=>'sometimes|required|string',
        ]);
// achar o reserva por id.
        $reserva = Reserva::findOrFail($id);
        // salvar o reserva atualizado
        $reserva->update($request->only('nome', 'data'));

        return response()->json($reserva);
    }

    public function destroy($id){
        $reserva = Reserva::findOrFail($id);
        return response()->json($reserva->delete());
    }

}
