<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensagem;
use Illuminate\Support\Facades\Auth;

class MensagemController extends Controller
{
    public function store(Request $request)
    {
        try {
        $request->validate([
            'chamado_id' => 'required|exists:chamados,id',
            'content' => 'required|string',
        ]);

        Mensagem::create([
            'chamado_id' => $request->chamado_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Mensagem enviada com sucesso!');
    } catch (\Exception $e) {
        return back()->withErrors('Ocorreu um erro ao enviar a mensagem: ' . $e->getMessage());
    }
}
}