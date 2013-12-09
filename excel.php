<?php 
// Clases Php
require_once 'Classes/PHPExcel.php';
require_once("Classes/PHPExcel/Reader/Excel2007.php");

		$objPHPExcel = new PHPExcel();
		// Establecer propiedades
		$objPHPExcel->getProperties()
		->setCreator("Sergio")
		->setLastModifiedBy("Sergio")
		->setTitle("Documento Excel ")
		->setSubject("Documento Excel ")
		->setDescription("Solicitudes aceptadas.")
		->setKeywords("Excel Office 2007 openxml php")
		->setCategory("Archivo Excel");

		//Extraemos los registros de la base de datos mysql
		$conexion = mysql_connect("localhost", "sergio", "2274");
		mysql_select_db("controlservice",$conexion);
		//$sql="SELECT  * FROM usuario";
		$sql=" SELECT U.nombre AS 'usuario', A.nombre AS 'area', SU.nombre AS 'sucursal' , T.nombre AS 'TipoSolicitud' ,S.titulo AS 'titulo' , S.descripcion AS 'Descripcion' ,S.id, S.fecha_solicitada , F.fecha AS 'fechaAutorizada' ,F.id AS 'folio'  FROM folio F INNER JOIN solicitud S ON S.id=F.solicitud_id  	INNER JOIN tipo T ON T.id=S.tipo  INNER JOIN usuario U ON U.id=S.usuario_id INNER JOIN controlservice.area A ON A.id=U.area_id  INNER JOIN sucursal AS SU ON SU.id=U.sucursal_id ";
		$rst=mysql_query($sql,$conexion); //Ejecutamos la SQL
		if(!$rst) //Comprobamos si hay errores
		die("Error MySQL de Extracción de Datos");


		$i=1;
			$objPHPExcel->getActiveSheet()->setCellValue("A".$i,"Nombre Usuario");
			$objPHPExcel->getActiveSheet()->setCellValue("B".$i, "Area");
			$objPHPExcel->getActiveSheet()->setCellValue("C".$i, "sucursal");

			$objPHPExcel->getActiveSheet()->setCellValue("D".$i,"Tipo Solicitud");
			$objPHPExcel->getActiveSheet()->setCellValue("E".$i, "Titulo");
			$objPHPExcel->getActiveSheet()->setCellValue("F".$i, "Descripcion");

			$objPHPExcel->getActiveSheet()->setCellValue("G".$i, "Sol Id");
			$objPHPExcel->getActiveSheet()->setCellValue("H".$i,"Fecha Solicitada");
			$objPHPExcel->getActiveSheet()->setCellValue("I".$i, "Fecha Autorizada");

			$objPHPExcel->getActiveSheet()->setCellValue("J".$i, "folio");

		// $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('5492CD');
			
			$styleArray = array(
					'font' => array(
						'bold' => true,
						'color' => array('argb' => 'FFFFFF'),
					),
			
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					),

					'borders' => array(
						'bootom' => array(
							'style' => PHPExcel_Style_Border::BORDER_THICK,
							),
					),

					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,'rotation' => 90,'startcolor' => array(
							'argb' => '5492CD',
							),
						'endcolor' => array(
							'argb' => '5492CD',
							),
					),
			);//END START ARRAY
			$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);
			//$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		while($fila = mysql_fetch_array($rst))
		{   $i++;

			$objPHPExcel->getActiveSheet()->setCellValue("A".$i, $fila['usuario']);

			$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila['area']);
			$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila['sucursal']);

			$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila['TipoSolicitud']);
			$objPHPExcel->getActiveSheet()->setCellValue("E".$i, $fila['titulo']);
			$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila['Descripcion']);

			$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $fila['id']);
			$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila['fecha_solicitada']);
			$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila['fechaAutorizada']);
			$objPHPExcel->getActiveSheet()->setCellValue("J".$i, $fila['folio']);

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

		
		}
		//$objPHPExcel->getActiveSheet()->getStyle('A1:j'.$i)->getAlignment()->setWrapText(true);
		// $objWriter->save($archivo_loc.$archivo_nom);//guardamos el archivo excel
		$objPHPExcel->getActiveSheet()->setTitle('Solicitudes Aceptadas');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="solicitudesAceptadas.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		$objWriter->save('php://output');
		exit;

	

 ?> 