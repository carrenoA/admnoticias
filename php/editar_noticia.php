<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia</title>

    <!-- Enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Enlace a FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Agrega el script de CKEditor -->
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>

    <!-- Enlace a SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
        }

        label {
            font-weight: bold;
            color: #495057;
        }

        input[type="text"],
        input[type="datetime-local"],
        input[type="file"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-container button,
        .btn-container a.btn {
            margin-top: 0;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <?php
        // Conectar a la base de datos
        $conexion = new mysqli("localhost", "root", "", "admnoticias");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Obtener el id de la noticia de la URL
        $id_noticia = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($id_noticia <= 0) {
            echo "ID de noticia no válido.";
            // Puedes redirigir al usuario o mostrar un mensaje de error.
            exit;
        }

        // Consulta para seleccionar todos los campos de la noticia específica
        $query = "SELECT id, fecha, resumen, codigo, titulo, visitas, autor, cuerpo, imagen FROM noticias_new WHERE id = $id_noticia";
        $result = $conexion->query($query);

        // Verificar si la consulta fue exitosa
        if ($result) {
            // Obtener el registro de la base de datos
            $noticia = $result->fetch_assoc();

            // Mostrar los campos en un formulario para edición
            echo "<form id='editarForm' action='guardar_edicion.php' method='POST' enctype='multipart/form-data'>";
            foreach ($noticia as $campo => $valor) {
                if ($campo === 'id') {
                    // Si el campo es 'id', mostrar solo el valor sin un campo de entrada editable
                    // echo "<label>$campo: $valor</label><br>";
                    // También incluir un campo oculto para enviar el valor 'id' al formulario
                    echo "<input type='hidden' name='$campo' value='$valor'>";
                } elseif ($campo === 'imagen') {
                    // Si el campo es 'imagen', mostrar el nombre actual de la imagen y permitir cargar una nueva
                    echo "<label>$campo: $valor</label><br>";
                    echo "<input type='file' name='$campo' accept='image/*'><br>";
                } elseif ($campo === 'fecha') {
                    // Si el campo es 'fecha', mostrar un campo de entrada tipo 'datetime-local' para la fecha
                    echo "<label>$campo: <input type='datetime-local' name='$campo' value='" . date('Y-m-d\TH:i', strtotime($valor)) . "'></label><br>";
                } elseif ($campo === 'resumen' || $campo === 'cuerpo') {
                    // Si el campo es 'resumen' o 'cuerpo', mostrar el editor CKEditor
                    echo "<label>$campo:</label><br>";
                    echo "<textarea id='editor_$campo' class='form-control' name='$campo' rows='4'>$valor</textarea><br>";
                } else {
                    // Si no es 'id', 'imagen', 'fecha', 'resumen' ni 'cuerpo', mostrar un campo de entrada editable
                    echo "<label>$campo: <input type='text' name='$campo' value='$valor'></label><br>";
                }
            }

            // Botón para guardar cambios
            echo "<div class='mb-3'>";
            echo "<input type='button' value='Guardar Cambios' onclick='confirmarEdicion()' class='btn btn-primary'>";
            echo "</div>";

            // Cerrar el formulario
            echo "</form>";

            // Botón para volver a "nueva_noticia.php"
            echo "<a href='nueva_noticia.php' class='btn btn-secondary'><i class='fas fa-arrow-left'></i> Volver</a>";

            // Liberar el resultado
            $result->free();
        } else {
            echo "Error en la consulta: " . $conexion->error;
        }

        // Cerrar la conexión
        $conexion->close();
        ?>

        <script>
            CKEDITOR.replace('editor_resumen');
            CKEDITOR.replace('editor_cuerpo');

            function confirmarEdicion() {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Se guardarán los cambios en la noticia.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar cambios'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('editarForm').submit();
                    }
                });
            }
        </script>
    </div>
</body>

</html>