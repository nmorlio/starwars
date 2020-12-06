<?php

try {
    require '../../config/config.php';
    $mensaje = null;
    $datos = array();

    $pdo = new PDO('sqlite:' . $CONFIG['db']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_POST === array()) {
        $id = $_GET['n'] ?? '';

        $sql = ""
            . "SELECT "
            . "    id, "
            . "    name "
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
    } else {
        $afectadas = 0;

        $id = $_POST['id'] ?? '';

        $sql = ""
            . "DELETE "
            . "FROM "
            . "    naves "
            . "WHERE "
            . "    id = :id ";

        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        $afectadas = $sentencia->rowCount();
        if ($afectadas === 0) {
            throw new Exception();
        }

        $sentencia = null;
        $pdo = null;

        header('Location: naves.php', true, 302);
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
    <title><?php echo 'Eliminar Nave ', $datos[0]['id'] ?? '', ' - Proyecto Star Wars'; ?></title>
</head>

<body class="bg-dark">

    <div class="p-3 mb-2 bg-warning text-dark"><?php echo 'Eliminar Nave ', $datos[0]['id'] ?? ''; ?></div>

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
                    <p class="text-monospace text-light"><?php echo 'Name: ', $datos[0]['name'] ?? ''; ?><p>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <form action="eliminar.php?n=<?php echo $datos[0]['id'] ?? ''; ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES); ?>">
                        <input class="btn btn-outline-warning btn-lg p-3 m-3 w-75" type="submit" value="Eliminar" onclick="return confirm('<?php echo '¿Confirma la eliminación del registro?'; ?>')">
                    </form>
                </div>
            </div>
        </div>
    </div>






</body>

</html>