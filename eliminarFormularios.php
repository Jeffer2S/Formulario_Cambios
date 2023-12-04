<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: rgb(141, 196, 196);
            font-family: sans-serif;
        }

        .tabla-responsive {
            width: 100%;
        }

        table {
            white-space: wrap;
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
        }

        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            text-align: center;
            background-color: greenyellow;
            border: 1px solid #000;
        }

        tr {
            overflow-anchor: none;
        }

        tr:hover {
            background-color: burlywood;
        }

        .Eliminar {
            text-decoration: none;
            color: #000;
            background-color: #9381ff;
            padding: 4px;
            border-radius: 5px;
        }

        .Eliminar:hover {
            color: #fff;
            background-color: #a31621;
        }

        .navbar {
            display: inline-block;
            text-align: center;
            border-radius: 5px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: rgb(0, 0, 0);
            font-size: x-large;
            margin-bottom: 10px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .navbar ul li {
            margin: 0 35px;
        }

        .navbar ul li a {
            display: block;
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: large;
            transition: background-color 0.3s, border-radius 0.3s;
            border-radius: 8px;
        }

        .navbar ul li a:hover {

            background-color: rgb(255, 255, 255);
            color: black;
            border-radius: 15px;
        }

        button {
            background-color: #208d23;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #000000;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><button onclick="window.location.href='./index.html'">Inicio</button></li>
        </ul>
    </nav>
    <?php
    require 'conexion.php';

    // Conectar a la base de datos
    $conexion = new Conexion("localhost", "root", "", "formulario");
    $conexion->conectar();
    $conn = $conexion->obtenerConexion();

    // Llamar al método obtenerDatos()
    $datos = $conexion->obtenerDatos();
    $conexion->cerrarConexion();

    echo '<div class="tabla-responsive">';
    echo '<table id="table">';
    echo '<tr name="tr">';
    echo '<th>N° Formulario</th>';
    echo '<th>Titulo Proyecto</th>';
    echo '<th>Título Solicitud</th>';
    echo '<th>N° Solicitud</th>';
    echo '<th>Nombre del solicitante</th>';
    echo '<th>Cargo o Rol</th>';
    echo '<th>Descripción del cambio</th>';
    echo '<th>Justificación del cambio</th>';
    echo '<th>Impacto que tendra</th>';
    echo '<th>Prioridad</th>';
    echo '<th>Recursos Necesarios</th>';
    echo '<th>Fecha propuesta</th>';
    echo '<th>Estado del Cambio</th>';
    echo '<th>Responsable de Solicitud</th>';
    echo '<th>Observaciones y Comentarios</th>';
    echo '<th>Acciones</th>';
    echo '</tr>';


    // Recorrer los datos y generar las filas de la tabla
    foreach ($datos as $dato) {
        echo '<tr name="tr">';
        echo '<td name="td">' . $dato['num_for'] . '</td>';
        echo '<td name="td">' . $dato['tit_pro'] . '</td>';
        echo '<td name="td">' . $dato['tit_soli'] . '</td>';
        echo '<td name="td">' . $dato['nro_soli'] . '</td>';
        echo '<td name="td">' . $dato['nom_soli'] . '</td>';
        echo '<td name="td">' . $dato['car_soli'] . '</td>';
        echo '<td name="td">' . $dato['des_soli'] . '</td>';
        echo '<td name="td">' . $dato['jus_soli'] . '</td>';
        echo '<td name="td">' . $dato['imp_soli'] . '</td>';
        echo '<td name="td">' . $dato['est_soli'] . '</td>';
        echo '<td name="td">' . $dato['res_soli'] . '</td>';
        echo '<td name="td">' . $dato['com_soli'] . '</td>';
        echo '<td name="td">' . $dato['pri_soli'] . '</td>';
        echo '<td name="td">' . $dato['rec_nec_soli'] . '</td>';
        echo '<td name="td">' . $dato['fec_pro_soli'] . '</td>';

        // Agregar  eliminar en cada fila
        echo '<td><a href="?eliminar=' . $dato['num_for'] . '"class="Eliminar">Eliminar</a></td>';

        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';

    function eliminarFila($idEliminar)
    {
        $conexion = new Conexion("localhost", "root", "", "formulario");
        $conexion->conectar();
        $conn = $conexion->obtenerConexion();

        // Eliminar la fila correspondiente al ID
        $sql = "DELETE FROM datos_formulario WHERE num_for = $idEliminar";
        $resultado = $conn->query($sql);

        if ($resultado) {
            echo "Fila eliminada correctamente.";
        } else {
            echo "Error al eliminar la fila: " . $conn->error;
        }

        $conexion->cerrarConexion();
        // Redirigir a la página actual
        header('Location: ' . $_SERVER['PHP_SELF']);
    }

    // Obtener el parámetro de eliminación
    if (isset($_GET['eliminar'])) {
        $idEliminar = $_GET['eliminar'];
        eliminarFila($idEliminar);
    }

    ?>

</body>

</html>