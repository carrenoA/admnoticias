<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "admnoticias");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del registro a eliminar
$id = $_GET['id'];

// Consulta SQL para eliminar el registro
$query = "DELETE FROM noticias_new WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

// Ejecutar la consulta
if ($stmt->execute()) {
    // La eliminación fue exitosa, redirigir a la página de noticias
    header("Location: nueva_noticia.php");
    exit();
} else {
    // Hubo un error en la eliminación
    echo "Error al eliminar el registro: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
