
<?php
session_start();

// Verificar si el usuario ya inició sesión
if (isset($_SESSION['usuario'])) {
    // El usuario ya inició sesión, redirigir al menú principal
    header("Location: menu.php");
    exit();
}

// Verificar si se envió el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Verificar si los datos de inicio de sesión son correctos
    if ($usuario === "paciente" && $contrasena === "pass1234") {
        // Inicio de sesión exitoso, almacenar el nombre de usuario en la sesión
        $_SESSION['usuario'] = $usuario;

        // Redirigir al menú principal
        header("Location: menu.php");
        exit();
    } else {
        // Datos de inicio de sesión incorrectos, mostrar mensaje de error
        $mensajeError = "Usuario o contraseña incorrectos.";
    }
}
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
    
    <div>
        <h2>Iniciar sesión</h2>
        <?php if (isset($mensajeError)) { ?>
            <p><?php echo $mensajeError; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
            <br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            <br>
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Consultorio Clínico SC. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
