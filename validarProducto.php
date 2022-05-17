<?php
require_once("bdConect.php");
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}

//---------------------------validación de ingreso de datos del producto------------------------
$imgName = $_FILES['Imagen'];
$nameImg = $_FILES['Imagen']['name'];
$archivo = $_FILES['Imagen']['tmp_name'];
$ruta = "imagenesProd/".$nameImg;

// obtención de la ruta de la imagen
$obtencionImg = "SELECT * FROM tproductos WHERE Imagen = '$ruta'";
$valor=mysqli_query($conexion,$obtencionImg);
$longitud = mysqli_num_rows($valor);

if( 
    isset($_POST["stock"]) &&
    isset($_POST["nombreP"]) &&
    strlen($nameImg) > 0 && $longitud == 0 &&
    isset($_POST["marca"]) &&
    isset($_POST["contenido"]) &&
    isset($_POST["precio"]) &&
    isset($_POST["proveedor"]) 
){
    move_uploaded_file($archivo, $ruta);
    $conexion->query("INSERT INTO tinventarios( Stock ) 
    VALUES('".$_POST["stock"]."')");
    $conexion->query("INSERT INTO tproductos( NombreProducto, Imagen, Marca, Descripcion, Precio, TInventarios_id, TProveedores_id ) 
    VALUES(
        '".$_POST["nombreP"]."', 
        '$ruta', 
        '".$_POST["marca"]."', 
        '".$_POST["contenido"]."', 
        '".$_POST["precio"]."',
        ".$conexion->insert_id.",
        '".$_POST["proveedor"]."'
    )");
        include("regProducto.php");
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
}elseif($longitud==1){
    include("regProducto.phpl");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Esta Imagen ya Existe!'})
    </script>
<?php
}

else{
        include("regProducto.php");
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Fallo al ingresar los datos!'})
        </script>
    <?php
    }
mysqli_close($conexion);
?>