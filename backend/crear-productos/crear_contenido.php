<?php 

    require("../conexion/conexion.php");
    $base = Conectar::conexion();

    if($_FILES["imagen"]["error"]){

        switch($_FILES["imagen"]["error"]){

            case 1: //error exceso de tamaño de archivo en php.ini
                echo "El tamaño del archivo excede lo permitido por el servidor";
                break;

            case 2: //error tamaño archivo marcado desde formulario
                echo "El tamaño del archivo excede 2 MB";
                break;

            case 3: //corrupcion de archivo
                echo "El envio de archivo se interrumpio";
                break;

            case 4: //no se subio ningun archivo
                echo "No se ha enviado ningun archivo";
                break;

        }

    }else{

        echo "Entrada subida correctamente<br>";
        //si no hay error:
        if((isset($_FILES["imagen"]["name"]) && ($_FILES["imagen"]["error"]==UPLOAD_ERR_OK))) {

            $destino_ruta = $_SERVER["DOCUMENT_ROOT"] . "/frontend-kiosko/WEB/assets/logos/";
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino_ruta . $_FILES["imagen"]["name"]);

            echo "El archivo " . $_FILES["imagen"]["name"] . " se ha copiado en el directorio de imagenes.";

        }else{

            echo "El archivo no se ha podido enviar al directorio de imagenes.";

        }

    }

    $nombre = $_POST["nombre_producto"];
    $fecha = date("Y-m-d H:i:s");
    $imagen = $_FILES["imagen"]["name"];

    $query = "INSERT INTO productoslogo (NOMBRE, FECHA, IMAGEN) VALUES ('" . $nombre . "','" . $fecha . "','" . $imagen . "')";
    $resultado = $base->prepare($query);
    $resultado->execute();

    echo "<br> Se ha agregado con exito.<br><br>";

    header("Location:../../WEB/inicio.html");
?>