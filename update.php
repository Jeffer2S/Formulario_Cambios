<?php
// Incluye el archivo de conexión
require 'conexion.php';

// Conecta a la base de datos
$conexion = new Conexion("localhost", "root", "", "formulario");
$conexion->conectar();
$conn = $conexion->obtenerConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $conn) {
    // Validar y sanar los datos
    $tit_pro = isset($_POST["titulo_proye"]) ? mysqli_real_escape_string($conn, $_POST["titulo_proye"]) : '';
    $tit_soli = isset($_POST["titulo_soli"]) ? mysqli_real_escape_string($conn, $_POST["titulo_soli"]) : '';
    $num_soli = isset($_POST["nro_soli"]) ? intval($_POST["nro_soli"]) : 0;
    $nom_sol = isset($_POST["nombre_soli"]) ? mysqli_real_escape_string($conn, $_POST["nombre_soli"]) : '';
    $car_sol = isset($_POST["cargo"]) ? mysqli_real_escape_string($conn, $_POST["cargo"]) : '';
    $des_sol = isset($_POST["descripcion"]) ? mysqli_real_escape_string($conn, $_POST["descripcion"]) : '';
    $jus_sol = isset($_POST["justificacion"]) ? mysqli_real_escape_string($conn, $_POST["justificacion"]) : '';
    $imp_sol = isset($_POST["impacto"]) ? mysqli_real_escape_string($conn, $_POST["impacto"]) : '';
    $pri_sol = isset($_POST["prioridad"]) ? mysqli_real_escape_string($conn, $_POST["prioridad"]) : '';
    $rec_sol = isset($_POST["recursos_n"]) ? mysqli_real_escape_string($conn, $_POST["recursos_n"]) : '';
    $fec_sol = isset($_POST["fecha"]) ? mysqli_real_escape_string($conn, $_POST["fecha"]) : '';
    $est_sol = isset($_POST["estado_solicitud"]) ? mysqli_real_escape_string($conn, $_POST["estado_solicitud"]) : '';
    $res_sol = isset($_POST["responsable"]) ? mysqli_real_escape_string($conn, $_POST["responsable"]) : '';
    $com_sol = isset($_POST["comentarios"]) ? mysqli_real_escape_string($conn, $_POST["comentarios"]) : '';

    // Actualiza el registro en la base de datos
    $sql_update = "UPDATE datos_formulario SET 
        tit_pro = ?,
        tit_soli = ?,
        nro_soli = ?,
        nom_soli = ?,
        car_soli = ?,
        des_soli = ?,
        jus_soli = ?,
        imp_soli = ?,
        pri_soli = ?,
        rec_nec_soli = ?,
        fec_pro_soli = ?,
        est_soli = ?,
        res_soli = ?,
        com_soli = ?
        WHERE num_for = ?";

    $stmt_update = mysqli_prepare($conn, $sql_update);

    if ($stmt_update) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt_update, "ssisssssssssssi", $tit_pro, $tit_soli, $num_soli, $nom_sol, $car_sol, $des_sol, $jus_sol, $imp_sol, $pri_sol, $rec_sol, $fec_sol, $est_sol, $res_sol, $com_sol, $id);

        // Execute statement
        if (mysqli_stmt_execute($stmt_update)) {
            echo "¡Registro actualizado correctamente!";
        } else {
            echo "Error al actualizar el registro: " . mysqli_stmt_error($stmt_update);
        }

        // Close statement
        mysqli_stmt_close($stmt_update);
    } else {
        echo "Error al preparar la declaración: " . mysqli_error($conn);
    }

    // Resto del código...
} else {
    echo "Acceso no autorizado";
}
?>
