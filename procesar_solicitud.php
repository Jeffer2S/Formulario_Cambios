<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo_proye = $_POST["titulo_proye"];
    $titulo_soli = $_POST["titulo_soli"];
    $nombre_soli = $_POST["nombre_soli"];
    $cargo = $_POST["cargo"];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "formulariocambios";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    } else {
        // Insertar datos en la tabla 'solicitudes'
        $sql = "INSERT INTO formularios (tit_pro, tit_soli, nom_soli, car_soli) 
                VALUES ('$titulo_proye', '$titulo_soli', '$nombre_soli', '$cargo')";

        if ($conn->query($sql) === TRUE) {
            echo "Datos insertados correctamente";
        } else {
            echo "Error al insertar datos: " . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
    header("Location: index.html");
    exit(); // Asegura que el script se detenga después de la redirección
}
?>
