<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');





/**
 * 
 * excel
 */
class Excel extends CI_Controller {
	
	
	
	
	
	/**
	 * 
	 * __construct
	 */
	public function __construct () {
		parent::__construct();
		
		// inicializamos la librería
		$this->load->library('Classes/PHPExcel.php');
	}
	// end: construc
	
	
	
	
	
	/**
	 * 
	 * setExcel
	 */
	public function setExcel () {
		
		// configuramos las propiedades del documento
		$this->phpexcel->getProperties()->setCreator("Arkos Noem Arenom")
									 ->setLastModifiedBy("Arkos Noem Arenom")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");
		
		
		// agregamos información a las celdas
		$this->phpexcel->setActiveSheetIndex(0)
		            ->setCellValue('A1', 'Hello')
		            ->setCellValue('B2', 'world!')
		            ->setCellValue('C1', 'Hello')
		            ->setCellValue('D2', 'world!');
		
		// La librería puede manejar la codificación de caracteres UTF-8
		$this->phpexcel->setActiveSheetIndex(0)
		            ->setCellValue('A4', 'Miscellaneous glyphs')
		            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
		
		// Renombramos la hoja de trabajo
		$this->phpexcel->getActiveSheet()->setTitle('Simple');
		
		
		// configuramos el documento para que la hoja
		// de trabajo número 0 sera la primera en mostrarse
		// al abrir el documento
		$this->phpexcel->setActiveSheetIndex(0);
		
		
		// redireccionamos la salida al navegador del cliente (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="01simple.xlsx"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
		$objWriter->save('php://output');
		
	}
	// end: setExcel
}
// end: excel