<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Noticias</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }

        .title {
            color: #343a40;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Bienvenido al Administrador de Noticias</h1>
        <button class="btn" onclick="window.location.href='nueva_noticia.php'">Entrar</button>
    </div>
</body>

</html>