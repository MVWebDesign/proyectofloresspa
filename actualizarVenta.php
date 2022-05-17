<?php 
include("bdConect.php");
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
$fecha = $_POST['fechaV1'];
$fecha2 = $_POST['fechaV2'];
//error_reporting(0);

//---------------------------actualización de ingreso de datos de la venta-----------------------
$est = $_POST["estado2"];
$variable = $_POST["estado"];
$estado1 = "En Espera"; $estado2 = "Cancelado"; $estado3 = "Vendido"; $estado4 = "Cambio de Articulo";
switch ($variable) {
    case $estado1:
        if ($est == $estado2) {
            include("ventas.php");
        ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Esta Venta ya ha sido cancelada por lo que no se pueden hacer modificaciones!'})
            </script>
        <?php
        }elseif ($est == $estado4) {
            include("ventas.php");
        ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'No podemos hacer más modificaciones solo se permite hacer un cambio de articulo por venta!'})
            </script>
        <?php
        }
        elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha2) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) && $est == $estado3 &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
            $idStock = $_POST["producto"];
            $consulta = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock'");
            while ($row = $consulta->fetch_array()) {
                $sumar = $row["Stock"] + $_POST["cantidad2"];
                $conexion->query("UPDATE tinventarios SET
                Stock = '$sumar'
                WHERE 
                id = '$idStock'
            ");
            }
            $idTicket = $_POST["numFactura"];
            $consulta = $conexion->query("SELECT * FROM tfacturas WHERE id = '$idTicket'");
            while ($row = $consulta->fetch_array()) {
                $restar = $row["GananciaTotal"] - $_POST["monto2"];
                $conexion->query("UPDATE tfacturas SET
                GananciaTotal = '$restar'
                WHERE 
                id = '$idTicket'
            ");
            }
            $conexion->query("UPDATE tventas SET
                Cantidad = '".$_POST["cantidad"]."',
                TipoPago = '".$_POST["tipoPago"]."',
                Fecha = '$fecha2',
                CantidadPago = '".$_POST["monto"]."',
                Estado = '".$_POST["estado"]."',
                TClientes_id = '".$_POST["cliente"]."',
                TProductos_id = '".$_POST["producto"]."',
                TFacturas_id = '".$_POST["numFactura"]."',
                TAdministradores_id = '".$_POST["admin"]."'
                WHERE 
                id = ".$_REQUEST["id"]." 
                ");
                mysqli_close($conexion);
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Actualizados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) && $est == $estado3 &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
            $idStock = $_POST["producto"];
            $consulta = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock'");
            while ($row = $consulta->fetch_array()) {
                $sumar = $row["Stock"] + $_POST["cantidad2"];
                $conexion->query("UPDATE tinventarios SET
                Stock = '$sumar'
                WHERE 
                id = '$idStock'
            ");
            }
            $idTicket = $_POST["numFactura"];
            $consulta = $conexion->query("SELECT * FROM tfacturas WHERE id = '$idTicket'");
            while ($row = $consulta->fetch_array()) {
                $restar = $row["GananciaTotal"] - $_POST["monto2"];
                $conexion->query("UPDATE tfacturas SET
                GananciaTotal = '$restar'
                WHERE 
                id = '$idTicket'
            ");
            }
            $conexion->query("UPDATE tventas SET
                Cantidad = '".$_POST["cantidad"]."',
                TipoPago = '".$_POST["tipoPago"]."',
                Fecha = '$fecha',
                CantidadPago = '".$_POST["monto"]."',
                Estado = '".$_POST["estado"]."',
                TClientes_id = '".$_POST["cliente"]."',
                TProductos_id = '".$_POST["producto"]."',
                TFacturas_id = '".$_POST["numFactura"]."',
                TAdministradores_id = '".$_POST["admin"]."'
                WHERE 
                id = ".$_REQUEST["id"]." 
                ");
                mysqli_close($conexion);
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Actualizados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha2) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
            $conexion->query("UPDATE tventas SET
                Cantidad = '".$_POST["cantidad"]."',
                TipoPago = '".$_POST["tipoPago"]."',
                Fecha = '$fecha2',
                CantidadPago = '".$_POST["monto"]."',
                Estado = '".$_POST["estado"]."',
                TClientes_id = '".$_POST["cliente"]."',
                TProductos_id = '".$_POST["producto"]."',
                TFacturas_id = '".$_POST["numFactura"]."',
                TAdministradores_id = '".$_POST["admin"]."'
                WHERE 
                id = ".$_REQUEST["id"]." 
                ");
                mysqli_close($conexion);
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Actualizados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
            $conexion->query("UPDATE tventas SET
                Cantidad = '".$_POST["cantidad"]."',
                TipoPago = '".$_POST["tipoPago"]."',
                Fecha = '$fecha',
                CantidadPago = '".$_POST["monto"]."',
                Estado = '".$_POST["estado"]."',
                TClientes_id = '".$_POST["cliente"]."',
                TProductos_id = '".$_POST["producto"]."',
                TFacturas_id = '".$_POST["numFactura"]."',
                TAdministradores_id = '".$_POST["admin"]."'
                WHERE 
                id = ".$_REQUEST["id"]." 
                ");
                mysqli_close($conexion);
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Actualizados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }else{
            mysqli_close($conexion);
            include("ventas.php");
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
                </script>
            <?php
        }
        break;
    case $estado2:
        if ($est == $estado2) {
            include("ventas.php");
        ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Esta venta ya ha sido cancelada previamente!'})
            </script>
        <?php
        }elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha2) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) && $est == $estado3 &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
            $idStock = $_POST["producto"];
            $consulta = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock'");
            while ($row = $consulta->fetch_array()) {
                $sumar = $row["Stock"] + $_POST["cantidad2"];
                $conexion->query("UPDATE tinventarios SET
                Stock = '$sumar'
                WHERE 
                id = '$idStock'
            ");
            }
            $idTicket = $_POST["numFactura"];
            $consulta = $conexion->query("SELECT * FROM tfacturas WHERE id = '$idTicket'");
            while ($row = $consulta->fetch_array()) {
                $restar = $row["GananciaTotal"] - $_POST["monto2"];
                $conexion->query("UPDATE tfacturas SET
                GananciaTotal = '$restar'
                WHERE 
                id = '$idTicket'
            ");
            }
            $conexion->query("UPDATE tventas SET
                Cantidad = '".$_POST["cantidad"]."',
                TipoPago = '".$_POST["tipoPago"]."',
                Fecha = '$fecha2',
                CantidadPago = '".$_POST["monto"]."',
                Estado = '".$_POST["estado"]."',
                TClientes_id = '".$_POST["cliente"]."',
                TProductos_id = '".$_POST["producto"]."',
                TFacturas_id = '".$_POST["numFactura"]."',
                TAdministradores_id = '".$_POST["admin"]."'
                WHERE 
                id = ".$_REQUEST["id"]." 
                ");
                mysqli_close($conexion);
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Actualizados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) && $est == $estado3 &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
            $idStock = $_POST["producto"];
            $consulta = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock'");
            while ($row = $consulta->fetch_array()) {
                $sumar = $row["Stock"] + $_POST["cantidad2"];
                $conexion->query("UPDATE tinventarios SET
                Stock = '$sumar'
                WHERE 
                id = '$idStock'
            ");
            }
            $idTicket = $_POST["numFactura"];
            $consulta = $conexion->query("SELECT * FROM tfacturas WHERE id = '$idTicket'");
            while ($row = $consulta->fetch_array()) {
                $restar = $row["GananciaTotal"] - $_POST["monto2"];
                $conexion->query("UPDATE tfacturas SET
                GananciaTotal = '$restar'
                WHERE 
                id = '$idTicket'
            ");
            }
            $conexion->query("UPDATE tventas SET
                Cantidad = '".$_POST["cantidad"]."',
                TipoPago = '".$_POST["tipoPago"]."',
                Fecha = '$fecha',
                CantidadPago = '".$_POST["monto"]."',
                Estado = '".$_POST["estado"]."',
                TClientes_id = '".$_POST["cliente"]."',
                TProductos_id = '".$_POST["producto"]."',
                TFacturas_id = '".$_POST["numFactura"]."',
                TAdministradores_id = '".$_POST["admin"]."'
                WHERE 
                id = ".$_REQUEST["id"]." 
                ");
                mysqli_close($conexion);
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Actualizados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha2) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
            $conexion->query("UPDATE tventas SET
                Cantidad = '".$_POST["cantidad"]."',
                TipoPago = '".$_POST["tipoPago"]."',
                Fecha = '$fecha2',
                CantidadPago = '".$_POST["monto"]."',
                Estado = '".$_POST["estado"]."',
                TClientes_id = '".$_POST["cliente"]."',
                TProductos_id = '".$_POST["producto"]."',
                TFacturas_id = '".$_POST["numFactura"]."',
                TAdministradores_id = '".$_POST["admin"]."'
                WHERE 
                id = ".$_REQUEST["id"]." 
                ");
                mysqli_close($conexion);
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Actualizados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
            $conexion->query("UPDATE tventas SET
                Cantidad = '".$_POST["cantidad"]."',
                TipoPago = '".$_POST["tipoPago"]."',
                Fecha = '$fecha',
                CantidadPago = '".$_POST["monto"]."',
                Estado = '".$_POST["estado"]."',
                TClientes_id = '".$_POST["cliente"]."',
                TProductos_id = '".$_POST["producto"]."',
                TFacturas_id = '".$_POST["numFactura"]."',
                TAdministradores_id = '".$_POST["admin"]."'
                WHERE 
                id = ".$_REQUEST["id"]." 
                ");
                mysqli_close($conexion);
                include("ventas.php");
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Datos Actualizados Correctamente!',
                    showConfirmButton: false,
                    timer: 1500})
                </script>
                <?php
        }else{
            mysqli_close($conexion);
            include("ventas.php");
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
                </script>
            <?php
        }
        break;
    case $estado3:
        if ($est == $estado2) {
            include("ventas.php");
        ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Esta Venta ya ha sido cancelada por lo que no se pueden hacer modificaciones!'})
            </script>
        <?php
        }elseif ($est == $estado4) {
            include("ventas.php");
        ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'No podemos hacer más modificaciones solo se permite hacer un cambio de articulo por venta!'})
            </script>
        <?php
        }elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha2) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) && 
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
            $idStock = $_POST["producto"];
            $consulta = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock'");
            $idTicket = $_POST["numFactura"];
            $consulta2 = $conexion->query("SELECT * FROM tfacturas WHERE id = '$idTicket'");
            while ($row = $consulta->fetch_array() + $row2 = $consulta2->fetch_array() ) {
                $restar = $row["Stock"] - $_POST["cantidad"];
                $sumar = $row2["GananciaTotal"] + $_POST["monto"];
                $almacen = $row["Stock"];
                $tam = $_POST["cantidad"];
                if ($almacen > 0 && $tam > 0 && $tam <= $almacen) {
                    $conexion->query("UPDATE tinventarios SET
                    Stock = '$restar'
                    WHERE 
                    id = '$idStock'");

                    $conexion->query("UPDATE tfacturas SET
                    GananciaTotal = '$sumar'
                    WHERE 
                    id = '$idTicket'");

                    $conexion->query("UPDATE tventas SET
                    Cantidad = '".$_POST["cantidad"]."',
                    TipoPago = '".$_POST["tipoPago"]."',
                    Fecha = '$fecha2',
                    CantidadPago = '".$_POST["monto"]."',
                    Estado = '".$_POST["estado"]."',
                    TClientes_id = '".$_POST["cliente"]."',
                    TProductos_id = '".$_POST["producto"]."',
                    TFacturas_id = '".$_POST["numFactura"]."',
                    TAdministradores_id = '".$_POST["admin"]."'
                    WHERE 
                    id = ".$_REQUEST["id"]." 
                    ");
                    mysqli_close($conexion);
                    include("ventas.php");
                    ?>
                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Datos Actualizados Correctamente!',
                        showConfirmButton: false,
                        timer: 1500})
                    </script>
                    <?php
                }else{
                    include("ventas.php");
                    ?>
                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'No hay suficiente Stock!'})
                    </script>
                    <?php
                }
            } 
        }elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
                $idStock = $_POST["producto"];
                $consulta = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock'");
                $idTicket = $_POST["numFactura"];
                $consulta2 = $conexion->query("SELECT * FROM tfacturas WHERE id = '$idTicket'");
                while ($row = $consulta->fetch_array() + $row2 = $consulta2->fetch_array() ) {
                    $restar = $row["Stock"] - $_POST["cantidad"];
                    $sumar = $row2["GananciaTotal"] + $_POST["monto"];
                    $almacen = $row["Stock"];
                    $tam = $_POST["cantidad"];
                    if ($almacen > 0 && $tam > 0 && $tam <= $almacen) {
                        $conexion->query("UPDATE tinventarios SET
                        Stock = '$restar'
                        WHERE 
                        id = '$idStock'");
    
                        $conexion->query("UPDATE tfacturas SET
                        GananciaTotal = '$sumar'
                        WHERE 
                        id = '$idTicket'");
    
                        $conexion->query("UPDATE tventas SET
                        Cantidad = '".$_POST["cantidad"]."',
                        TipoPago = '".$_POST["tipoPago"]."',
                        Fecha = '$fecha',
                        CantidadPago = '".$_POST["monto"]."',
                        Estado = '".$_POST["estado"]."',
                        TClientes_id = '".$_POST["cliente"]."',
                        TProductos_id = '".$_POST["producto"]."',
                        TFacturas_id = '".$_POST["numFactura"]."',
                        TAdministradores_id = '".$_POST["admin"]."'
                        WHERE 
                        id = ".$_REQUEST["id"]." 
                        ");
                        mysqli_close($conexion);
                        include("ventas.php");
                        ?>
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Datos Actualizados Correctamente!',
                            showConfirmButton: false,
                            timer: 1500})
                        </script>
                        <?php
                    }else{
                        include("ventas.php");
                        ?>
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                        Swal.fire({ icon: 'error', title: 'Oops...', text: 'No hay suficiente Stock!'})
                        </script>
                        <?php
                    }
                }
        }else{
            mysqli_close($conexion);
            include("ventas.php");
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
                </script>
            <?php
        }
        break;
    case $estado4:
        if ($est == $estado2) {
            include("ventas.php");
        ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Esta Venta ya ha sido cancelada por lo que no se pueden hacer modificaciones!'})
            </script>
        <?php
        }elseif ($est == $estado4) {
            include("ventas.php");
        ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'No podemos hacer más modificaciones solo se permite hacer un cambio de articulo por venta!'})
            </script>
        <?php
        }
        elseif (
            isset($_POST["cantidad"]) &&
            isset($_POST["tipoPago"]) &&
            strlen($fecha2) > 0 &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) && $est == $estado3 &&
            isset($_POST["cliente"]) &&
            isset($_POST["producto"]) &&
            isset($_POST["producto2"]) &&
            isset($_POST["admin"]) &&
            isset($_POST["numFactura"])
            ){
                $idStock = $_POST["producto"];
                $consulta = $conexion->query("SELECT * FROM tproductos WHERE id = '$idStock'");
                $consulta5 = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock'");

                $idStock2 = $_POST["producto2"];
                $consulta4 = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock2'");
                $consulta3 = $conexion->query("SELECT * FROM tproductos WHERE id = '$idStock2'");

                $idTicket = $_POST["numFactura"];
                $consulta2 = $conexion->query("SELECT * FROM tfacturas WHERE id = '$idTicket'");
                while ($row = $consulta->fetch_array() + $row2 = $consulta2->fetch_array() + $row3 = $consulta3->fetch_array() + $row4 = $consulta4->fetch_array() + $row5 = $consulta5->fetch_array() ) {
                    //Verificación general para el cambio de articulo
                    $noProd = $row["Precio"];
                    $noProd2 = $row3["Precio"];

                    $nom = $row["NombreProducto"];
                    $nom2 = $row3["NombreProducto"];

                    $almacen = $row5["Stock"];
                    $tam = $_POST["cantidad"];

                    $agregar = $row4["Stock"] + $tam;
                    $restar = $row5["Stock"] - $tam;

                    if ($noProd == $noProd2 && $nom != $nom2 ) {
                        if ($almacen > 0 && $tam > 0 && $tam <= $almacen) {
                            $conexion->query("UPDATE tinventarios SET
                            Stock = '$agregar'
                            WHERE 
                            id = '$idStock2'");

                            $conexion->query("UPDATE tinventarios SET
                            Stock = '$restar'
                            WHERE 
                            id = '$idStock'");

                            $conexion->query("UPDATE tventas SET
                            Cantidad = '".$_POST["cantidad"]."',
                            TipoPago = '".$_POST["tipoPago"]."',
                            Fecha = '$fecha2',
                            CantidadPago = '".$_POST["monto"]."',
                            Estado = '".$_POST["estado"]."',
                            TClientes_id = '".$_POST["cliente"]."',
                            TProductos_id = '".$_POST["producto"]."',
                            TFacturas_id = '".$_POST["numFactura"]."',
                            TAdministradores_id = '".$_POST["admin"]."'
                            WHERE 
                            id = ".$_REQUEST["id"]." 
                            ");
                            mysqli_close($conexion);
                            include("ventas.php");
                            ?>
                            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Articulo intercambiado correctamente!',
                                showConfirmButton: false,
                                timer: 1500})
                            </script>
                            <?php
                        }else{
                            include("ventas.php");
                            ?>
                            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                            Swal.fire({ icon: 'error', title: 'Oops...', text: 'No hay suficiente Stock para cambiar el articulo!'})
                            </script>
                            <?php
                        }
                    }else{
                        include("ventas.php");
                            ?>
                            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                            Swal.fire({ icon: 'error', title: 'Oops...', text: 'El precio de ambos productos no coinciden para llevar a cabo el cambio o el articulo es el mismo que el anterior!'})
                            </script>
                            <?php
                    }
                } 
            }elseif (
                isset($_POST["cantidad"]) &&
                isset($_POST["tipoPago"]) &&
                strlen($fecha) > 0 &&
                isset($_POST["monto"]) &&
                isset($_POST["estado"]) && $est == $estado3 &&
                isset($_POST["cliente"]) &&
                isset($_POST["producto"]) &&
                isset($_POST["producto2"]) &&
                isset($_POST["admin"]) &&
                isset($_POST["numFactura"])
                ){
                    $idStock = $_POST["producto"];
                    $consulta = $conexion->query("SELECT * FROM tproductos WHERE id = '$idStock'");
                    $consulta5 = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock'");
    
                    $idStock2 = $_POST["producto2"];
                    $consulta4 = $conexion->query("SELECT * FROM tinventarios WHERE id = '$idStock2'");
                    $consulta3 = $conexion->query("SELECT * FROM tproductos WHERE id = '$idStock2'");
    
                    $idTicket = $_POST["numFactura"];
                    $consulta2 = $conexion->query("SELECT * FROM tfacturas WHERE id = '$idTicket'");
                    while ($row = $consulta->fetch_array() + $row2 = $consulta2->fetch_array() + $row3 = $consulta3->fetch_array() + $row4 = $consulta4->fetch_array() + $row5 = $consulta5->fetch_array() ) {
                        //Verificación general para el cambio de articulo
                        $noProd = $row["Precio"];
                        $noProd2 = $row3["Precio"];
    
                        $nom = $row["NombreProducto"];
                        $nom2 = $row3["NombreProducto"];
    
                        $almacen = $row5["Stock"];
                        $tam = $_POST["cantidad"];
    
                        $agregar = $row4["Stock"] + $tam;
                        $restar = $row5["Stock"] - $tam;
    
                        if ($noProd == $noProd2 && $nom != $nom2 ) {
                            if ($almacen > 0 && $tam > 0 && $tam <= $almacen) {
                                $conexion->query("UPDATE tinventarios SET
                                Stock = '$agregar'
                                WHERE 
                                id = '$idStock2'");
    
                                $conexion->query("UPDATE tinventarios SET
                                Stock = '$restar'
                                WHERE 
                                id = '$idStock'");
    
                                $conexion->query("UPDATE tventas SET
                                Cantidad = '".$_POST["cantidad"]."',
                                TipoPago = '".$_POST["tipoPago"]."',
                                Fecha = '$fecha2',
                                CantidadPago = '".$_POST["monto"]."',
                                Estado = '".$_POST["estado"]."',
                                TClientes_id = '".$_POST["cliente"]."',
                                TProductos_id = '".$_POST["producto"]."',
                                TFacturas_id = '".$_POST["numFactura"]."',
                                TAdministradores_id = '".$_POST["admin"]."'
                                WHERE 
                                id = ".$_REQUEST["id"]." 
                                ");
                                mysqli_close($conexion);
                                include("ventas.php");
                                ?>
                                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Articulo intercambiado correctamente!',
                                    showConfirmButton: false,
                                    timer: 1500})
                                </script>
                                <?php
                            }else{
                                include("ventas.php");
                                ?>
                                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                Swal.fire({ icon: 'error', title: 'Oops...', text: 'No hay suficiente Stock para cambiar el articulo!'})
                                </script>
                                <?php
                            }
                        }else{
                            include("ventas.php");
                                ?>
                                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                Swal.fire({ icon: 'error', title: 'Oops...', text: 'El precio de ambos productos no coinciden para llevar a cabo el cambio o el articulo es el mismo que el anterior!'})
                                </script>
                                <?php
                        }
                    } 
                }else{
            mysqli_close($conexion);
            include("ventas.php");
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
                </script>
            <?php
        }
    break;
}
?>