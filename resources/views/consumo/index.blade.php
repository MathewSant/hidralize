<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento de Consumo de Água</title>
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
            max-width: 900px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background-color: #56b13d;
            color: white;
        }

        table th, table td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            color: #999;
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Monitoramento de Consumo de Água</h1>
    </header>

    <div class="container">
        <!-- Exibe mensagem de sucesso -->
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulário para registrar consumo -->
        <form action="{{ route('consumo.store') }}" method="POST">
            @csrf

            <label for="cultivo_id">Cultivo:</label>
            <select id="cultivo_id" name="cultivo_id" required>
                <option value="" disabled selected>Selecione um cultivo</option>
                @foreach ($cultivos as $cultivo)
                    <option value="{{ $cultivo->id }}">{{ $cultivo->nome_cultura }}</option>
                @endforeach
            </select>

            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>

            <label for="volume_utilizado">Volume Utilizado (litros):</label>
            <input type="number" id="volume_utilizado" name="volume_utilizado" step="0.01" required placeholder="Ex.: 1200.50">

            <label for="estagio_cultura">Estágio da Cultura:</label>
            <select id="estagio_cultura" name="estagio_cultura" required>
                <option value="" disabled selected>Selecione um estágio</option>
                <option value="Germinação">Germinação</option>
                <option value="Crescimento Vegetativo">Crescimento Vegetativo</option>
                <option value="Floração">Floração</option>
                <option value="Frutificação">Frutificação</option>
            </select>

            <label for="temperatura">Temperatura Média (°C):</label>
            <input type="number" id="temperatura" name="temperatura" step="0.1" placeholder="Ex.: 25.5">

            <label for="precipitacao">Precipitação (mm):</label>
            <input type="number" id="precipitacao" name="precipitacao" step="0.1" placeholder="Ex.: 12.3">

            <button type="submit">Salvar</button>
        </form>

        <!-- Lista de consumos registrados -->
        <h2>Consumos Registrados</h2>
        @if ($consumos->isEmpty())
            <div class="no-data">Nenhum consumo registrado até o momento.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Cultivo</th>
                        <th>Data</th>
                        <th>Volume Utilizado (litros)</th>
                        <th>Estágio da Cultura</th>
                        <th>Temperatura Média (°C)</th>
                        <th>Precipitação (mm)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consumos as $consumo)
                        <tr>
                            <td>{{ $consumo->cultivo->nome_cultura }}</td>
                            <td>{{ $consumo->data }}</td>
                            <td>{{ $consumo->volume_utilizado }}</td>
                            <td>{{ $consumo->estagio_cultura }}</td>
                            <td>{{ $consumo->temperatura ?? 'N/A' }}</td>
                            <td>{{ $consumo->precipitacao ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
