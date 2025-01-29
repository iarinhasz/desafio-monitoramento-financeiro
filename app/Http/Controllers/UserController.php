<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //cadastra, atualiza e deleta apenas
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validacao campo obg
        $validated = $request->validade([
            'cpf' => 'required|unique:users|max:11',
            'name' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);

        //criar agr
        $user = User::create([
            'cpf' => $validated['cpf'],
            'name' => $validated['name'],
            'data_nascimento' => $validated['data_nascimento'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json($user, 201);

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $user = User::findOrFail($id);

        $validated = $request->validade([
            'name' => 'sometimes|string|max:255',
            'data_nascimento' => 'sometimes|date',
            'password' => 'sometimes|string|min:6|confirmed',
        ]);

        $user->update([
            'name' => $validated['name'] ?? $user->name,
            'data_nascimento' => $validated['data_nascimento'] ?? $user->data_nascimento,
            'password' => isset($validated['password']) ? bcrypt($validated['password']) : $user->password,
        ]);
    
        return response()->json([
            'message' => 'dados atualzados!',
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'usuario excluido!']);
    }
}
