<?php

namespace App\Http\Controllers;

use App\Enum\Priority;
use App\Enum\Status;
use App\Models\Chamado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index()
    {
        $chamados = Chamado::with('user')->where('status', '!=', Status::fechado)->get();
        return view('chamados.index', compact('chamados'));
    }

    public function showAllClosed()
    {
        $chamados = Chamado::with('user')->where('status', '=', Status::fechado)->get();
        return view('chamados.index', compact('chamados'));
    }
    
    public function create()
    {
        return view('chamados.create');
    }

    public function store(Request $request)
    {
        
        $chamado = new Chamado();
        $chamado->title = $request->input('title');
        $chamado->description = $request->input('description');
        $chamado->status = Status::aberto;
        $chamado->priority = Priority::fromString($request->input('priority'));
        $chamado->user_id = auth()->id();
        $chamado->opening = Carbon::now();
        $chamado->save();
        return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $chamado = Chamado::findOrFail($id);
        return view('chamados.edit', compact('chamado'));
    }

    public function update(Request $request, $id)
    {
        $chamado = Chamado::findOrFail($id);
        $chamado->title = $request->input('title');
        $chamado->description = $request->input('description');
        $chamado->status = Status::aberto;
        $chamado->priority = Priority::fromString($request->input('priority'));
        $chamado->save();
        return redirect()->route('chamados.index')->with('success', 'Chamado atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $chamado = Chamado::findOrFail($id);
        $chamado->delete();
        return redirect()->route('chamados.index')->with('success', 'Chamado excluído com sucesso!');
    }
    public function close($id)
    {
        try {
            $chamado = Chamado::findOrFail($id);

            if ($chamado->user_id !== auth()->id()) {
                return redirect()->route('chamados.index')
                    ->with('error', 'Você só pode fechar um chamado que você abriu.');
            }

            $chamado->status = Status::fechado;
            $chamado->closing = Carbon::now();
            $chamado->save();

        } catch (\Exception $e) {
            return redirect()->route('chamados.index')
                ->with('error', 'Ocorreu um erro ao tentar fechar o chamado.');
        }

        return redirect()->route('chamados.index')
            ->with('success', 'Chamado fechado com sucesso!');
    }
}
