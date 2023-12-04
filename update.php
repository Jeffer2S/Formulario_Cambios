<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tit_pro = $_POST["titulo_proye"];
    $tit_soli = $_POST["titulo_soli"];
    $num_soli = $_POST["nro_soli"];
    $nom_sol = $_POST["nombre_soli"];
    $car_sol = $_POST["cargo"];
    $des_sol = $_POST["descripcion"];
    $jus_sol = $_POST["justificacion"];
    $imp_sol = $_POST["impacto"];
    $pri_sol = $_POST["prioridad"];
    $rec_sol = $_POST["recursos_n"];
    $fec_sol = $_POST["fecha"];
    $est_sol = $_POST["estado_solicitud"];
    $res_sol = $_POST["responsable"];
    $com_sol = $_POST["comentarios"];
    $id = $_POST["id"];

    // Incluye el archivo de conexión
    require 'conexion.php';

    // Conecta a la base de datos
    $conexion = new Conexion("localhost", "root", "", "formulario");
    $conexion->conectar();
    $conn = $conexion->obtenerConexion();

    if ($conn) {
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
        mysqli_stmt_bind_param($stmt_update, "ssssssssssssssi", $tit_pro, $tit_soli, $num_soli, $nom_sol, $car_sol, $des_sol, $jus_sol, $imp_sol, $pri_sol, $rec_sol, $fec_sol, $est_sol, $res_sol, $com_sol, $id);

        if (mysqli_stmt_execute($stmt_update)) {
            echo "¡Registro actualizado correctamente!";
        } else {
            echo "Error al actualizar el registro: " . mysqli_stmt_error($stmt_update);
        }
    }
} else {
    echo "Acceso no autorizado";
}
?>
