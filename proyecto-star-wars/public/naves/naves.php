<?php

try {
    require '../../config/config.php';
    $mensaje = null;
    $datos = array();
    $total = 0;

    $pdo = new PDO('sqlite:' . $CONFIG['db']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = ""
        . "SELECT "
        . "    id, "
        . "    name "
        . "FROM "
        . "    naves "
        . "ORDER BY "
        . "    id ASC "
    ;

    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC); 
    $total = count($datos);

    $sentencia = null;
    $pdo = null;

} catch (PDOException $e) {
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
     <title>Naves - Proyecto Star Wars</title>
</head>
<body class="bg-dark">

<div class="p-3 mb-2 bg-warning text-dark">Naves</div>

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
                    <a href="../index.php" type="button" class="btn btn-outline-warning btn-lg p-3 m-3 w-75">Inicio</a>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <a href="agregar.php" type="button" class="btn btn-outline-warning btn-lg p-3 m-3 w-75">Agregar</a>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <span class="d-block p-2 bg-dark text-white">
                        
                            <p id="mensaje">Resultados: <?php echo $total;?></p>
                        
                    </span>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        <?php foreach ($datos as $nave) { ?>
        <tr>
            <td><?php echo $nave['id'];?></td>
            <td><?php echo $nave['name'];?></td>
            <td><a href="<?php echo 'ver.php?n=', $nave['id'];?>">Ver</a></td>
            <td><a href="<?php echo 'eliminar.php?n=', $nave['id'];?>">Eliminar</a></td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>