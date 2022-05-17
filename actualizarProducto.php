<?php 
include("bdConect.php");
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}

$nombre = $_FILES['Imagen2'];
$imgName =$_FILES['Imagen2']['name']; // Nombre de la imagen
$archivo =$_FILES['Imagen2']['tmp_name']; // Otra variable para el nombre del archivo.
$ruta ="imagenesProd/".$imgName; // Ruta de la carpeta.

$obtencionImg = "SELECT * FROM tproductos WHERE Imagen = '$ruta'";
$valor=mysqli_query($conexion,$obtencionImg);
$longitud = mysqli_num_rows($valor);

// Obtener ruta pero de la base de datos en caso de cambiar de imagen para eliminar la anterior imagen.
$query = "SELECT * FROM tproductos WHERE  id=".$_REQUEST['id']."";  
$resultado = $conexion->query($query);

error_reporting(0);
//---------------------------actualización de ingreso de datos de la producto------------------------
if (
    isset($_POST["stock"]) &&
    isset($_POST["nombreP"]) &&
    strlen($imgName) > 0 && $longitud == 0 &&
    isset($_POST["marca"]) &&
    isset($_POST["descripcion"]) &&
    isset($_POST["precio"]) &&
    sset($_POST["proveedor"])  
    ){
    move_uploaded_file($archivo, $ruta); // En archivo es lo que quiero mover y en ruta hacia donde lo quiero mover.
    
    while ($rt=$resultado->fetch_assoc()) {
        $rt["Imagen"]; /*aqui esta la ruta */
        $borrar=$rt["Imagen"];
        unlink($borrar);
    }

    $conexion->query("UPDATE tinventarios SET
        Stock = '".$_POST["stock"]."' 
        WHERE 
        id = ".$_REQUEST["ids"]." 
        ");

    $conexion->query("UPDATE tproductos SET
        NombreProducto = '".$_POST["nombreP"]."',
        Imagen =  '$ruta',
        Marca = '".$_POST["marca"]."',
        Descripcion = '".$_POST["descripcion"]."',
        Precio = '".$_POST["precio"]."',
        TInventarios_id = '".$_POST["idStock"]."',
        TProveedores_id = '".$_POST["proveedor"]."'
        WHERE 
        id = ".$_REQUEST["id"]." 
        ");
        mysqli_close($conexion);
        include("modificarProducto.php");
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
}elseif($longitud==1){
    include("modificarProducto.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Esta Imagen ya Existe!'})
    </script>
<?php
}
elseif (
    isset($_POST["stock"]) &&
    isset($_POST["nombreP"]) &&
    isset($_POST["imagen1"]) &&
    isset($_POST["marca"]) &&
    isset($_POST["descripcion"]) &&
    isset($_POST["precio"]) &&
    isset($_POST["proveedor"])  
    ){
    $conexion->query("UPDATE tinventarios SET
        Stock = '".$_POST["stock"]."' 
        WHERE 
        id = ".$_REQUEST["ids"]." 
        ");

    $conexion->query("UPDATE tproductos SET
        NombreProducto = '".$_POST["nombreP"]."',
        Imagen = '".$_POST["imagen1"]."',
        Marca = '".$_POST["marca"]."',
        Descripcion = '".$_POST["descripcion"]."',
        Precio = '".$_POST["precio"]."',
        TInventarios_id = '".$_POST["idStock"]."',
        TProveedores_id = '".$_POST["proveedor"]."'
        WHERE 
        id = ".$_REQUEST["id"]." 
        ");
        mysqli_close($conexion);
        include("modificarProducto.php");
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
    include("modificarProducto.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
        </script>
    <?php
}
?>