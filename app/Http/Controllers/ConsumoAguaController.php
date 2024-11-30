<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsumoAgua;
use App\Models\Cultivo;

class ConsumoAguaController extends Controller
{
    // Exibe a página de monitoramento
    public function index()
    {
        $cultivos = Cultivo::all();
        // dd($cultivos);
        $consumos = ConsumoAgua::with('cultivo')->get();
        return view('consumo.index', compact('cultivos', 'consumos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cultivo_id' => 'required|exists:cultivos,id',
            'data' => 'required|date',
            'volume_utilizado' => 'required|numeric|min:0',
            'estagio_cultura' => 'required|string',
            'temperatura' => 'nullable|numeric',
            'precipitacao' => 'nullable|numeric',
        ]);
    
        $consumo = ConsumoAgua::create($validatedData);
    
        // Benchmark de consumo ideal (exemplo simplificado)
        $recomendado = [
            'Germinação' => 20, // Litros por hectare por dia
            'Crescimento Vegetativo' => 30,
            'Floração' => 40,
            'Frutificação' => 50,
        ];
    
        $cultivo = $consumo->cultivo;
        $ideal = $recomendado[$validatedData['estagio_cultura']] ?? null;
    
        $resultado = '';
        if ($ideal) {
            if ($validatedData['volume_utilizado'] < $ideal) {
                $resultado = 'Consumo abaixo do recomendado.';
            } elseif ($validatedData['volume_utilizado'] > $ideal) {
                $resultado = 'Consumo acima do recomendado.';
            } else {
                $resultado = 'Consumo dentro do recomendado.';
            }
        }
    
        return redirect()->route('consumo.index')
                         ->with('success', 'Consumo registrado com sucesso! ' . $resultado);
    }
    
}
