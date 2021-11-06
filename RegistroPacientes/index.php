<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pacientes | Examen Final</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php


if (isset($_POST['action'])) {
    $id = $_POST["id"];

    try {
        $urlApi2="https://localhost:44322/api/persona/getPerson";

        $data = array('id' => $id);
        $json2 = json_encode($data);

        $protocols = array('https' => array(
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/json',
                            'content' => $json2),
                        'http' => array(
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/json',
                            'content' => $json2),
                        'ssl' => array(
                            'verify_peer'=>false,
                            'verify_peer_name'=>false,
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/json',
                            'content' =>  $json2)
                   );

        $context2  = stream_context_create($protocols);

        $string2 = @file_get_contents($urlApi2, false, $context2);

        if ($string2 != null) {
            $UserID = json_decode($string2, true);
        } else {
            echo "<script> alert('Algo ha fallado'); </script>";
            echo "<script> setTimeout(\"location.href='index.php'\",500) </script>";  
        }
    } catch (Exception $ex) {
        echo "<script> alert('Algo ha fallado'); </script>";
    }
}

?>

    <div class="contenedor" id="div1">
    <form action="" class="formulario" method="POST" id="formulario" name="formulario">
            <input type="hidden" id="action" name="action" class="btn" value="sent">
            <input type="submit" class="btn" value="Buscar">
            <input type="number" id="id" name="id" placeholder="ID (Solo para modificar y eliminar)">  
    </form>

        <form action="" class="formulario" method="POST" action="registra.php" id="formulario" name="formulario">
            <div class="contenedor-inputs">
                 <?php
                      if (!empty($id)) {
                          foreach ($UserID as $product2) {
                              ?>
                <input type="number" id="cui" name="cui" placeholder="Código Unico de Identificación" value=<?=$product2["cui"]?> >
                <input type="text" name="nombres" placeholder="Nombres" value=<?=$product2["nombresCompletos"]?> >
                <input type="text" name="apellidos" placeholder="Apellidos" value=<?=$product2["apellidosCompletos"]?> >
                <p>Fecha de Nacimiento</p>
                <input type="date" name="dateH" value=<?=$product2["fechaNacimiento"]?> > <br> <br>
                <input type="text" name="direccion" placeholder="Dirección" value=<?=$product2["direccion"]?>  >

                <input type="text" name="nombresP" placeholder="Nombre del Padre" value=<?=$product2["nombresPadre"]?> >
                <input type="text" name="nombresM" placeholder="Nombre de la Madre" value=<?=$product2["nombresMadre"]?> >
                <input type="email" name="correo" placeholder="Correo Electrónico" value=<?=$product2["correoElectronico"]?>  >
                <?php
                          }
                      }
                      else{
                          ?>
                <input type="number" id="cui" name="cui" placeholder="Código Unico de Identificación" required>
                <input type="text" name="nombres" placeholder="Nombres" required  >
                <input type="text" name="apellidos" placeholder="Apellidos"required  >
                <p>Fecha de Nacimiento</p>
                <input type="date" name="dateH" required > <br> <br>
                <input type="text" name="direccion" placeholder="Dirección" required >

                <input type="text" name="nombresP" placeholder="Nombre del Padre" required>
                <input type="text" name="nombresM" placeholder="Nombre de la Madre" required >
                <input type="email" name="correo" placeholder="Correo Electrónico" required  >
           
                         <?php
                      }
                         ?>
                <ul class="error" id="error"></ul>
            </div>
            <input type="submit" id="registro" class="btn" value="Registrarse"> <br>
            <input type="submit" class="btn" value="Modificar"><br>
            <input type="submit" class="btn" value="Eliminar">
        </form>
    </div>
    <div class="contenedor" id="div2">
        <div class="box">

            <form method="GET">
                <div class="box-header">
                    <h3 class="box-title">Registro Pacientes</h3>
                </div>
            </form>
            <!-- /.box-header -->
            <!-- 
                
            <?php 
             
              $urlApi="https://localhost:44322/api/persona/getListPersons";

             if (($string = @file_get_contents($urlApi, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))))) === false) {
                //  require_once("Controllers/Error500.php");

            } else {
                
            ?>
                 -->
            <div class="box-body table-responsive no-padding">
                <!-- <h3>No existe ningun registro.</h3> -->
            </div>
        
            <div class="box-body table-responsive no-padding">


                <table id="tablaRoles" class="table table-hover">
                    <thead>


                        <?php 
                               $urlApi="https://localhost:44300/api/tipoServicio/getListTipoServicio";
                  
                        ?>
                        <tr style="padding: 2px;">
                            <th style="text-align: center; padding-right: 15px;">ID</th>
                            <th style="text-align: center; padding-right: 15px;">CUI</th>
                            <th style="text-align: center; padding: 15px;">Nombres</th>
                            <th style="text-align: center; padding: 15px;">Apellidos</th>
                            <th style="text-align: center; padding: 15px;">Fecha de Nacimiento</th>
                            <th style="width:55%; text-align: center; padding: 15px;">Dirección</th>
                            <th style="text-align: center; padding: 15px;">Nombre del Padre</th>
                            <th style="text-align: center; padding: 15px;">Nombre de la Madre</th>
                            <th style="text-align: center; padding: 15px;">Correo Electrónico</th>
                            <th style="text-align: center; padding: 15px;">Estado</th>
                        </tr>
                    </thead>

                    <tbody id="cuerpo">
                    <?php
                        $json = json_decode($string, true);
                    
                        foreach ($json as $product) {
                    ?>
                        <tr>
                            <td style="text-align: center;">
                                <?=$product["id"]?>
                            </td>

                            <td style="text-align: center;">
                                <?=$product["cui"]?>
                            </td>
                            <td style=" padding: .8rem 2rem; text-align: center;">
                                <?=$product["nombresCompletos"]?>
                            </td>
                            <td style=" padding: .8rem 2rem; text-align: center;">
                                <?=$product["apellidosCompletos"]?>
                            </td>
                            <td style=" padding: .8rem 2rem; text-align: center;">
                                <?=$product["fechaNacimiento"]?>
                            </td>
                            <td style=" padding: .8rem 2rem; text-align: center;">
                                <?=$product["direccion"]?>
                            </td>
                            <td style=" padding: .8rem 2rem; text-align: center;">
                                <?=$product["nombresPadre"]?>
                            </td>
                            <td style=" padding: .8rem 2rem; text-align: center;">
                                <?=$product["nombresMadre"]?>
                            </td>
                            <td style="text-align: center;">
                                <?=$product["correoElectronico"]?>
                                
                            </td>

                            <td style="text-align: center;">
                                <?= $product["estado"] ? '<span >Activo</span>':'<span>Inactivo</span>' ?> </td>
                              
                        </tr>
                        <?php
                                   }
                             }
                         ?>

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->
    </div>


    <script src="js/validaciones.js"></script>
    
</body>

</html>