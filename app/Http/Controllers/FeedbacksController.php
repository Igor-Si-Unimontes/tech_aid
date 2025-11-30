<?php

namespace App\Http\Controllers;

use App\Models\Feedbacks;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'comments' => 'required|string|max:1000',
                'rating' => 'required|integer|min:1|max:5',
            ]);

            $fedback = new Feedbacks();
            $fedback->comments = $request->input('comments');
            $fedback->rating = $request->input('rating');
            $fedback->chamado_id = $request->input('chamado_id');
            $fedback->user_id = auth()->id();
            $fedback->save();

            return redirect()->back()->with('success', 'Feedback enviado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro ao enviar o feedback: ' . $e->getMessage());
        }
    }

    public function getNota()
    {
        $peganota = Feedbacks::all();
        $peganota = $peganota->avg('rating');
        
    }
}