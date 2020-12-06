<?php

try {
    require '../config/config.php';
    $mensaje = null;

    $pdo = new PDO('sqlite:' . $CONFIG['db']); //crea una conexion a una base de datos; utilizo PDO para acceder a los datos
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "" //por cuestiones de simpleza he decidido que todos los parametros sean de tipo TEXT
        . "CREATE TABLE naves (" //crear tabla con los siguientes parametros, he agregado ID
        . "    id INTEGER PRIMARY KEY, "
        . "    name TEXT, "
        . "    model TEXT, "
        . "    manufacturer TEXT, "
        . "    cost_in_credits TEXT, "
        . "    length TEXT, "
        . "    max_atmosphering_speed TEXT, "
        . "    crew TEXT, "
        . "    passengers TEXT, "
        . "    cargo_capacity TEXT, "
        . "    consumables TEXT, "
        . "    hyperdrive_rating TEXT, "
        . "    MGLT TEXT, "
        . "    starship_class TEXT, "
        . "    created TEXT, "
        . "    edited TEXT, "
        . "    url TEXT "
        . ")";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $sentencia = null;

    $sql = ""
        . "INSERT INTO naves ( " //insertar datos en tablas
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
        . ") "
        . "VALUES ( "
        . "    null, " //ID sera incremental y se agrega automaticamente, se pasa como dato nulo
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
        . "    :edited, "
        . "    :url "
        . ") ";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(':name', $name, PDO::PARAM_STR); //vinculamos una variable a un parametro, metodo para enlazar valores
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
    $sentencia->bindParam(':edited', $edited, PDO::PARAM_STR);
    $sentencia->bindParam(':url', $url, PDO::PARAM_STR);

    $archivo = $CONFIG['csv']; //guardamos el fichero en varible $archivo
    $fo = @fopen($archivo, 'r'); //lo abrimos y pasamos parametro para que sea leido Read
    if (!$fo) {
        throw new Exception();
    }

    $campos = fgetcsv($fo, 0, ';'); //analiza los campos del ficher CSV -> $campos
    while (($nave = fgetcsv($fo, 0, ';')) !== false) { //guardamos en cada $variable los valores de $nave
        $name = $nave[0];
        $model = $nave[1];
        $manufacturer = $nave[2];
        $cost_in_credits = $nave[3];
        $length = $nave[4];
        $max_atmosphering_speed = $nave[5];
        $crew = $nave[6];
        $passengers = $nave[7];
        $cargo_capacity = $nave[8];
        $consumables = $nave[9];
        $hyperdrive_rating = $nave[10];
        $MGLT = $nave[11];
        $starship_class = $nave[11];
        $created = $nave[13];
        $edited = $nave[14];
        $url = $nave[15];
        $sentencia->execute(); //ejecutamos
    }

    fclose($fo);
    $sentencia = null;
    $pdo = null;

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
    <title>Crear Base de Datos - Proyecto Star Wars</title>
</head>

<body class="bg-dark">
    <div class="p-3 mb-2 bg-warning text-dark">creando la base de datos</div>
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