<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Transaction::all();

    }

    /**
     * @OA
     */
    public function store(Request $request)
    {
        //validacao campo obg
        $validated = $request->validatee([
            'tipo' => 'required|string|max:100',
            'valor' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categories, id',
            'usuario_id' => 'required|exists:user, id',
        ]);
        
        //criar agr
        $transaction = Transaction::create([
            'tipo' => $validated['tipo'],
            'valor' => $validated['valor'],
            'categoria_id' => $validated['categoria_id'],
            'usuario_id' => $validated['usuario_id'],
        ]);
        
        return response()->json($transaction, 201);
        
    }

    public function filter(Request $request)
    {
        $query = Transaction::query();

        if ($request->has('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->has('usuario_id')) {
            $query->where('usuario_id', $request->usuario_id);
        }

        $transactions = $query->get();

        return response()->json($transactions, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return response()->json(['message' => 'transacao excluido!']);
    }
}
