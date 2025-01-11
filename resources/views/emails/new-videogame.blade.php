<!-- resources/views/emails/new-videogame.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Videojuego</title>
</head>
<body>
    <h1>¡Nuevo Videojuego Creado!</h1>
    <p>Un nuevo videojuego ha sido creado con los siguientes detalles:</p>
    <p><strong>Nombre:</strong> {{ $videogame->name }}</p>
    <p><strong>Descripción:</strong> {{ $videogame->description }}</p>
</body>
</html>
