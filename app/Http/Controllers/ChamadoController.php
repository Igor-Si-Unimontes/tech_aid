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
        $chamados = Chamado::with('user', 'responsavel')->where('status', '!=', Status::fechado)->get();
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
        try {

            $request->validate(
                [
                    'title' => 'required|string|max:50',
                    'description' => 'required|string',
                    'priority' => 'required',
                ],
                [
                    'title.required' => 'O campo Título é obrigatório.',
                    'title.max' => 'O campo Título deve ter no máximo 5 caracteres.',
                    'description.required' => 'O campo Descrição é obrigatório.',
                    'priority.required' => 'O campo Prioridade é obrigatório.',
                ]
            );
            $chamado = new Chamado();
            $chamado->title = $request->input('title');
            $chamado->description = $request->input('description');
            $chamado->status = Status::aberto;
            $chamado->priority = Priority::fromString($request->input('priority'));
            $chamado->user_id = auth()->id();
            $chamado->opening = Carbon::now();
            $chamado->save();
            return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro ao criar o chamado: ' . $e->getMessage());
        }
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
        try {
            $request->validate([
                'title' => 'required|string|max:50',
                'description' => 'required|string',
                'priority' => 'required',
            ], [
                'title.required' => 'O campo Título é obrigatório.',
                'title.max' => 'O campo Título deve ter no máximo 50 caracteres.',
                'description.required' => 'O campo Descrição é obrigatório.',
                'priority.required' => 'O campo Prioridade é obrigatório.',
            ]);
            $chamado = Chamado::findOrFail($id);
            $chamado->title = $request->input('title');
            $chamado->description = $request->input('description');
            $chamado->status = Status::aberto;
            $chamado->priority = Priority::fromString($request->input('priority'));
            $chamado->save();
            return redirect()->route('chamados.index')->with('success', 'Chamado atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro ao atualizar o chamado: ' . $e->getMessage());
        }
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
    public function open($id)
    {
        try {
            $chamado = Chamado::findOrFail($id);

            $chamado->status = Status::andamento;
            $chamado->in_progress = Carbon::now();
            $chamado->responsavel_id = auth()->id();
            $chamado->save();
        } catch (\Exception $e) {
            return redirect()->route('chamados.index')
                ->with('error', 'Ocorreu um erro ao tentar reabrir o chamado.');
        }

        return redirect()->route('chamados.index')
            ->with('success', 'Chamado aberto com sucesso!');
    }

    public function mensagens($id)
    {
        $chamado = Chamado::findOrFail($id);    
        $mensagens = $chamado->mensagens; 
        try{
            if($chamado->user_id !== auth()->id() && $chamado->responsavel_id !== auth()->id()){
                return redirect()->route('chamados.index')
                ->with('error', 'Você só pode acessar as mensagens de chamados que você abriu ou está responsável.');
            }
            return view('chamados.mensagens', compact('chamado', 'mensagens'));
        }catch(\Exception $e){
            return redirect()->route('chamados.index')
            ->with('error', 'Ocorreu um erro ao tentar acessar as mensagens do chamado.');
        }
    }
}
