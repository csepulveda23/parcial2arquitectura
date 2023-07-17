<?php
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: index.php");
    exit();
}

// Obtener el nombre de usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];

require_once "procesos.php"; // Incluir la clase Procesos

// Crear una instancia de la clase Procesos
$procesos = new Procesos($nombreUsuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultorio Clínico SC</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Consultorio Clínico SC</h1>
    </header>
    
    <div class="principal">

      <div class="opciones">
        <div class="opcionesinter">
          <?php
          $procesos->mostrarBienvenida(); // Mostrar mensaje de bienvenida
          $procesos->mostrarMenu(); // Mostrar el menú principal
          ?>
          </div>
      </div>


</div>
    </div>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Consultorio Clínico SC. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
