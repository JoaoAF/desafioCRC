<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Desafiocrc;
use App\Http\Controllers\UserController;

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
    $record = Desafiocrc::paginate();
    
    $OwmAPI = new App\Http\Controllers\UserController(API_KEY);

    return view('welcome', ['record' => $record, 'OwmAPI' => $OwmAPI]);
});

Route::post('/create', function (Request $data) {
    
    $cpf = strlen($data->cpf_cnpj) <= 11 ? $data->cpf_cnpj : "";
    $cnpj = strlen($data->cpf_cnpj) >= 14 ? $data->cpf_cnpj : "";
    
    Desafiocrc::create([
        'data' => $data->data, 
        'nome' => $data->nome, 
        'email' => $data->email, 
        'cpf' => $cpf,
        'cnpj' => $cnpj,
        'telefone' => $data->telefone, 
        'texto' => $data->texto
    ]);

    return redirect('/?c=1');
});

Route::get('/search/{id}', function($id){

    $record = Desafiocrc::find($id);

    echo "<p>$record->data</p>"; 
    echo "<p>$record->nome</p>"; 
    echo "<p>$record->email</p>"; 
    echo "<p>$record->cpf</p>"; 
    echo "<p>$record->cnpj</p>"; 
    echo "<p>$record->telefone</p>"; 
    echo "<p>$record->texto</p>"; 
});

Route::get('/form_update/{id}', function($id){

    $record = Desafiocrc::find($id);

    return view('update', ['record' => $record]);
 
});

Route::put('/update/{id}', function(Request $data, $id){
    
    $record = Desafiocrc::find($id);
    
    $cpf = strlen($data->cpf_cnpj) <= 11 ? $data->cpf_cnpj : "";
    $cnpj = strlen($data->cpf_cnpj) >= 12 ? $data->cpf_cnpj : "";

    $record->data = $data->data;
    $record->nome = $data->nome;
    $record->email = $data->email;
    $record->cpf = $cpf;
    $record->cnpj = $cnpj;
    $record->telefone = $data->telefone;
    $record->texto = $data->texto;
    $record->save();

    return redirect('/?u=1');
});

Route::get('/delete/{id}', function($id){

    $record = Desafiocrc::find($id);
    $record->delete();
    return redirect('/?d=1');
 
});