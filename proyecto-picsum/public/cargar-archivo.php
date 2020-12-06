<?php

try {
    require '../config/config.php'; //carga  la config
    $mensaje = null;

    $json = @file_get_contents($CONFIG['url']); //tomamos de una url, el contenido y lo pasa a una variable como cadena
    if (!$json) {
        throw new Exception(); //si hay algun problema lanza una excepcion
    }
    $datos = json_decode($json, true); //pasamos la cadena a formato json

    $archivo = $CONFIG['csv']; //pasamos la ruta del archivo
    @unlink($archivo);  //eliminamos archivo si ya existe, para prevenir que siempre este vacio
    $fo = @fopen($archivo, 'a'); //conexion al archivo
    if (!$fo) { //valida si fue exitosa la apertura
        throw new Exception();
    }

    foreach ($datos as $imagen) { //cada linea del arreglo de datos lo agregamos con el fputs
        fputcsv($fo, $imagen, ';', '"');
    }

    fclose($fo); //cerramos el archivo, tenemos el archivo csv cargado

    $mensaje = 'La acción se realizó con éxito.';
} catch (PDOException $e) {
    $mensaje = 'Error al realizar la acción.';
} catch (Exception $e) {
    $mensaje = 'Error al realizar la acción.';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Archivo - Proyecto Picsum</title>
</head>

<body class="bg-primary">

    <div class="p-3 mb-2 bg-light text-dark m-5">
        <h1>Cargar Archivo</h1>
    </div>
    
        <div class="col-sm-6 m-5">
            <a href="index.php" class="btn btn-light m-5">Inicio</a>


            <?php if (isset($mensaje)) { ?>
                <p class="font-italic" id="mensaje"><?php echo $mensaje; ?></p>
            <?php } ?>

            <p class="font-weight-light"><?php echo 'URL origen: ' . $CONFIG['url']; ?></p>
            <p class="font-weight-light"><?php echo 'Archivo destino: ' . $CONFIG['csv']; ?></p>
        </div>
    
</body>

</html>