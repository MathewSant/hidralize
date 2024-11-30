<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recomendações para {{ $cultivo->nome_cultura }}</title>
    <style>
        /* Estilo geral */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        header {
            background-color: #56b13d;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        h1 {
            color: #56b13d;
            text-align: center;
            margin: 20px 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .recommendation-box {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            border-left: 5px solid #56b13d;
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .recommendation-box strong {
            color: #333;
        }

        .back-button {
            display: inline-block;
            text-decoration: none;
            color: white;
            background-color: #56b13d;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #4aa32f;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <h1>Recomendações Personalizadas</h1>
    </header>

    <div class="container">
        <h2>Para o cultivo de: <span style="color: #56b13d;">{{ $cultivo->nome_cultura }}</span></h2>

        <!-- Exibe as recomendações -->
        <div class="recommendation-box">
            <strong>Recomendações:</strong>
            <p>{{ $recomendacoes }}</p>
        </div>

        <a href="{{ route('consumo.index') }}" class="back-button">Voltar</a>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Sistema de Irrigação Inteligente</p>
    </footer>
</body>
</html>
