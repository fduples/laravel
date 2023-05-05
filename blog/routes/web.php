<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/federico', function() {
    return view('federico');
});

Route::get('/federico', function() {

    return view('federico', array( //con este metodo de pasar una array como segundo argumento del metodo view, laravel pasa por post lo que contenga ese array.
        'primero' => '<h3>Ahora si gatos</h3>',
    ));
});

Route::get('/federico/{nivel}', function($nivel) {
    $path = __DIR__ . "/../resources/archivos/{$nivel}.html";

    if (! file_exists($path)) {
        //dd('no existe la ruta de salida'); //dd() es un metodo que termina el procesamiento y arroja el error que le pasamos como parametro.
        //ddd('error: no existe la ruta de salida'); ///ddd es un metodo igual que el anterior pero que ademas hace debug.
        
       return redirect('/'); //Redirect rediracciona.
    }

    $archivo = file_get_contents($path);
    return view('federico', array( //con este metodo de pasar una array como segundo argumento del metodo view, laravel pasa por post lo que contenga ese array.
        'tabla' => $archivo,
    ));
})->where('nivel', '[A-z_\-]+');//el método where lo que hace es establecer una condicion para la variable que nos llega por get. le primer parametro es la variable que nos llega y el segundo es lo que debe buscar en la variable para que se cumple la condicion. Lo que va adentro de los corchetes le dice al metodo que buscar: a-z o A-z o A-z(son ambas combinadas) o A-z_\- (agrega simbolos _ y -).
//tambien hay otros metodos que ya vienen preseteados y solo se le pasa el parametro del GET: whereAlpha(''), whereAlphaNumeric, etc...


