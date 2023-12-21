<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "admnoticias");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$id = $_POST['id'];
$fecha = $_POST['fecha'];
$resumen = $_POST['resumen'];
$codigo = $_POST['codigo'];
$titulo = $_POST['titulo'];
$visitas = $_POST['visitas'];
$autor = $_POST['autor'];
$cuerpo = $_POST['cuerpo'];

// Verificar si se ha subido una nueva imagen
if ($_FILES['imagen']['error'] === 0) {
    // Procesar la nueva imagen y obtener el nombre del archivo
    $nombre_imagen = $_FILES['imagen']['name'];
    $ruta_imagen = "carpeta_destino/" . $nombre_imagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);
} else {
    // Si no se subió una nueva imagen, mantener el nombre actual
    $nombre_imagen = $_POST['imagen_actual'];
}

// Actualizar los datos en la base de datos
$query = "UPDATE noticias_new SET fecha = '$fecha', resumen = '$resumen', codigo = '$codigo', titulo = '$titulo', visitas = '$visitas', autor = '$autor', cuerpo = '$cuerpo', imagen = '$nombre_imagen' WHERE id = $id";

if ($conexion->query($query) === TRUE) {
    // Redirigir a nueva_noticia.php después de guardar los cambios
    header("Location: nueva_noticia.php");
} else {
    echo "Error al actualizar la noticia: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
