<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use Illuminate\Http\Request;

class ArtigoController extends Controller
{
    public function index()
    {
        $artigos = Artigo::all();
        return view('artigos.index', compact('artigos'));
    }

    public function create()
    {
        return view('artigos.create');
    }

    public function store(Request $request)
    {
        try {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:255',
        ]);

        $artigo = new Artigo();
        $artigo->title = $request->input('title');
        $artigo->content = $request->input('content');
        $artigo->category = $request->input('category');
        $artigo->tags = $request->input('tags');
        $artigo->user_id = auth()->id();
        $artigo->save();

        return redirect()->route('artigos.index')->with('success', 'Artigo criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro ao criar o artigo: ' . $e->getMessage());    
        }
    }

    public function destroy($id)
    {
        try {
        $artigo = Artigo::findOrFail($id);
        $artigo->delete();

        return redirect()->route('artigos.index')->with('success', 'Artigo deletado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro ao deletar o artigo: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $artigo = Artigo::findOrFail($id);
        return view('artigos.edit', compact('artigo'));
    }
    
    public function update(Request $request, $id)
    {
        try {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:255',
        ]);

        $artigo = Artigo::findOrFail($id);
        $artigo->title = $request->input('title');
        $artigo->content = $request->input('content');
        $artigo->category = $request->input('category');
        $artigo->tags = $request->input('tags');
        $artigo->save();

        return redirect()->route('artigos.index')->with('success', 'Artigo atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro ao atualizar o artigo: ' . $e->getMessage());
        }
    }

}
