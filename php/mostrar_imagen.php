<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Imagen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .imagen-container {
            text-align: center;
            max-width: 40%;
            /* Establece el ancho máximo del contenedor de la imagen */
            margin: 0 auto;
            /* Centra el contenedor horizontalmente */
        }

        .imagen-container img {
            width: 100%;
            /* La imagen ocupa el 100% del ancho del contenedor */
            height: auto;
            display: block;
            /* Elimina el espacio adicional debajo de la imagen */
            margin: 0 auto;
            /* Centra la imagen horizontalmente */
        }

        .btn-container {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php
        if (isset($_GET['imagen'])) {
            $imagen = $_GET['imagen'];
            echo "<div class='imagen-container'><img src='images/{$imagen}' alt='Imagen' class='img-fluid'></div>";
        } else {
            echo "<p>No se proporcionó una imagen.</p>";
        }
        ?>

    </div> <br>
    <div class="btn-container">
        <a href="nueva_noticia.php" class="btn btn-primary">Volver al CRUD</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>