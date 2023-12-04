<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'conexion.php';
    $conexion = new Conexion("localhost:33065", "root", "", "formulario");
    $conexion->conectar();
    $conn = $conexion->obtenerConexion();

    if (isset($_POST['titulo_proye']) && isset($_POST['titulo_soli']) && isset($_POST['nro_soli']) && isset($_POST['nombre_soli']) &&       isset($_POST['cargo']) && isset($_POST['descripcion']) && isset($_POST['justificacion']) && isset($_POST['impacto']) && isset($_POST['estado_solicitud']) && isset($_POST['responsable']) && isset($_POST['comentarios']) && isset($_POST['prioridad']) && isset($_POST['recursos_n']) && isset($_POST['fecha'])) {

        $titulo_proye = $_POST['titulo_proye'];
        $titulo_soli = $_POST['titulo_soli'];
        $nro_soli = $_POST['nro_soli'];
        $nombre_soli = $_POST['nombre_soli'];
        $cargo = $_POST['cargo'];
        $descripcion = $_POST['descripcion'];
        $justificacion = $_POST['justificacion'];
        $impacto = $_POST['impacto'];
        $estado_solicitud = $_POST['estado_solicitud'];
        $responsable = $_POST['responsable'];
        $comentarios = $_POST['comentarios'];
        $prioridad = $_POST['prioridad'];
        $recursos_n = $_POST['recursos_n'];
        $fecha = $_POST['fecha'];

        $conexion->insertar($titulo_proye, $titulo_soli, $nro_soli, $nombre_soli, $cargo, $descripcion, $justificacion, $impacto, $estado_solicitud, $responsable, $comentarios, $prioridad, $recursos_n, $fecha);

        echo '<script>alert("Campos vacíos. Por favor, complete todos los campos.");</script>';
        $conexion->cerrarConexion();
    }

    // Redirigir al usuario a index.html
    header("Location: index.html");
    exit(); // Asegura que el script se detenga después de la redirección
}
