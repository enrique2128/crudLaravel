<?php


namespace App\Models;


use PDO;
use PDOException;

class BD
{
    private $host;
    private $usuario;
    private $pass;
    private $conexion;

    public function __construct($host, $usuario, $pass)
    {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->pass = $pass;
    }

    function crearConexion()
    {
        define('DB_HOST', $this->host);
        define('DB_USER', $this->usuario);
        define('DB_PASS', $this->pass);
        define('DB_NAME', 'crud');
        // Ahora, establecemos la conexión.
        try {
            // Ejecutamos las variables y aplicamos UTF8
            $this->conexion = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            ?>
            <script>alert("Conexion a la bbdd correcta.")</script>
            <?php
        } catch (PDOException $e) {
            exit("Error: " . $e->getMessage());
        }
    }

    function consultaMostrarListadoDBs($sentencia)
    {
        $dbs = $this->conexion->query($sentencia);
        while (($db = $dbs->fetchColumn(0)) !== false) {
            echo '<input type="radio" value='.$db.' name="bd"><label>'.$db.'</label></br>';
        }
    }
}
