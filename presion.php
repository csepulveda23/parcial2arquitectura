<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require_once "procesos.php";
$procesos = new Procesos($_SESSION['usuario']);

$procesos->incrementarContador("presion");

// Obtener los datos ingresados por el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sistolica = $_POST["sistolica"];
    $diastolica = $_POST["diastolica"];

    // Realizar el diagnóstico
    $diagnostico = $procesos->diagnosticarPresion($sistolica, $diastolica);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Presión Arterial - Consultorio Clínico ABC</title>
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
        
        <h2>Presión Arterial</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="sistolica">Presión Sistólica:</label>
            <input type="number" id="sistolica" name="sistolica" required>
            <br>
            <label for="diastolica">Presión Diastólica:</label>
            <input type="number" id="diastolica" name="diastolica" required>
            <br>
            <button type="submit">Diagnosticar</button>
        </form>
        
        <?php if (isset($diagnostico)) { ?>
            <h3>Diagnóstico:</h3>
            <p><?php echo $diagnostico; ?></p>
        <?php } ?>
        
        <p>Visitas: <?php echo $procesos->obtenerContador("presion"); ?></p>
    </div>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Consultorio Clínico SC. Todos los derechos reservados.</p>
    </footer>
</body>
</html>


