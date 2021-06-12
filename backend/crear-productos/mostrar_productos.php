<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Blog</h2>
    <hr>

    <?php 
    
    require("../conexion/conexion.php");
    $base = Conectar::conexion();

    //ordenando todos los blogs (el mas reciente primero)
    $query = "SELECT * FROM productoslogo ORDER BY FECHA DESC";
    $resultado = $base->prepare($query);
    $resultado->execute(array());

    while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){

        echo "<h3>" . $registro['NOMBRE'] . "</h3>";
        echo "<h4>" . $registro['FECHA'] . "</h4>";
        
        if($registro['IMAGEN']!=""){
            echo "<img src='../../WEB/assets/logos/" . $registro['IMAGEN'] . "' width='300px' />";
        }

        echo "<hr/>";
    }

    ?>
    
</body>
</html>