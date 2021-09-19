<?php 
$db_host="localhost";            
$db_name="san_sql";
$db_user="root";
$db_password="";

class Conectar {
    public static function conexion() {

        try{
            $conexion=new PDO("mysql:host=localhost;dbname=san_sql", "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET utf8");
        }catch(Exception $e){
            die("Error: " . $e->getMessage());
            echo "Linea del error: " . $e->getLine();
        }
        return $conexion;
    }
}  
    

    class Metodos {
        public static function insertar() {
            //llamando a la clase Conectar y al metodo conexion() de conexion.php
            $base = Conectar::conexion();
            //query sql
            $query = "INSERT INTO ventas (NOMBRE, TOTAL) VALUES ('pruebaPOO', 0)";
            //preparar la consulta sql
            $resulset = $base->prepare($query);
            //ejecutar la consulta
            $resulset->execute();
            //retornar el resultado
            return $resulset;
        }
    }

?>