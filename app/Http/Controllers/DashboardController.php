<?php
namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $chamadosAbertos = Chamado::where('status', 'aberto')->count();
        $chamadosEmAndamento = Chamado::where('status', 'andamento')->count();
        $chamadosFechados = Chamado::where('status', 'fechado')->count();
        $totalChamados = Chamado::count();
        $ultimosChamados = Chamado::latest()->take(3)->get();
        return view('dashboard', compact('chamadosAbertos', 'chamadosEmAndamento', 'chamadosFechados', 'totalChamados', 'ultimosChamados'));
    }
    
}