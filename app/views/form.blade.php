<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Formulario</title>
</head>
<body>
	<form action="{{ action('AlmacenControlador@postGuardar') }}" method="POST">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" placeholder="Escribe un nombre">
	</form>

</body>
</html>