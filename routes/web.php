<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CultivoController;
use App\Http\Controllers\ConsumoAguaController;
use App\Http\Controllers\RecomendacaoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [MainController::class, 'index']);
Route::post('/execute', [MainController::class, 'executePrompt']);
Route::get('/cultivos', [CultivoController::class, 'index'])->name('cultivos.index'); // Página inicial
Route::post('/cultivos', [CultivoController::class, 'store'])->name('cultivos.store'); // Salvar cultivo
Route::get('/consumo', [ConsumoAguaController::class, 'index'])->name('consumo.index'); // Página inicial
Route::post('/consumo', [ConsumoAguaController::class, 'store'])->name('consumo.store'); // Salvar consumo
Route::get('/recomendacoes/{cultivo}', [RecomendacaoController::class, 'show'])->name('recomendacoes.show');