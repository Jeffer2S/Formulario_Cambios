<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes Realizadas</title>
    <link rel="stylesheet" href="./formularios.css">
</head>

<header>
    <img src="./imagenes/banner1.jpg" alt="Banner 1">
</header>

<body>
<nav class="navbar">
        <ul>
            <li><a href="./index.html">Inicio</a></li>
        </ul>
    </nav>
    <h2 class="titulo">Seleccione un Formulario:</h2>
    <div class="container">
        <section>
            <div class="contformulario">
                <h2 class="txtformulario1">Número de Solicitud</h2>
            </div>
            <div class="contformulario">
                <h2 class="txtformulario1">Proyecto</h2>
            </div>
            <div class="contformulario">
                <h2 class="txtformulario1">Nombre de Solicitud</h2>
            </div>
            <div class="contbutton">
                <h2 class="txtformulario1"></h2>
            </div>
        </section>
    <?php
    require 'conexion.php';
    $conexion = new Conexion("localhost", "root", "", "formulario");
    $conexion->conectar();
    $conn = $conexion->obtenerConexion();
    if ($conn){
        $sql= "SELECT tit_pro, tit_soli, nro_soli, num_for FROM datos_formulario";
        $result = mysqli_query($conn,$sql);
        if ($result){
            while ($row = $result->fetch_array()) {
                $proy=$row['tit_pro'];
                $solic=$row['tit_soli'];
                $numero=$row['nro_soli'];
                $numeroFor=$row['num_for'];
            ?> 
            
            <section>
                <div class="contformulario">
                    <h2 class="txtformulario "><?php echo $numero?></h2>
                </div>
                <div class="contformulario">
                    <h2 class="txtformulario"><?php echo $proy?></h2>
                </div>
                <div class="contformulario">
                    <h2 class="txtformulario"><?php echo $solic?></h2>
                </div>
                <div class="contbutton">
                <button type="submit"  onclick="editarFormulario(<?php echo $numeroFor?>)">Editar</button>
                </div>
            </section>
            <?php
            }
        }
    } 
    ?>
    </div>
    
    <footer class="footer">
        <p>Todos los derechos reservados © Grupo Nro 3</p>
    </footer>
</body>

<script>
    function editarFormulario(parametro) {
        console.log(parametro);
        window.location.href = 'editarFormulario.php?parametro=' + parametro;
    }
</script>
    
</html>