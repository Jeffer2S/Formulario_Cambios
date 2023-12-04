<?php
class Conexion
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function conectar()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        } else {
            // echo "conectado";
        }
    }

    public function obtenerConexion()
    {
        return $this->conn;
    }

    public function cerrarConexion()
    {
        $this->conn->close();
    }

    public function insertar($titulo_proye, $titulo_soli, $nro_soli, $nombre_soli, $cargo, $descripcion, $justificacion, $impacto, $estado_solicitud, $responsable, $comentarios, $prioridad, $recursos_n, $fecha)
    {
        $sql = "INSERT INTO `datos_formulario` (`tit_pro`, `tit_soli`, `nro_soli`, `nom_soli`, `car_soli`, `des_soli`, `jus_soli`, `imp_soli`, `est_soli`, `res_soli`, `com_soli`, `pri_soli`, `rec_nec_soli`, `fec_pro_soli`) VALUES ('$titulo_proye', '$titulo_soli', '$nro_soli', '$nombre_soli', '$cargo', '$descripcion', '$justificacion', '$impacto', '$estado_solicitud', '$responsable', '$comentarios', '$prioridad', '$recursos_n', '$fecha');";
        $resultado = $this->conn->query($sql);
        if ($resultado) {
            echo '<script>alert("Datos enviados correctamente.");</script>';
        } else {
            echo "Error al insertar datos: " . $this->conn->error;
        }
    }

    public function obtenerDatos()
    {
        $sql = "SELECT * FROM datos_formulario";
        $resultado = $this->conn->query($sql);
        $datos = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $datos[] = $row;
            }
        }
        return $datos;
    }
}
