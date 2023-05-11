<?php 
namespace App\Models;

class Archivo
{   
    public static function hallar($referencia) { 
        $path = resource_path("archivos/{$referencia}.html"); 
        if (! file_exists($path)) {
            ddd($path);
            return redirect('/');
        }

        $archivo = cache()->remember('cache.{$referencia}', 30, fn($path) => file_get_contents($path));

        return $archivo;
    }

}





?>