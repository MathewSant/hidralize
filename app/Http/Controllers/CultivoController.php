<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cultivo;

class CultivoController extends Controller
{
    // Exibe a página inicial
    public function index()
    {
        $cultivos = Cultivo::all();
        return view('cultivos.index', compact('cultivos'));
    }

    // Salva um novo cultivo
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nome_cultura' => 'required|string|max:255',
            'area_cultivo' => 'required|numeric|min:0',
            'metodo_irrigacao' => 'required|string|max:255',
        ]);

        $cultivo = Cultivo::create($validatedData);

        return redirect()->route('cultivos.index')->with('success', 'Cultivo registrado com sucesso!');
    }
}
