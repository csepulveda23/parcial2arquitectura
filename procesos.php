<?php
class Procesos
{
    private $nombreUsuario;
    
    public function __construct($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }
    
    public function mostrarBienvenida()
    {
        echo "<h2>Bienvenido, " . $this->nombreUsuario . ".</h2>";
        echo "<h2>Eligue que deseas medir hoy:</h2>";
    }
    
    public function mostrarMenu()
    {
        echo "<nav>";
        echo "<a href='imc.php' class=\"opcionesmenu\">IMC</a>";
        echo "<a href='glucosa.php' class=\"opcionesmenu\">Glucosa</a>";
        echo "<a href='presion.php' class=\"opcionesmenu\">Presión</a>";
        echo "<div class=\"animation start-home\"></div>";
        echo "</nav>";
    }
    
    public function incrementarContador($opcion)
    {
        if (!isset($_SESSION['contador'][$opcion])) {
            $_SESSION['contador'][$opcion] = 1;
        } else {
            $_SESSION['contador'][$opcion]++;
        }
    }
    
    public function obtenerContador($opcion)
    {
        return isset($_SESSION['contador'][$opcion]) ? $_SESSION['contador'][$opcion] : 0;
    }
    
    public function calcularIMC($peso, $estatura)
    {
        return round($peso / (($estatura/100) * ($estatura/100)), 2);
    }
    
    public function diagnosticarIMC($imc)
    {
        if ($imc < 18.5) {
            return "Bajo de peso: ¡Necesitas alimentarte mejor!";
        } elseif ($imc >= 18.5 && $imc <= 24.9) {
            return "Peso normal: ¡Mantén tu estilo de vida saludable!";
        } elseif ($imc >= 25 && $imc <= 29.9) {
            return "Sobrepeso: ¡Considera hacer ejercicio y cuidar tu alimentación!";
        } elseif ($imc >= 30 && $imc <= 39.9) {
            return "Obesidad: ¡Es importante tomar medidas para mejorar tu salud!";
        } else {
            return "Obesidad extrema: ¡Consulta a un profesional de la salud!";
        }
    }
    
    public function diagnosticarGlucosa($lectura, $tipo)
    {
        if ($tipo === "ayunas") {
            if ($lectura >= 70 && $lectura <= 100) {
                return "Glucosa en ayunas normal: ¡Sigue cuidando tu alimentación!";
            } elseif ($lectura >= 100 && $lectura <= 125) {
                return "Pre-diabetes en ayunas: ¡Considera realizar cambios en tu estilo de vida!";
            } elseif ($lectura >= 126) {
                return "Diabetes en ayunas: ¡Consulta a un especialista!";
            }
        } elseif ($tipo === "posprandial") {
            if ($lectura < 140) {
                return "Glucosa posprandial normal: ¡Continúa con tus hábitos saludables!";
            } elseif ($lectura >= 140 && $lectura <= 199) {
                return "Pre-diabetes posprandial: ¡Es importante realizar cambios en tu estilo de vida!";
            } elseif ($lectura >= 200) {
                return "Diabetes posprandial: ¡Consulta a un especialista!";
            }
        }
        
        return "Error: No se pudo realizar el diagnóstico.";
    }
    
    public function diagnosticarPresion($sistolica, $diastolica)
    {
        if ($sistolica < 120 && $diastolica < 80) {
            return "Presión arterial normal: ¡Sigue cuidando tu salud!";
        } elseif ($sistolica >= 120 && $sistolica <= 129 && $diastolica < 80) {
            return "Presión arterial elevada: ¡Es importante monitorear tu presión!";
        } elseif ($sistolica >= 130 && $sistolica <= 139 && $diastolica >= 80 && $diastolica <= 89) {
            return "Hipertensión nivel 1: ¡Consulta a un profesional de la salud!";
        } elseif ($sistolica >= 140 && $diastolica >= 90) {
            return "Hipertensión nivel 2: ¡Consulta a un especialista!";
        } elseif ($sistolica > 180 || $diastolica > 120) {
            return "Crisis de hipertensión: ¡Busca atención médica de inmediato!";
        }
        
        return "Error: No se pudo realizar el diagnóstico.";
    }
}
?>
