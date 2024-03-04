<?php
  session_start();
  include 'includes/db.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obtener los datos del formulario
      $nombre = $_POST['nombre'];
      $genero = $_POST['genero'];
      $correo = $_POST['correo'];

      // Guardar los datos en la sesión
      $_SESSION['nombre'] = $nombre;
      $_SESSION['genero'] = $genero;
      $_SESSION['correo'] = $correo;

      // Redirigir al archivo resultado.php
      header("Location:/Brunono/templates/juguetes.php");
      exit;
  }

  include 'templates/formulario.php';
?>
<html>
  <head>
    <title>Catalogo</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <header>
    <h1>Bienvenido a la jugueteria !</h1>
  </header>
  <body>
    <form action="index.php" method="POST">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" required>
      <label for="correo">Correo:</label>
      <input type="text" id="correo" name="correo" required>
      <label for="genero">Género:</label>
      <select id="genero" name="genero" required>
          <option value="niño">Niño</option>
          <option value="niña">Niña</option>
      </select>
      <button type="submit">Enviar</button>
    </form>
  </body>
  <footer>
    <p>Pagina desarrollada para Prueba Tecnica en HD Latinoamerica</p>
  </footer>
</html>