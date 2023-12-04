<!DOCTYPE html>
<?php
if (isset($_GET['parametro'])) {
    $id = $_GET['parametro'];
    
    require 'conexion.php';
    $conexion = new Conexion("localhost", "root", "", "formulario");
    $conexion->conectar();
    $conn = $conexion->obtenerConexion();

    if ($conn) {
        $sql = "SELECT * FROM datos_formulario WHERE num_for = $id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = $result->fetch_assoc();
            $id = $row["num_for"];
            $tit_pro = $row["tit_pro"];
            $tit_soli = $row["tit_soli"];
            $num_soli = $row["nro_soli"];
            $nom_sol = $row["nom_soli"];
            $car_sol = $row["car_soli"];
            $des_sol = $row["des_soli"];
            $jus_sol = $row["jus_soli"];
            $imp_sol = $row["imp_soli"];
            $est_sol = $row["est_soli"];
            $res_sol = $row["res_soli"];
            $com_sol = $row["com_soli"];
            $pri_sol = $row["pri_soli"];
            $rec_sol = $row["rec_nec_soli"];
            $fec_sol = $row["fec_pro_soli"];
            ?>

            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Solicitud de Cambio</title>
                <link rel="stylesheet" href="./index.css">
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
                <div id="formulario-container">
                    <form action="update.php" method="post">
                        <h2>Solicitud de Cambio</h2>
                        <label for="titulo_proye">Titulo del Proyecto:</label>
                        <input type="text" id="titulo_proye" name="titulo_proye" value="<?php echo $tit_pro?>" required>

                        <div class="form-group">
                            <label for="titulo_soli">Título de la Solicitud:</label>
                            <input type="text" id="titulo_soli" name="titulo_soli" value="<?php echo $tit_soli?>" required>
                        </div>

                        <div class="form-group">
                            <label for="nro_soli">Nro de Solicitud:</label>
                            <input type="text" id="nro_soli" name="nro_soli" value="<?php echo $num_soli?>" pattern="[0-9]+" title="Ingrese solo números" disabled>
                        </div>            

                        <br></br>
                        <div class="form-group">
                            <label for="nombre_soli">Nombre del solicitante:</label>
                            <input type="text" id="nombre_soli" name="nombre_soli" onkeypress="soloLetras(event)" value="<?php echo $nom_sol?>" required>
                        </div>

                        <div class="form-group">
                            <label for="cargo">Cargo o Rol:</label>
                            <input type="text" id="cargo" name="cargo" value="<?php echo $car_sol?>" required>
                        </div>

                        <div class="descripcion jf">
                            <p>Descripción del cambio:</p>
                            <input type="text" id="descripcion" name="descripcion" value="<?php echo $des_sol?>" required>
                        </div>
                        <div class="justificacion jf">
                            <p>Justificación del cambio:</p>
                            <input type="text" id="justificacion" name="justificacion" value="<?php echo $jus_sol?>" required>
                        </div>
                        <div class="impacto jf">
                            <p>Impacto que tendra:</p>
                            <input type="text" id="impacto" name="impacto" value="<?php echo $imp_sol?>" required>
                        </div>

                        <label for="prioridad">Prioridad:</label>

                        <div>
                            <select name="prioridad" id="prioridad" required class="styled-select">
                                <option value="Alta" style="background-color: rgb(202, 26, 26); ">Alta</option>
                                <option value="Media" style="background-color: rgb(165, 87, 42); ">Media</option>
                                <option value="Baja" style="background-color: rgb(42, 165, 69); ">Baja</option>
                            </select>
                        </div>

                        <label for="recursos_n">Recursos Necesarios:</label>
                        <textarea id="recursos_n" name="recursos_n" rows="6" required><?php echo $rec_sol?></textarea>

                        <label for="fecha">Fecha propuesta:</label>
                        <input type="date" id="fecha" name="fecha" value= "<?php echo $fec_sol?>" required>

                        <label for="estado_solicitud">Estado del Cambio Solicitado:</label>
                        <select name="estado_solicitud" id="estado_solicitud" required class="styled-select">
                            <option value="pendiente" <?php if($est_sol == 'pendiente') echo 'selected'; ?>>Pendiente</option>
                            <option value="en proceso" <?php if($est_sol == 'en proceso') echo 'selected'; ?>>En Proceso</option>
                            <option value="aprobado" <?php if($est_sol == 'aprobado') echo 'selected'; ?>>Aprobado</option>
                            <option value="rechazado" <?php if($est_sol == 'rechazado') echo 'selected'; ?>>Rechazado</option>
                            <option value="implementado" <?php if($est_sol == 'implementado') echo 'selected'; ?>>Implementado</option>
                        </select>

                        <label for="responsable">Responsable de la Solicitud:</label>
                        <input type="text" id="responsable" name="responsable" onkeypress="soloLetras(event)" value="<?php echo $res_sol?>" required>

                        <label for="comentarios">Observaciones y Comentarios:</label>
                        <textarea id="comentarios" name="comentarios" rows="5" required><?php echo $com_sol?></textarea>

                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit">Enviar Solicitud</button>
                    </form>
                </div>

                <footer class="footer">
                    <p>Todos los derechos reservados © Grupo Nro 3</p>
                </footer>
            </body>

            <script>
                function soloLetras(event) {
                    var input = event.key;
                    var regex = /^[a-zA-Z\sñáéíóúÁÉÍÓÚ]+$/;
                    if (!regex.test(input)) {
                        event.preventDefault();
                    }
                }

                var input = document.getElementById('responsable');

                input.addEventListener('input', function () {
                    var textoIngresado = input.value;
                    var newTexto = '';

                    for (var i = 0; i < textoIngresado.length; i++) {
                        if (textoIngresado[i] === ' ') {
                            if (i === textoIngresado.length - 1 || textoIngresado[i + 1] !== ' ') {
                                newTexto += textoIngresado[i];
                            }
                        } else {
                            newTexto += textoIngresado[i];
                        }
                    }

                    input.value = newTexto;
                });

            </script>
            </html>
            <?php
        }
    }
} else {
}
?>
