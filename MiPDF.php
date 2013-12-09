<?php
require_once('Classes/fpdf.php');

include_once('Session.php');
Session::init();


$idSol="";
if ($_REQUEST['id_sol']) {
	$idSol=$_REQUEST['id_sol'];	
}

$id=Session::get('id_usuario');
$user=Session::get('user');
$pass=Session::get('password');

$conexion=mysql_connect("localhost",$user,$pass);
try{
	mysql_select_db("controlservice",$conexion);
}catch(Exception $e ) {
	 echo "error con la coneccion " ;
	 exit();
}


// $con = conectaADO($user,$pass);
// $con ->SetFetchMode(ADODB_FETCH_ASSOC);
$query="";
if ($idSol) {
	$query="SELECT F.id AS 'folio' ,S.id , U.nombre , S.tipo , S.titulo , S.descripcion , F.fecha AS 'f_autorizada', S.fecha_origen , S.fecha_solicitada 
	, A.nombre as 'area'
	FROM usuario U
INNER JOIN solicitud S ON S.usuario_id=U.id
INNER JOIN folio F ON f.solicitud_id=S.id
INNER JOIN area A ON A.id=U.area_id
		WHERE S.id=$idSol";

		$rs=mysql_query("$query",$conexion);

		//$rs=$con->Execute($query);

		//$rs=$rs->FetchRow();
		if (!$rs) {
			echo "error con la consulta";
			exit();
		}



		$rs=mysql_fetch_array($rs);
		$pdf = new FPDF();
		class PDF extends FPDF
		{
			// Cabecera de página
			function Header()
			{
			    // Logo
			    $this->Image('images/iconosChicos/Logo_idea.png',10,8,33);
			    // Arial bold 15
			    global $title;

			    // Arial bold 15
			    $this->SetFont('Arial','B',15);
			    // Calculamos ancho y posición del título.
			    $w = $this->GetStringWidth($title)+6;
			    $this->SetX((210-$w)/2);
			    // Colores de los bordes, fondo y texto
			    $this->SetDrawColor(0,80,180);
			    $this->SetFillColor(250,0,1);
			    $this->SetTextColor(255,255,255);
			    // Ancho del borde (1 mm)
			    $this->SetLineWidth(.5);
			    // Título
			    $this->Cell($w,9,$title,1,1,'C',true);


			  
			}
			function ChapterTitle($num, $label)
			{
			    // Arial 12
			    $this->SetFont('Arial','',12);
			    // Color de fondo
			    $this->SetFillColor(250,0,1);
			    $this->SetTextColor(255,255,255);
			    // Título
			    $this->Cell(0,6,"$label",0,1,'L',true);
			    // Salto de línea
			    $this->Ln(4);
			}
			function ChapterBody($file)
			{
			    // Leemos el fichero
			    $txt = file_get_contents($file);
			    // Times 12
			    $this->SetFont('Times','',12);
			    // Imprimimos el texto justificado
			    $this->MultiCell(0,5,$txt);
			    // Salto de línea
			    $this->Ln();
			    // Cita en itálica
			    $this->SetFont('','I');
			    $this->Cell(0,5,'(fin del extracto)');
			}

			function PrintChapter($num, $title, $file)
			{
			    $this->AddPage();
			    $this->ChapterTitle($num,$title);
			    $this->ChapterBody($file);
			}

			// Pie de página
			function Footer()
			{
			    // Posición: a 1,5 cm del final
			    $this->SetY(-15);
			    // Arial italic 8
			    $this->SetFont('Arial','I',8);
			    // Número de página
			     $this->SetTextColor(128);
			    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			}
		}

		// Creación del objeto de la clase heredada
		$pdf = new PDF();
		$title = 'Control de Solicitud';
		$pdf->SetTitle($title);
		  
		

		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->Ln(28);

	
		
		$pdf->SetAuthor('Idea Interior');
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(0,10,'folio: '. $rs['folio'] .' ',0,0,'R');

		$pdf->Ln(8);
	
		
		 //$pdf->Cell(0,10,'Titulo: '. $rs['titulo'],0,1);
		 $pdf->SetFont('Times','',12);
		 $pdf->ChapterTitle("","Titulo :" . $rs['titulo']);
		 $pdf->SetTextColor(0,0,0);
		 $pdf->MultiCell(0,5, "Descripción  : ". $rs['descripcion'] ,1);

				// $pdf->Cell(0,10,'Descripción : '. $rs['descripcion'],0,1);
		 $pdf->Cell(0,10,'Fecha Autorizada : '. $rs['f_autorizada'],0,1);
		 $pdf->Cell(0,10,'Fecha Origen : '. $rs['fecha_origen'],0,1);
		 $pdf->Cell(0,10,'Fecha Solicitada : '. $rs['fecha_solicitada'],0,1);
		 $pdf->Cell(0,10,'Solicitada por  : '. $rs['nombre'],0,1);
		 $pdf->Cell(0,10,'Del Area  : '. $rs['area'],0,1);
		 $pdf->Cell(0,10,'Autorizada por  : '. $user,0,1);
		 $pdf->Cell(0,10,'      ',0,1);
		 $pdf->Cell(0,10,'______________________',0,1,'C');

		 $pdf->Cell(0,10,'firma  autoriza '. $user,0,1,'C');
		 $pdf->Cell(0,10,'      ',0,1);
		 $pdf->Cell(0,10,'      ',0,1);
		 
		 $pdf->Cell(0,10,'______________________',0,1,'C');
		 $pdf->Cell(0,10,'firma Solicitante',0,1,'C');


		$pdf->Output();
        
}

?>