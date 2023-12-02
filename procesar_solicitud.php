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

        // Insertar datos en la tabla 'formularios' con sentencia preparada
        $sql = "INSERT INTO datos_formulario (tit_pro, tit_soli, nom_soli, car_soli) 
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $titulo_proye, $titulo_soli, $nombre_soli, $cargo);

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
