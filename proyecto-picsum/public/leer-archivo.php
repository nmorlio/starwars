<?php

//funcion adicional complementaria, no terminada

try {
    require '../config/config.php';
    $mensaje = null;
    $datos = array();

    $archivo = $CONFIG['csv'];
    $fo = @fopen($archivo, 'r');
    if (!$fo) {
        throw new Exception();
    }

    while (($imagen = fgetcsv($fo, 0, ';')) !== false) { //leer linea a linea, con separador ;
        $datos[] = $imagen; //todo el contenido de un archivo con el arreglo de datos
    }

    fclose($fo);

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
    <title>Leer Archivo - Proyecto Picsum</title>
</head>

<body class="bg-primary">
    <div class="p-3 mb-2 bg-light text-dark m-5">
        <h1>Leer Archivo</h1>
    </div>

    <div class="col-sm-6 m-5">
        <a href="index.php" class="btn btn-light m-5">Inicio</a>

        <?php if (isset($mensaje)) { ?>
            <p class="font-italic" id="mensaje"><?php echo $mensaje; ?></p>
        <?php } ?>

        <p class="font-weight-light"><?php echo 'Archivo: ' . $CONFIG['csv']; ?></p>

        <p class="font-weight-light">Resultados: <?php echo count($datos); ?></p>

        <?php
        foreach ($datos as $imagen) {
            echo implode(';', $imagen), '<br>';
        }
        ?>

</body>

</html>