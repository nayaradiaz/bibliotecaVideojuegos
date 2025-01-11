<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Videojuego Creado</title>
</head>
<body>
    <h1>Nuevo Videojuego Creado</h1>

    <p><strong>Título:</strong> {{ $name }}</p>
    <p><strong>Descripción:</strong> {{ $description }}</p>
    <p><strong>Creador:</strong> {{ $user_name }}</p>
    @if ($cover)
        <p><strong>Portada:</strong> <img src="{{ asset('storage/' . $cover) }}" alt="Cover" width="150"></p>
    @else
        <p><strong>Portada:</strong> No se proporcionó portada</p>
    @endif
</body>
</html>
