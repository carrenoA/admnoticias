<?php
// Conectar a la base de datos (sin usuario ni contraseña)
$conexion = new mysqli("localhost", "root", "", "admnoticias");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar el formulario si se envió
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los valores del formulario
    $fecha = $_POST["fecha"];
    $codigo = $_POST["codigo"];
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];

    // Manejar el contenido del resumen y cuerpo de CKEditor
    $resumen = $_POST["resumen"];
    $cuerpo = $_POST["cuerpo"];

    // Guardar la imagen en el servidor (puedes personalizar esta parte según tus necesidades)
    $imagenNombre = $_FILES["imagen"]["name"];
    $imagenTmp = $_FILES["imagen"]["tmp_name"];
    $carpetaDestino = "images/";  // Ajusta la carpeta de destino según tu configuración
    move_uploaded_file($imagenTmp, $carpetaDestino . $imagenNombre);


    // Insertar la noticia en la base de datos
    $query = "INSERT INTO noticias_new (fecha, resumen, codigo, titulo, autor, cuerpo, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sssssss", $fecha, $resumen, $codigo, $titulo, $autor, $cuerpo, $imagenNombre);

    if ($stmt->execute()) {
        // Redirigir a la página de noticias después de guardar
        header("Location: nueva_noticia.php");
        exit();
    } else {
        echo "Error al guardar la noticia: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
}

// Otros procesos de guardado...

// Procesar la imagen
if (isset($_FILES['imagen'])) {
    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $imagen_ruta = 'images/' . $imagen_nombre;

    // Mueve la imagen a la carpeta 'images'
    move_uploaded_file($imagen_temp, $imagen_ruta);

    // Guarda el nombre de la imagen en la base de datos
    $query = "INSERT INTO noticias_new (imagen) VALUES ('$imagen_nombre')";
    $result = $conexion->query($query);

    if (!$result) {
        echo "Error al guardar la imagen en la base de datos: " . $conexion->error;
    }
}

// Otros procesos de redirección o respuesta...

// Cerrar la conexión
$conexion->close();
?>