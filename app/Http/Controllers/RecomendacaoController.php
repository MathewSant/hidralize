<?php

namespace App\Http\Controllers;

use App\Models\Cultivo;
use App\Models\ConsumoAgua;
use Illuminate\Http\Request;
use App\Services\OpenAIService;

class RecomendacaoController extends Controller
{
    protected $openAI;

    public function __construct(OpenAIService $openAI)
    {
        $this->openAI = $openAI;
    }

    public function show(Cultivo $cultivo)
    {
        // Recupera o consumo mais recente do cultivo
        $ultimoConsumo = ConsumoAgua::where('cultivo_id', $cultivo->id)
            ->latest('data')
            ->first();

        // Dados para o GPT
        $dados = [
            'cultura' => $cultivo->nome_cultura,
            'area' => $cultivo->area_cultivo,
            'estagio' => $ultimoConsumo->estagio_cultura ?? 'Desconhecido',
            'temperatura' => $ultimoConsumo->temperatura ?? 'Desconhecida',
            'precipitacao' => $ultimoConsumo->precipitacao ?? 'Desconhecida',
        ];

        // Prompt para o GPT
        $prompt = "Baseado nos seguintes dados:
        Cultura: {$dados['cultura']}
        Área: {$dados['area']} hectares
        Estágio de crescimento: {$dados['estagio']}
        Temperatura média: {$dados['temperatura']} °C
        Precipitação: {$dados['precipitacao']} mm
        Quais são as melhores práticas de irrigação para esta cultura, incluindo horários recomendados e técnicas de otimização do uso da água?";

        // Chama o OpenAI
        $resposta = $this->openAI->chat($prompt);

        return view('recomendacoes.show', [
            'cultivo' => $cultivo,
            'recomendacoes' => $resposta['choices'][0]['message']['content'] ?? 'Não foi possível gerar recomendações.',
        ]);
    }
}
