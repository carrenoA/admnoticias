<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Noticia</title>

    <!-- Enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Enlace a FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Agrega el script de CKEditor -->
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .title {
            color: #343a40;
        }

        form {
            display: grid;
            gap: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        button,
        a.btn {
            margin-top: 10px;
        }

        /* Nuevos estilos para los botones */
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            /* Agrega margen superior */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Agregar Nueva Noticia</h1>

        <!-- Formulario para agregar noticias -->
        <form id="noticiaForm" action="guardar_noticia.php" method="post" enctype="multipart/form-data"
            onsubmit="return validarFormulario()">
            <!-- Campos del formulario -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="datetime-local" class="form-control" name="fecha" required>
            </div>

            <div class="mb-3">
                <label for="resumen" class="form-label">Resumen:</label>
                <textarea id="editor1_resumen" class="form-control" name="resumen" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="codigo" class="form-label">Código:</label>
                <input type="text" class="form-control" name="codigo" required>
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>

            <div class="mb-3">
                <label for="autor" class="form-label">Autor:</label>
                <input type="text" class="form-control" name="autor" required>
            </div>

            <div class="mb-3">
                <label for="cuerpo" class="form-label">Cuerpo:</label>
                <textarea id="editor1_cuerpo" class="form-control" name="cuerpo" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" accept="images/*" required>
            </div>

            <!-- Campos adicionales -->
            <input type="hidden" name="principal" value="0">
            <input type="hidden" name="status">
            <input type="hidden" name="eliminado" value="0">
            <input type="hidden" name="fecha_creacion" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="id_usuario">

            <div class="btn-container">
                <button type="submit" class="btn btn-primary" name="guardar">Agregar</button>
                <a href="nueva_noticia.php" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>

    <!-- Script para inicializar CKEditor -->
    <script>
        CKEDITOR.replace('editor1_resumen');
        CKEDITOR.replace('editor1_cuerpo');

        function validarFormulario() {
            var resumen = CKEDITOR.instances.editor1_resumen.getData();
            var cuerpo = CKEDITOR.instances.editor1_cuerpo.getData();

            if (resumen.trim() === "" || cuerpo.trim() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos Vacíos',
                    text: 'Los campos Resumen y Cuerpo no pueden estar vacíos',
                });
                return false;
            }

            return true;
        }
    </script>

</body>

</html>