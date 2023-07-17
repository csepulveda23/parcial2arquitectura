<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require_once "procesos.php";
$procesos = new Procesos($_SESSION['usuario']);

// Incrementar contador de visitas para la opción IMC
$procesos->incrementarContador("imc");

// Obtener los datos ingresados por el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $peso = $_POST["peso"];
    $estatura = $_POST["estatura"];

    // Calcular el IMC
    $imc = $procesos->calcularIMC($peso, $estatura);

    // Mostrar el diagnóstico correspondiente
    $diagnostico = $procesos->diagnosticarIMC($imc);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>IMC - Consultorio Clínico SC</title>
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
        
        <h2>Índice de Masa Corporal (IMC)</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="peso">Peso (kg):</label>
            <input type="number" id="peso" name="peso" step="0.1" required>
            <br>
            <label for="estatura">Estatura (cm):</label>
            <input type="number" id="estatura" name="estatura" step="0.01" required>
            <br>
            <button type="submit">Calcular</button>
        </form>
        
        <?php if (isset($imc)) { ?>
            <h3>Tu IMC es: <?php echo $imc; ?></h3>
            <p><?php echo $diagnostico; ?></p>
        <?php } ?>
        
        <p>Visitas: <?php echo $procesos->obtenerContador("imc"); ?></p>
        </div>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Consultorio Clínico SC. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
