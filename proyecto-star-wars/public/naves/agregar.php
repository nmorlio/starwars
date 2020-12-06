<?php

try {
    require '../../config/config.php';
    $mensaje = null;

    if ($_POST === array()) {
        $name = '';
        $model = '';
        $manufacturer = '';
        $cost_in_credits = '';
        $length = '';;
        $max_atmosphering_speed = '';
        $crew = '';
        $passengers = '';
        $cargo_capacity = '';
        $consumables = '';
        $hyperdrive_rating = '';
        $MGLT = '';
        $starship_class = '';
        $url = '';
    } else {
        $afectadas = 0;
        $ultimoId = 0;

        $name = $_POST['name'] ?? '';
        $model = $_POST['model'] ?? '';
        $manufacturer = $_POST['manufacturer'] ?? '';
        $cost_in_credits = $_POST['cost_in_credits'] ?? '';
        $length = $_POST['length'] ?? '';;
        $max_atmosphering_speed = $_POST['max_atmosphering_speed'] ?? '';
        $crew = $_POST['crew'] ?? '';
        $passengers = $_POST['passengers'] ?? '';
        $cargo_capacity = $_POST['cargo_capacity'] ?? '';
        $consumables = $_POST['consumables'] ?? '';
        $hyperdrive_rating = $_POST['hyperdrive_rating'] ?? '';
        $MGLT = $_POST['MGLT'] ?? '';
        $starship_class = $_POST['starship_class'] ?? '';
        $dt = new DateTime();
        $created = $dt->format('Y-m-d\TH:i:s.u\Z');
        $url = $_POST['url'] ?? '';

        $pdo = new PDO('sqlite:' . $CONFIG['db']); //conexion con la base de datos
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = ""
            . "INSERT INTO naves ( "
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
            . "    url "
            . ") "
            . "VALUES ( "
            . "    null, "
            . "    :name, "
            . "    :model, "
            . "    :manufacturer, "
            . "    :cost_in_credits, "
            . "    :length, "
            . "    :max_atmosphering_speed, "
            . "    :crew, "
            . "    :passengers, "
            . "    :cargo_capacity, "
            . "    :consumables, "
            . "    :hyperdrive_rating, "
            . "    :MGLT, "
            . "    :starship_class, "
            . "    :created, "
            . "    :url "
            . ") ";

        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam(':name', $name, PDO::PARAM_STR);
        $sentencia->bindParam(':model', $model, PDO::PARAM_STR);
        $sentencia->bindParam(':manufacturer', $manufacturer, PDO::PARAM_STR);
        $sentencia->bindParam(':cost_in_credits', $cost_in_credits, PDO::PARAM_STR);
        $sentencia->bindParam(':length', $length, PDO::PARAM_STR);
        $sentencia->bindParam(':max_atmosphering_speed', $max_atmosphering_speed, PDO::PARAM_STR);
        $sentencia->bindParam(':crew', $crew, PDO::PARAM_STR);
        $sentencia->bindParam(':passengers', $passengers, PDO::PARAM_STR);
        $sentencia->bindParam(':cargo_capacity', $cargo_capacity, PDO::PARAM_STR);
        $sentencia->bindParam(':consumables', $consumables, PDO::PARAM_STR);
        $sentencia->bindParam(':hyperdrive_rating', $hyperdrive_rating, PDO::PARAM_STR);
        $sentencia->bindParam(':MGLT', $MGLT, PDO::PARAM_STR);
        $sentencia->bindParam(':starship_class', $starship_class, PDO::PARAM_STR);
        $sentencia->bindParam(':created', $created, PDO::PARAM_STR);
        $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
        $sentencia->execute();
        $afectadas = $sentencia->rowCount();
        $ultimoId = $pdo->lastInsertId();
        if ($afectadas === 0) {
            throw new Exception();
        }

        $sentencia = null;
        $pdo = null;

        header('Location: ver.php?n=' . $ultimoId, true, 302);
        exit;
    }
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
    <title>Agregar Nave - Proyecto Star Wars</title>
</head>

<body class="bg-dark">

    <div class="p-3 mb-2 bg-warning text-dark">Agregar nueva nave</div>

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
            <div class="col">
                <div class="row">
                    <form action="agregar.php" method="post">

                        <p><label for="name">Name: <input type="text" id="name" name="name" value="<?php echo $name; ?>"></label></p>
                        <p><label for="model">Model: <input type="text" id="model" name=" model" value="<?php echo $model; ?>"></label></p>
                        <p><label for="manufacturer">Manufacturer: <input type="text" id="manufacturer" name="manufacturer" value="<?php echo $manufacturer; ?>"></label></p>
                        <p><label for="cost_in_credits">Cost in credits: <input type="text" id="cost_in_credits" name="cost_in_credits" value="<?php echo $cost_in_credits; ?>"></label></p>
                        <p><label for="length">Length: <input type="text" id="length" name="length" value="<?php echo $length; ?>"></label></p>
                        <p><label for="max_atmosphering_speed">Max atmosphering speed: <input type="text" id="max_atmosphering_speed" name="max_atmosphering_speed" value="<?php echo $max_atmosphering_speed; ?>"></label></p>
                        <p><label for="crew">Crew: <input type="text" id="crew" name="crew" value="<?php echo $crew; ?>"></label></p>
                        <p><label for="passengers">Passengers: <input type="text" id="passengers" name="passengers" value="<?php echo $passengers; ?>"></label></p>
                        <p><label for="cargo_capacity">Cargo capacity: <input type="text" id="cargo_capacity" name="cargo_capacity" value="<?php echo $cargo_capacity; ?>"></label></p>
                        <p><label for="consumables">Consumables: <input type="text" id="consumables" name="consumables" value="<?php echo $consumables; ?>"></label></p>
                        <p><label for="hyperdrive_rating">Hyperdrive rating: <input type="text" id="hyperdrive_rating" name="hyperdrive_rating" value="<?php echo $hyperdrive_rating; ?>"></label></p>
                        <p><label for="MGLT">MGLT: <input type="text" id="MGLT" name="MGLT" value="<?php echo $MGLT; ?>"></label></p>
                        <p><label for="starship_class">Starship class: <input type="text" id="starship_class" name="starship_class" value="<?php echo $starship_class; ?>"></label></p>
                        <p><label for="url">URL: <input type="text" id="url" name="url" value="<?php echo $url; ?>"></label></p>
                        
                        <input class="btn btn-outline-warning btn-lg p-3 m-3 w-75" type="submit" value="Guardar">

                    </form>

                </div>
            </div>

        </div>
    </div>





</body>

</html>