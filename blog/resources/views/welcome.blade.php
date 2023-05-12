<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Estilos -->
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body class="">
        <?php foreach ($tablas as $tabla) : 
            //ddd($tablas);
            ?>
            <article>
                <?php echo $tabla; ?>
            </article>
           
       <?php endforeach ?>
        
        
    </body>
</html>
