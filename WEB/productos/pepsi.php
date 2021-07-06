<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/logo-inferior/pepsii.png">
    <title>Pepsi | Kiosko</title>
    <link rel="stylesheet" href="../../WEB/assets/styles/styles.css">

    <style>
        a {
            list-style: none;
            text-decoration: none;
        }
    </style>

</head>
<body>

<?php 
    
    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    //ordenando todos los blogs (el mas reciente primero)
    $query = "SELECT * FROM producto_individual_pepsi ORDER BY LITROS DESC";
    $resultado = $base->prepare($query);
    $resultado->execute();
    $res = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>


    <header class="header">
        <h1>KIOSKITO</h1>
    </header>

    <nav class="menu">
        <ul>
            <li><a href="../inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="../productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="../compras.php" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../ventas.php" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>
    
    <div id="h1-productos">
        <a href="../../backend/insertar-producto-individual/formulario-producto-individual.php?nom=pepsi" style="list-style: none;"><button>Añadir producto</button></a>
    </div>


<?php 


    //ordenando todos los blogs (el mas reciente primero)
    $query = "SELECT * FROM producto_individual_pepsi ORDER BY LITROS DESC";
    $resultado = $base->prepare($query);
    $resultado->execute();
    $sentencia = $resultado->fetchAll(PDO::FETCH_OBJ);

?>


    <div class="productos-all">

    <?php
        foreach($sentencia as $datos) : ?>

  
        <div style='display: inline-block; height: 300px;'>
            <!-- imagen con el producto individual -->
            <a href='../../backend/ver-producto-individual/ver-producto-individual.php?ID=<?php echo $datos->ID ?> & nom=<?php echo $datos->NOMBRE ?>' class='cuadro-producto'><img id='imagen-productos' src='image-individual/<?php echo $datos->IMAGEN ?>'></a>
            <!-- botones de editar, eliminar, ver -->
            <div class='div-boton-producto-ind'>
            
            <script>
function hizoClick() {
      alert("Añadido a compras."); 
}
</script>
            <!-- boton añadir -->   
            <a href='../../WEB/compras/insertar_compra.php?ID<?php echo $datos->ID ?> & nombre=<?php echo $datos->NOMBRE ?>& litros=<?php echo $datos->LITROS ?>& total=<?php echo $datos->PRECIOventa ?>'>      
            <input type='button' value='Añadir' onclick="hizoClick()">
            </a>
            <!-- boton editar -->
            <a href='../../backend/editar-producto-individual/editar-producto-individual.php?ID=<?php echo $datos->ID ?> & nom=<?php echo $datos->NOMBRE?> & pcompra=<?php echo $datos->PRECIOcompra?> & pventa=<?php echo $datos->PRECIOventa?> & img=<?php echo $datos->IMAGEN?> & prov=<?php echo $datos->PROOVEDOR?> & litros=<?php echo $datos->LITROS?> & lineap=<?php echo $datos->LINEAproducto?>"'>   
            <input type='button' value='editar'>
            </a>
            <!-- boton eliminar -->
            <a href='../../backend/eliminar-producto-individual/eliminar_producto_individual.php?ID=<?php echo $datos->ID ?> & prov=<?php echo $datos->PROOVEDOR ?> & nom=<?php echo $datos->NOMBRE ?>'>      
            <input type='button' value='eliminar'>
            </a>
        
            </div>

        </div>



    <?php  endforeach;  ?>

    <!--while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){


        if($registro['IMAGEN']!=""){
            echo "<a href='#' class='cuadro-producto'><img id='imagen-productos' src='image-individual/" . $registro['IMAGEN'] . "'/>
            <a href='#'><input type='button' value='Editar'></a>" . 
            "<a href='eliminar_producto_individual.php'><input type='button' value='Eliminar'</a></a>";
            }

      
    }-->


    <!--<a href="#" class="cuadro-producto"><img src="../productos/images/coca-cola/coca cola 2,5.jpg" id="imagen-productos"><button>Editar</button><button>Eliminar</button></a>
    <a href="#" class="cuadro-producto"><img src="../productos/images/coca-cola/coca 2 litros.jpg" id="imagen-productos"><button>Editar</button><button>Eliminar</button></a>
    <a href="#" class="cuadro-producto"><img src="../productos/images/coca-cola/coca 1,5 litros.jpg" id="imagen-productos"><button>Editar</button><button>Eliminar</button></a>
    <a href="#" class="cuadro-producto"><img src="../productos/images/coca-cola/coca 1,25 litros.jpg" id="imagen-productos"><button>Editar</button><button>Eliminar</button></a>
    <a href="#" class="cuadro-producto"><img src="../productos/images/coca-cola/coca cola 1 litro.jpg" id="imagen-productos"><button>Editar</button><button>Eliminar</button></a>
    <a href="#" class="cuadro-producto"><img src="../productos/images/coca-cola/coca cola 500 ms.jpg" id="imagen-productos"><button>Editar</button><button>Eliminar</button></a>
    <a href="#" class="cuadro-producto"><img src="../productos/images/coca-cola/coca cola 350 ml.jpg" id="imagen-productos"><button>Editar</button><button>Eliminar</button></a>
    <a href="#" class="cuadro-producto"><img src="../productos/images/coca-cola/coca cola 310 ml.jpg" id="imagen-productos"><button>Editar</button><button>Eliminar</button></a>
    <a href="#" class="cuadro-producto"><img src="../productos/images/coca-cola/coca cola 220 ml.jpg" id="imagen-productos"><button>Editar</button><button>Eliminar</button></a>
    -->

    </div>

</body>
</html>