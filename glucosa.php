<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require_once "procesos.php";
$procesos = new Procesos($_SESSION['usuario']);

$procesos->incrementarContador("glucosa");

// Obtener los datos ingresados por el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lectura = $_POST["lectura"];
    $tipo = $_POST["tipo"];

    // Realizar el diagnóstico
    $diagnostico = $procesos->diagnosticarGlucosa($lectura, $tipo);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Glucosa en Sangre - Consultorio Clínico SC</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Consultorio Clínico SC</h1>
    </header>
    
    <div>
        <?php
        $procesos->mostrarBienvenida();
        $procesos->mostrarMenu();
        ?>
        
        <h2>Glucosa en Sangre</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="lectura">Lectura:</label>
            <input type="number" id="lectura" name="lectura" required>
            <br>
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="ayunas">Ayunas</option>
                <option value="posprandial">Posprandial</option>
            </select>
            <br>
            <button type="submit">Diagnosticar</button>
        </form>
        
        <?php if (isset($diagnostico)) { ?>
            <h3>Diagnóstico:</h3>
            <p><?php echo $diagnostico; ?></p>
        <?php } ?>
        
        <p>Visitas: <?php echo $procesos->obtenerContador("glucosa"); ?></p>
    </div>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Consultorio Clínico SC. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
