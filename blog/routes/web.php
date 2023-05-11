<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Models\Archivo;

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

//Armamos una ruta para probar el guardado en caché de la info.
Route::get('/federico/cache/{prueba}', function($prueba){
    $path = __DIR__ . "/../resources/archivos/{$prueba}.html";

    if (! file_exists($path)) {
        return redirect('/');
    }
    //utilizo el objeto cache() y le pido que remember('nombrearchivo que quiero poner', tiempo en segundos que quiero recordar, funcion que quiero que ejecute una vez esta recordado)
    $archivo = cache()->remember('cache.{$prueba}', 10, function () use ($path) {//uno el metodo use('nombre variable') para dar acceso a una variable de otro ámbito.
        //var_dump('file_get_contents');//Verifico si funciona imprimiendo la variable que general el metodo fil_get_contents
        return file_get_contents($path);
        //fn($path) => file_get_contents($path); Así sería la funcion flecha que reemplace toda la funcion que le pasamos al rememrber.

    });

    return view('federico', array(//aca ya mostramos con view el archivo blade con el array con las variables que vamos a pasar por post a ese archivo que en este caso es la variable $archivo que nos trae el cache
        'tabla' => $archivo, // podria simplificar el array con ['tabla':$archivo]
));
})->where('prueba', '[A-z_\-]+');

Route::get('/federico/cacheymodelo/{clase}', function($clase) {
        $archivo = Archivo::hallar($clase);//Uso una clase modelo para realizar la busqueda de archivo a arriba hago manualmente
        return view('federico', ['tabla' => $archivo,]);
});