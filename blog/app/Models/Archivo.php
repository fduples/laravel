<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Archivo
{   
    public static function todos(){
        $archivos = File::files(resource_path("archivos/")); //Utilizo una clase que esta en FACADES que tiene muchos metodos sobre archivos.
        return array_map(function ($archivo) { //Utilizo el método array_map (es como el de js que recibe una callback y el array que quiero recorrer)
            return $archivo->getContents();//en func flecha sería: fn($archivo) => $archivo->getContents()
        }, $archivos);
    }
    public static function hallar($referencia) { 
        $path = resource_path("archivos/{$referencia}.html"); 

        if (! file_exists($path)) {
            //ddd($path);
            //return redirect('/'); //No es funcion del modelo redirigir a otra pagina esa es funcion del controlado (el router en este caso)
            throw new ModelNotFoundException();
        }

        $archivo = cache()->remember("cache.{$referencia}", 30, fn () => file_get_contents($path));

        return $archivo;
    }

}





?>