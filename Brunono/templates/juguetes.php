<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['nombre']) || !isset($_SESSION['genero'])) {
    header("Location: index.php");
    exit;
}

$nombre = $_SESSION['nombre'];
$genero = $_SESSION['genero'];
$correo = $_SESSION['correo'];

// Consulta SQL para obtener los nombres y precios de los juguetes
$sql = "SELECT nombre, precio FROM juguetes WHERE categoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $genero);
$stmt->execute();
$result = $stmt->get_result();

// Array para almacenar los datos de los juguetes
$juguetes = array();

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Almacenar los nombres y precios de los juguetes en el arreglo
    while($row = $result->fetch_assoc()) {
        $juguetes[] = array(
            'nombre' => $row["nombre"],
            'precio' => $row["precio"]
        );
    }
} else {
    echo "No se encontraron juguetes.";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juguetes para <?php echo $genero; ?></title>
    <link rel="stylesheet" href="../css/juguete.css">
</head>
<header>
  <h1>Hola <?php echo $nombre ?>, estos son los juguetes que te recomendamos</h1>
</header>
<body>
  <div class="juguetes">
    <?php
    // Imprimir los nombres, precios e imágenes de los juguetes utilizando el arreglo
    if (!empty($juguetes)) {
        foreach ($juguetes as $juguete) {
            echo "<form action='/correo.php' method='post'>";
            echo "<img src='../img/{$juguete['nombre']}.jpg' alt='{$juguete['nombre']}'>";
            echo "<p><strong>{$juguete['nombre']}</strong>: {$juguete['precio']} </p>";
            echo "<input type='hidden' name='nombre' value='{$juguete['nombre']}'>";
            echo "<input type='hidden' name='precio' value='{$juguete['precio']}'>";
            echo "<button type='submit' name='submit'>Enviar</button>";
            echo "</form>";
        }
    }
    ?>  
  </div>
</body>
<footer>
  <p>Pagina desarrollada para Prueba Tecnica en HD Latinoamerica</p>
</footer>
</html>
