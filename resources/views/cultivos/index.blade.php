
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cultivos</title>
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

        h1, h2 {
            color: #56b13d;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        form input, form select, form button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        form button {
            background-color: #56b13d;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #4aa32f;
        }

        .cultivos-list ul {
            list-style: none;
            padding: 0;
        }

        .cultivos-list li {
            padding: 10px;
            background-color: #f9f9f9;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .cultivos-list strong {
            color: #56b13d;
        }
    </style>
</head>
<body>
    <header>
        <h1>Cadastro de Cultivos</h1>
    </header>

    <div class="container">
        <!-- Exibe mensagem de sucesso -->
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulário para novo cultivo -->
        <form action="{{ route('cultivos.store') }}" method="POST">
            @csrf
            <label for="nome_cultura">Nome da Cultura:</label>
            <input type="text" id="nome_cultura" name="nome_cultura" required placeholder="Ex.: Milho, Soja, Trigo">

            <label for="area_cultivo">Área de Cultivo (hectares):</label>
            <input type="number" id="area_cultivo" name="area_cultivo" step="0.01" required placeholder="Ex.: 10.5">

            <label for="metodo_irrigacao">Método de Cultivo:</label>
            <select id="metodo_irrigacao" name="metodo_irrigacao" required>
                <option value="" disabled selected>Selecione um método</option>
                <option value="Plantio Direto">Plantio Direto</option>
                <option value="Rotação de Culturas">Rotação de Culturas</option>
                <option value="Curvas de Nível">Curvas de Nível</option>
                <option value="Afolhamento">Afolhamento</option>
                <option value="Cultivo Mínimo">Cultivo Mínimo</option>
                <option value="Sistema Convencional">Sistema Convencional</option>
                <option value="Hidroponia">Hidroponia</option>
                <option value="Cultivo em Faixas de Vento">Cultivo em Faixas de Vento</option>
                <option value="Integração Lavoura-Pecuária-Floresta">Integração Lavoura-Pecuária-Floresta (ILPF)</option>
                <option value="Agrofloresta">Agrofloresta</option>
            </select>

            <button type="submit">Salvar</button>
        </form>

        <!-- Lista de cultivos cadastrados -->
        <div class="cultivos-list">
            <h2>Cultivos Cadastrados</h2>
            <ul>
                @foreach ($cultivos as $cultivo)
                    <li>
                        <strong>{{ $cultivo->nome_cultura }}</strong> - 
                        {{ $cultivo->area_cultivo }} hectares - 
                        {{ $cultivo->metodo_irrigacao }}
                        
                        <!-- Botão para Adicionar Consumo -->
                        <a href="{{ route('consumo.index') }}" 
                           style="margin-left: 10px; background-color: #28a745; color: white; text-decoration: none; border: none; border-radius: 5px; padding: 5px 10px; cursor: pointer;">
                            Adicionar Consumo
                        </a>

                        <!-- Botão para Ver Recomendações -->
                        <a href="{{ route('recomendacoes.show', $cultivo->id) }}" 
                           style="margin-left: 10px; background-color: #007bff; color: white; text-decoration: none; border: none; border-radius: 5px; padding: 5px 10px; cursor: pointer;">
                            Ver Recomendações
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        
    </div>
</body>

</html>
