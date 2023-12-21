<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Noticias</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0"></script>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Enlace al archivo CSS de Bootstrap -->

    <!-- Enlace a DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <!-- Enlace a DataTables JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    <!-- Enlace a DataTables Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    <!-- Enlace a DataTables Bootstrap JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

    <script>
        function confirmarEliminar(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede revertir. ¿Estás seguro de que quieres eliminar este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario hace clic en "Sí, eliminarlo", redirige al script de eliminación
                    window.location.href = 'eliminar_noticia.php?id=' + id;
                }
            });
        }
    </script>
    <script>
        function verImagen(imagen) {
            // Redirige a la página mostrar_imagen.php con el parámetro de imagen
            window.location.href = `mostrar_imagen.php?imagen=${imagen}`;
        }
    </script>




    <style>
        /* Estilo personalizado */
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .title {
            color: #343a40;
        }

        .btn {
            margin-bottom: 20px;
        }

        table {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: none;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        a {
            color: #007bff;
        }

        a:hover {
            text-decoration: none;
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Lista de Noticias</h1>

        <a href="agregar_noticia.php" class="btn btn-primary">Agregar Noticia</a>

        <table id="noticiasTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Título</th>
                    <th>Ver Imagen</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Conectar a la base de datos
                $conexion = new mysqli("localhost", "root", "", "admnoticias");

                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                // Consulta para seleccionar los campos específicos
                $query = "SELECT id, fecha, titulo, imagen FROM noticias_new";
                $result = $conexion->query($query);

                // Verificar si la consulta fue exitosa
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        // Dentro del bucle while
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['fecha']}</td>";
                        echo "<td>{$row['titulo']}</td>";
                        echo "<td class='text-left'><a href='#' class='btn btn-primary' onclick='verImagen(\"{$row['imagen']}\")'>Ver Imagen</a></td>";
                        echo "<td class='text-left'><a href='editar_noticia.php?id={$row['id']}' class='btn btn-warning'><i class='fas fa-pencil-alt'></i></a></td>";
                        echo "<td class='text-left'><a href='#' onclick='confirmarEliminar({$row['id']})' class='btn btn-danger'><i class='fas fa-trash'></i></a></td>";
                        echo "</tr>";
                    }
                    // Liberar el resultado
                    $result->free();
                } else {
                    echo "Error en la consulta: " . $conexion->error;
                }

                $conexion->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#noticiasTable').DataTable({
                "paging": true,
                "lengthMenu": [5, 10, 15, 20],
                "pageLength": 5, 
                "searching": true, 
                "responsive": true, 
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron registros",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros en total)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
</body>

</html>