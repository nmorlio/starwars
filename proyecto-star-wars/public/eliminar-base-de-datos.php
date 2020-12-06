<?php

try {
    require '../config/config.php';
    $mensaje = null;

    $ulk = @unlink($CONFIG['db']); //borra fichero que creamos de la base de datos
    if (!$ulk) {  // si no existe, genera excepcion y luego envia mensaje
        throw new Exception();
    }
    
    $mensaje = 'La acción se realizó con éxito.';
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
    <title>Eliminar Base de Datos - Proyecto Star Wars</title>
</head>
<body class="bg-dark">
    <div class="p-3 mb-2 bg-warning text-dark">eliminando la base de datos</div>
    <div class="row justify-content-center">
        <div class="btn-group-vertical" role="group" aria-label="Basic example">
            <div class="col">
                <div class="row">
                    <span class="d-block p-2 bg-dark text-white">
                        <?php if (isset($mensaje)) { ?>
                            <p id="mensaje"><?php echo $mensaje; ?></p>
                        <?php } ?>
                    </span>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <a href="index.php" type="button" class="btn btn-outline-warning btn-lg p-3 m-3 w-75">Inicio</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>