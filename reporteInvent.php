<?php 
require('fpdf/fpdf.php');
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}

class PDF extends FPDF{
// Cabecera de página
function Header(){
    date_default_timezone_set('America/Mexico_City');
    $FechaActual=date("d/m/Y");
    // Logo
    $this->Image('archivos/logoSpa.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(110);
    // Título
    $this->Cell(60,30,utf8_decode('Productos de Belleza Flores Spa'),0,0,'C');
    $this->SetFont('Arial','',15);
    
    $this->SetFont('Times','B',18);
    $this->Ln(10);
    $this->Cell(170,60,utf8_decode('Reporte de Inventario'),0,0,'R');
    $this->SetFont('Arial','B',12);
    $this->Cell(65,60,utf8_decode('Fecha:'),0,0,'R');
    $this->SetFont('Arial','I',12);
    $this->Cell(25,60,utf8_decode($FechaActual),0,0,'R');
    // Salto de línea
    $this->Ln(35);
    $this->SetFont('Arial','B',11);
    // Titulos de la tabla
    //$this->SetTextColor(220, 84, 36);
    $this->Cell(20, 10, 'Stock', 1, 0, 'C', 0);
    $this->Cell(85, 10, 'Producto', 1, 0, 'C', 0);
    $this->Cell(45, 10, 'Marca', 1, 0, 'C', 0);
    $this->Cell(85, 10, utf8_decode('Descripción'), 1, 0, 'C', 0);
    $this->Cell(25, 10, 'Precio', 1, 0, 'C', 0);
    $this->Ln(10);
}
// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
}
}
include("bdConect.php");
$consulta = $conexion->query("SELECT * FROM tproductos
LEFT JOIN tinventarios ON tproductos.TInventarios_id = tinventarios.id");  
//$consulta2 = $conexion->query("SELECT * FROM tproductos");
// Creación del objeto de la clase heredada
$pdf=new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
while ($row = $consulta->fetch_assoc()) {
$pdf->Cell(20, 10, $row['Stock'], 1, 0, 'C', 0);
$pdf->Cell(85, 10,utf8_decode("$row[NombreProducto]"), 1, 0, 'C', 0);
$pdf->Cell(45, 10,utf8_decode("$row[Marca]"), 1, 0, 'C', 0);
$pdf->Cell(85, 10,utf8_decode("$row[Descripcion]"), 1, 0, 'C', 0);
$pdf->Cell(25, 10, $row['Precio'], 1, 1, 'C', 0);
}
$pdf->Output();
?>