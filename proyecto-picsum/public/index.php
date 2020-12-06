<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Picsum</title>
</head>

<body class="bg-primary">

    <div class="p-3 mb-2 bg-light text-dark m-5">
        <h1>Proyecto Picsum</h1>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card m-5">
                <div class="card-body">
                    <h5 class="card-title">Paso 1</h5>
                    <p class="card-text"> Descargar un listado con la información de las primeras 75 imágenes, 
                        y convertirlo a un fichero CSV delimitado por ";".</p>
                    <a href="cargar-archivo.php" class="btn btn-primary">cargar fichero</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card m-5">
                <div class="card-body">
                    <h5 class="card-title">Paso 2</h5>
                    <p class="card-text">Mostrar la informacion del fichero descargado, tanto las imagenes y 
                        sus propiedades como autor, medidades, etc...</p>
                    <a href="leer-archivo.php" class="btn btn-primary">leer fichero</a>
                </div>
            </div>
        </div>
    </div>
    

</body>

</html>