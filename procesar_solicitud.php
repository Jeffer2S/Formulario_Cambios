<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo_proye = $_POST["titulo_proye"];
    $titulo_soli = $_POST["titulo_soli"];
    $nombre_soli = $_POST["nombre_soli"];
    $cargo = $_POST["cargo"];
    $des_soli = $_POST["des_soli"];
    $jus_soli = $_POST["jus_soli"];
    $imp_soli = $_POST["imp_soli"];
    $est_soli = $_POST["est_soli"];
    $res_soli = $_POST["res_soli"];
    $com_soli = $_POST["com_soli"];
    $pri_soli = $_POST["pri_soli"];
    $rec_nec_soli = $_POST["rec_nec_soli"];
    $fec_pro_soli = $_POST["fec_pro_soli"];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "formulario";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    } else {
        // Sanitizar los datos (evitar inyección de SQL)
        $titulo_proye = mysqli_real_escape_string($conn, $titulo_proye);
        $titulo_soli = mysqli_real_escape_string($conn, $titulo_soli);
        $nombre_soli = mysqli_real_escape_string($conn, $nombre_soli);
        $cargo = mysqli_real_escape_string($conn, $cargo);
        $des_soli = mysqli_real_escape_string($conn, $des_soli);
        $jus_soli = mysqli_real_escape_string($conn, $jus_soli);
        $imp_soli = mysqli_real_escape_string($conn, $imp_soli);
        $est_soli = mysqli_real_escape_string($conn, $est_soli);
        $res_soli = mysqli_real_escape_string($conn, $res_soli);
        $com_soli = mysqli_real_escape_string($conn, $com_soli);
        $pri_soli = mysqli_real_escape_string($conn, $pri_soli);
        $rec_nec_soli = mysqli_real_escape_string($conn, $rec_nec_soli);
        $fec_pro_soli = mysqli_real_escape_string($conn, $fec_pro_soli);

        // Insertar datos en la tabla 'datos_formulario' con sentencia preparada
        $sql = "INSERT INTO datos_formulario (tit_pro, tit_soli, nom_soli, car_soli, des_soli, jus_soli, imp_soli, est_soli, res_soli, com_soli, pri_soli, rec_nec_soli, fec_pro_soli) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssss", $titulo_proye, $titulo_soli, $nombre_soli, $cargo, $des_soli, $jus_soli, $imp_soli, $est_soli, $res_soli, $com_soli, $pri_soli, $rec_nec_soli, $fec_pro_soli);

        if ($stmt->execute()) {
            echo "Datos insertados correctamente";
        } else {
            echo "Error al insertar datos: " . $stmt->error;
        }

        $stmt->close();
    }

    // Cerrar la conexión
    $conn->close();

    // Redirigir al usuario a index.html
    header("Location: index.html");
    exit(); // Asegura que el script se detenga después de la redirección
}
?>
