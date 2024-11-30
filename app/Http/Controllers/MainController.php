<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class MainController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function index()
    {
        return view('index');
    }

    public function executePrompt(Request $request)
    {
        $prompt = $request->input('prompt');
        $response = $this->openAIService->chat($prompt);

        return response()->json([
            'result' => $response['choices'][0]['message']['content'] ?? 'Erro ao processar a solicitação.',
        ]);
    }
}
