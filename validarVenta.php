<?php
require_once("bdConect.php");
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
//---------------------------validación de ingreso de datos de la venta------------------------
$estado = $_POST["estado"];
switch ($estado) {
    case "Espera":
        if( 
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            isset($_POST["fechaV"]) &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["numFactura"]) &&
            isset($_POST["admin"])
            
        ){
            $estado = "En Espera";
            $conexion->query("INSERT INTO tventas( Cantidad, TipoPago, Fecha, CantidadPago, Estado, TClientes_id, TProductos_id, TFacturas_id, TAdministradores_id ) 
            VALUES(
                    '".$_POST["cantidad"]."',
                    '".$_POST["tipoPago"]."',
                    '".$_POST["fechaV"]."',
                    '".$_POST["monto"]."',
                    '$estado',
                    '".$_POST["cliente"]."',
                    '".$_POST["producto"]."',
                    '".$_POST["numFactura"]."',
                    '".$_POST["admin"]."'
                    
                )");
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Ingresados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }else{
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Fallo al ingresar los datos!'})
                </script>
            <?php
            }
        mysqli_close($conexion);
        
    break;
    case "Cancelado":
        if( 
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            isset($_POST["fechaV"]) &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["numFactura"]) &&
            isset($_POST["admin"])
            
        ){
            $estado = "Cancelado";
            $conexion->query("INSERT INTO tventas( Cantidad, TipoPago, Fecha, CantidadPago, Estado, TClientes_id, TProductos_id, TFacturas_id, TAdministradores_id ) 
            VALUES(
                    '".$_POST["cantidad"]."',
                    '".$_POST["tipoPago"]."',
                    '".$_POST["fechaV"]."',
                    '".$_POST["monto"]."',
                    '$estado',
                    '".$_POST["cliente"]."',
                    '".$_POST["producto"]."',
                    '".$_POST["numFactura"]."',
                    '".$_POST["admin"]."'
                    
                )");
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Ingresados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }else{
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Fallo al ingresar los datos!'})
                </script>
            <?php
            }
        mysqli_close($conexion);
        
    break;
    case "Vendido":
        $estado = "Vendido";
        if( 
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            isset($_POST["fechaV"]) &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["numFactura"]) &&
            isset($_POST["admin"])
            
        ){
            $estado = "Vendido";
            $valorStock = $_POST["producto"];
            $consulta = $conexion->query("SELECT * FROM tinventarios WHERE id = '$valorStock'");
            while ($row = $consulta->fetch_array()) {
                $restar = $row["Stock"] - $_POST["cantidad"];
                $conexion->query("UPDATE tinventarios SET
                Stock = '$restar'
                WHERE 
                id = '$valorStock'
            ");
            }

            $ticket = $_POST["numFactura"];
            $consulta = $conexion->query("SELECT * FROM tfacturas WHERE id = '$ticket'");
            while ($row = $consulta->fetch_array()) {
                $sumar = $row["GananciaTotal"] + $_POST["monto"];
                $conexion->query("UPDATE tfacturas SET
                GananciaTotal = '$sumar'
                WHERE 
                id = '$ticket'
            ");
            }

            $conexion->query("INSERT INTO tventas( Cantidad, TipoPago, Fecha, CantidadPago, Estado, TClientes_id, TProductos_id, TFacturas_id, TAdministradores_id ) 
            VALUES(
                    '".$_POST["cantidad"]."',
                    '".$_POST["tipoPago"]."',
                    '".$_POST["fechaV"]."',
                    '".$_POST["monto"]."',
                    '$estado',
                    '".$_POST["cliente"]."',
                    '".$_POST["producto"]."',
                    '".$_POST["numFactura"]."',
                    '".$_POST["admin"]."'
                    
                )");
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Ingresados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }else{
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Fallo al ingresar los datos!'})
                </script>
            <?php
            }
        mysqli_close($conexion);
        
    break;
    case "Cambio":
        $estado = "Cambio";
        if (isset($_POST["estado"]) == '$estado') {
            include("ventas.php");
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'El ticket debe estar vendido para poder hacer cambio de articulo! Favor de ingresar los datos nuevamente!'})
        </script>
        <?php
        }else{
            echo "fallaste papu :c";
        }
    break;
}
?>