<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/estados/{siglaEstado}', [EstadoController::class, 'getIdEstadoPorSigla']);
Route::controller(CidadeController::class)->group(function () { 
    Route::get('/cidades/{idEstado}', 'getCidadesPorIdEstado');
    Route::get('/cidade/{nomeCidade}/{siglaEstado}', 'getIdCidadePorNomeESiglaEstado');

});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get('/perfil', 'edit')->name('edit');
        Route::patch('/perfil', 'update')->name('update');
        Route::delete('/perfil', 'destroy')->name('destroy');
    });
    Route::middleware('modulo:2')->group(function () {
        Route::controller(LeadController::class)->name('leads.')->group(function () {
            Route::get('/leads/novos', 'index')->name('index');
            Route::get('/leads/cadastrar', 'create')->name('create');
            Route::get('/leads/ver/{id}', 'show')->name('show');
            Route::post('/leads', 'store')->name('store');
        });
    });
});
require __DIR__ . '/auth.php';
