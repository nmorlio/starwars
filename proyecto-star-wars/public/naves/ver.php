<?php

try {
    require '../../config/config.php';
    $mensaje = null;
    $datos = array();
    $total = 0;

    $id = $_GET['n'] ?? '';

    $pdo = new PDO('sqlite:' . $CONFIG['db']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = ""
        . "SELECT "
        . "    id, "
        . "    name, "
        . "    model, "
        . "    manufacturer, "
        . "    cost_in_credits, "
        . "    length, "
        . "    max_atmosphering_speed, "
        . "    crew, "
        . "    passengers, "
        . "    cargo_capacity, "
        . "    consumables, "
        . "    hyperdrive_rating, "
        . "    MGLT, "
        . "    starship_class, "
        . "    created, "
        . "    edited, "
        . "    url "
        . "FROM "
        . "    naves "
        . "WHERE "
        . "    id = :id ";

    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
    $sentencia->execute();
    $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    if (count($datos) === 0) {
        throw new Exception();
    }

    $sentencia = null;
    $pdo = null;
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
    <title><?php echo 'Ver Nave ', $datos[0]['id'] ?? '', ' - Proyecto Star Wars'; ?></title>
</head>

<body class="bg-dark">

    <div class="p-3 mb-2 bg-warning text-dark"><?php echo 'Ver Nave ', $datos[0]['id'] ?? ''; ?></div>

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
                    <a href="naves.php" type="button" class="btn btn-outline-warning btn-lg p-3 m-3 w-75">Naves</a>
                </div>
            </div>

        </div>
    </div>

    <div class="m-5">

        <p class="text-monospace text-light"><?php echo 'Name: ', $datos[0]['name'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Model: ', $datos[0]['model'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Manufacturer: ', $datos[0]['manufacturer'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Cost in credits: ', $datos[0]['cost_in_credits'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Length: ', $datos[0]['length'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Max atmosphering speed: ', $datos[0]['max_atmosphering_speed'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Crew: ', $datos[0]['crew'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Passengers: ', $datos[0]['passengers'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Cargo capacity: ', $datos[0]['cargo_capacity'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Consumables: ', $datos[0]['consumables'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Hyperdrive rating: ', $datos[0]['hyperdrive_rating'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'MGLT: ', $datos[0]['MGLT'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Starship class: ', $datos[0]['starship_class'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Created: ', $datos[0]['created'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'Edited: ', $datos[0]['edited'] ?? ''; ?></p>
        <p class="text-monospace text-light"><?php echo 'URL: ', $datos[0]['url'] ?? ''; ?></p>

    </div>

</body>

</html>