<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Excel extends CI_Controller {
		
		
		
		
		
		/**
		 * 
		 * __construct
		 */
		public function __construct () {
			parent::__construct();
			
			// loading the library for excel files (http://phpexcel.codeplex.com/)
			$this->load->library('PHPExcel/PHPExcel.php');
		}
		// end: __construct
		
		
		
		
		
		/**
		 * 
		 * index
		 */
		public function index () {
			$this->load->view('errors/errors-not-access-allowed');
		}
		// end: index
		
		
		
		
		
		/**
		 * 
		 * make_school_excel
		 * 
		 * method to make an excel file from schools
		 */
		public function make_school_excel () {
			$this->load->model('secundaria_schools_mdl',	'schools');
			$this->load->model('secundaria_groups_mdl',		'groups');
			$this->load->model('secundaria_students_mdl',	'students');
			$school = $this->schools->getSchoolInfo($this->input->get('schoolID'));
			
			$this->phpexcel->getProperties()->setCreator("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
							 ->setLastModifiedBy("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
							 ->setTitle("Niños con Aptitudes Sobresalientes de la escuela " . $school->school_name . "")
							 ->setSubject("Sistema IdeA-CAS")
							 ->setDescription("Niños con Aptitudes Sobresalientes de la escuela " . $school->school_name . "")
							 ->setKeywords("aptitudes niños sobresalientes escuelas")
							 ->setCategory("Niños con Aptitudes Sobresalientes");
			
			$this->phpexcel->getDefaultStyle()->getFont()->setName('Arial');
			$this->phpexcel->getDefaultStyle()->getFont()->setSize(8);
			
			// Rename worksheet
			$this->phpexcel->getActiveSheet()->setTitle('Resultados de niños CAS');
			
			
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$this->phpexcel->setActiveSheetIndex(0);
			$this->phpexcel->getActiveSheet()->mergeCells('A1:Z6');
			
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('img/bnr/bnr.logotype.png');
			$objDrawing->setHeight(90);
			$objDrawing->setCoordinates('A1');
			$objDrawing->setWorksheet($this->phpexcel->getActiveSheet());
			
			
			// beg: adding the content
			$this->phpexcel->getActiveSheet()->mergeCells('A7:L7');
			$this->phpexcel->getActiveSheet()->mergeCells('A8:L8');
			$this->phpexcel->setActiveSheetIndex(0)
			            ->setCellValue('A7', 'Dirección General de Operaciones de Servicios Educativos')
			            ->setCellValue('A8', 'Dirección de Educacion Especial');
			            
			$this->phpexcel->getActiveSheet()->mergeCells('A10:B15');
			$this->phpexcel->getActiveSheet()->mergeCells('C10:J10');
			$this->phpexcel->getActiveSheet()->mergeCells('K10:P10');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A10', "1\nCLAVES PARA EL LLENADO")
												   ->setCellValue('C10', "ATENCIÓN")
												   ->setCellValue('K10', "NO ATENCIÓN");
			
			// -----------------------
			
			$this->phpexcel->getActiveSheet()->mergeCells('C11:D11');
			$this->phpexcel->getActiveSheet()->mergeCells('E11:F11');
			$this->phpexcel->getActiveSheet()->mergeCells('G11:H11');
			$this->phpexcel->getActiveSheet()->mergeCells('I11:J11');
			$this->phpexcel->getActiveSheet()->mergeCells('K11:L11');
			$this->phpexcel->getActiveSheet()->mergeCells('M11:N11');
			$this->phpexcel->getActiveSheet()->mergeCells('O11:P11');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C11', "EA")
												   ->setCellValue('E11', "FN")
												   ->setCellValue('G11', "DIA")
												   ->setCellValue('I11', "AC")
												   ->setCellValue('K11', "B")
												   ->setCellValue('M11', "CN")
												   ->setCellValue('O11', "DI");
			// -----------------------
			
			$this->phpexcel->getActiveSheet()->mergeCells('C12:D15');
			$this->phpexcel->getActiveSheet()->mergeCells('E12:F15');
			$this->phpexcel->getActiveSheet()->mergeCells('G12:H15');
			$this->phpexcel->getActiveSheet()->mergeCells('I12:J15');
			$this->phpexcel->getActiveSheet()->mergeCells('K12:L15');
			$this->phpexcel->getActiveSheet()->mergeCells('M12:N15');
			$this->phpexcel->getActiveSheet()->mergeCells('O12:P15');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C12', "Enriquecimiento de ambientes para potenciar el aprendizaje")
												   ->setCellValue('E12', "Filosofía para niños")
												   ->setCellValue('G12', "Desarrollo de la inteligencia a través del arte")
												   ->setCellValue('I12', "Aceleración")
												   ->setCellValue('K12', "Baja")
												   ->setCellValue('M12', "Cambio de nivel")
												   ->setCellValue('O12', "Dificultad para la identificación");
			
			// -----------------------
			
			$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setWrapText(true);
			$this->phpexcel->getActiveSheet()->getStyle('A10:P11')->getFont()->setBold(true);

			// -----------------------
			
			$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A19:P25')->getAlignment()->setWrapText(true);
			$this->phpexcel->getActiveSheet()->mergeCells('A19:A20');
			$this->phpexcel->getActiveSheet()->mergeCells('B19:L19');
			$this->phpexcel->getActiveSheet()->mergeCells('B20:L20');
			$this->phpexcel->getActiveSheet()->mergeCells('A21:A24');
			$this->phpexcel->getActiveSheet()->mergeCells('B21:F24');
			$this->phpexcel->getActiveSheet()->mergeCells('G21:I24');
			$this->phpexcel->getActiveSheet()->mergeCells('J21:J24');
			$this->phpexcel->getActiveSheet()->mergeCells('K21:K24');
			$this->phpexcel->getActiveSheet()->mergeCells('L21:L24');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A19', "2")
												   ->setCellValue('B19', "CRO:")
												   ->setCellValue('B20', "ESCUELA:")
												   ->setCellValue('A21', "3\n\nNo.")
												   ->setCellValue('B21', "NOMBRE DEL NIÑO")
												   ->setCellValue('G21', "CURP")
												   ->setCellValue('J21', "EDAD")
												   ->setCellValue('K21', "GRADO")
												   ->setCellValue('L21', "GRUPO");
			$this->phpexcel->getActiveSheet()->getStyle('A19:L24')->getFont()->setBold(true);
			
			// -----------------------
			
			$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->phpexcel->getActiveSheet()->mergeCells('P22:U22');
			$this->phpexcel->getActiveSheet()->mergeCells('V22:Z22');
			$this->phpexcel->getActiveSheet()->mergeCells('M19:U19');
			$this->phpexcel->getActiveSheet()->mergeCells('M20:U20');
			$this->phpexcel->getActiveSheet()->mergeCells('V19:Z19');
			$this->phpexcel->getActiveSheet()->mergeCells('V20:Z20');
			$this->phpexcel->getActiveSheet()->mergeCells('M21:O22');
			$this->phpexcel->getActiveSheet()->mergeCells('P21:Z21');
			$this->phpexcel->getActiveSheet()->mergeCells('M23:N24');
			$this->phpexcel->getActiveSheet()->mergeCells('O23:O24');
			$this->phpexcel->getActiveSheet()->mergeCells('P23:P24');
			$this->phpexcel->getActiveSheet()->mergeCells('Q23:Q24');
			$this->phpexcel->getActiveSheet()->mergeCells('R23:R24');
			$this->phpexcel->getActiveSheet()->mergeCells('S23:S24');
			$this->phpexcel->getActiveSheet()->mergeCells('T23:U24');
			$this->phpexcel->getActiveSheet()->mergeCells('V23:V24');
			$this->phpexcel->getActiveSheet()->mergeCells('W23:W24');
			$this->phpexcel->getActiveSheet()->mergeCells('X23:X24');
			$this->phpexcel->getActiveSheet()->mergeCells('Y23:Z24');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M19', "ZONA DE SUPERVISIÓN:")
												   ->setCellValue('M20', "CCT:")
												   ->setCellValue('V19', "USAER:")
												   ->setCellValue('V20', "TURNO:")
												   ->setCellValue('M21', "4 NOMINACIÓN")
												   ->setCellValue('P21', "5 SITUACIÓN ACTUAL")
												   ->setCellValue('P22', "ATENCIÓN")
												   ->setCellValue('V22', "NO ATENCIÓN")
												   ->setCellValue('M23', "SISTEMA")
												   ->setCellValue('O23', "ESCUELA/USAER")
												   ->setCellValue('P23', "EA")
												   ->setCellValue('Q23', "FN")
												   ->setCellValue('R23', "DIA")
												   ->setCellValue('S23', "AC")
												   ->setCellValue('T23', "Otros\n(especificar)")
												   ->setCellValue('V23', "B")
												   ->setCellValue('W23', "CN")
												   ->setCellValue('X23', "DI")
												   ->setCellValue('Y23', "Otros\n(especificar)");
			$this->phpexcel->getActiveSheet()->getStyle('M19:Z22')->getFont()->setBold(true);
			$this->phpexcel->getActiveSheet()->getStyle('B20:Z20')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
			$this->phpexcel->getActiveSheet()->getStyle('P22:Z22')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
			// end: adding the content
			
			switch ( $school->school_turn ) {
				case 'ja':				$turn = 'Jornada Ampliada';		break;
				case 'tc':				$turn = 'Tiempo Completo';		break;
				case 'v':				$turn = 'Vespertino';			break;
				case 'm': default:		$turn = 'Matutino';
			}
			
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M19', "ZONA DE SUPERVISIÓN: " . $school->school_supervision_zone)
												   ->setCellValue('M20', "CCT: " . $school->school_cct)
												   ->setCellValue('V19', "USAER: " . $school->school_usaer)
												   ->setCellValue('V20', "TURNO: " . $turn)
												   ->setCellValue('B19', "CRO: " . $school->school_crosee)
												   ->setCellValue('B20', "ESCUELA: " . $school->school_name);
			
			
			$this->load->model('secundaria_groups_mdl', 'groups');
			$this->load->model('secundaria_students_mdl', 'students');
			
			$student_no = 1;
			$row_no = 25;
			$array_counter = 0;
			$students = $this->students->getSchoolStudents($school->school_id);
			
			$array_students = array();
			
			foreach ( $students as $student ) {
				
				$group_info = $this->groups->getGroupInfo($student->student_group_id);
				
				$array_students[] = array (
					'student_group_name'		=> $group_info->group_name,
					'student_id'				=> $student->student_id,
					'student_fname'				=> $student->student_fname,
					'student_lname'				=> $student->student_lname,
					'student_curp'				=> $student->student_curp,
					'student_sex'				=> $student->student_sex,
					'student_user_id'			=> $student->student_user_id,
					'student_school_id'			=> $student->student_school_id,
					'student_school_cct'		=> $student->student_school_cct,
					'student_grade'				=> $student->student_grade,
					'student_group_id'			=> $student->student_group_id,
					'student_school_level'		=> $student->student_school_level,
					'student_is_deleted'		=> $student->student_is_deleted,
					'student_end_app'			=> $student->student_end_app,
					'student_is_down'			=> $student->student_is_down
				);
				
			}
			
			asort($array_students);
			
			foreach ( $array_students as $student ) {
				$performanceArea = $this->students->getPerformanceArea($student['student_id']);
				
				if ( strlen(trim($performanceArea)) > 0 ) {
					
					(($row_no % 2)?$this->phpexcel->getActiveSheet()->getStyle('A' . $row_no . ':Z' . $row_no . '')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA'):'');
					$group_info = $this->groups->getGroupInfo($student['student_group_id']);
					$this->phpexcel->getActiveSheet()->mergeCells('B' . $row_no . ':F' . $row_no . '');
					$this->phpexcel->getActiveSheet()->mergeCells('G' . $row_no . ':I' . $row_no . '');
					$this->phpexcel->getActiveSheet()->mergeCells('M' . $row_no . ':N' . $row_no . '');
					$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . $row_no, $student_no)
														   ->setCellValue('B' . $row_no, $student['student_lname'] . ' ' . $student['student_fname'])
														   ->setCellValue('G' . $row_no, strtoupper($student['student_curp']))
														   ->setCellValue('J' . $row_no, $this->strings_mdl->get_child_age(trim($student['student_curp'])))
														   ->setCellValue('K' . $row_no, $group_info->group_grade)
														   ->setCellValue('L' . $row_no, $group_info->group_name)
														   ->setCellValue('M' . $row_no, $performanceArea);
					$row_no++;
					$student_no++;
				}
			}
			
			/**
			
			$total_students = $this->schools->school_groups_students_counter($school->school_id);
			
			$percent = ((($student_no - 1) * 100 ) / $total_students );
			
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . ($row_no + 3), '% de alumnos nominados de toda la escuela');
			$this->phpexcel->getActiveSheet()->mergeCells('A' . ($row_no + 3) . ':E' . ($row_no + 3) . '');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('F' . ($row_no + 3), ceil($percent) . '%');
			$this->phpexcel->getActiveSheet()->mergeCells('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '');
			$this->phpexcel->getActiveSheet()->getStyle('A' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getFont()->setBold(true);
			$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			*/
			
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="[' . time() . '-' . $school->school_id . '] ' . url_title($school->school_name, '_', TRUE) . '.xlsx"');
			header('Cache-Control: max-age=0');
			
			$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
			$objWriter->save('php://output');
			
		}
		// end: make_school_excel
		
		
		
		
		
		/**
		 * 
		 * excel_schools
		 * 
		 * method to make an excel file from schools
		 */
		public function excel_schools () {
			$this->load->model('secundaria_schools_mdl',	'schools');
			$this->load->model('secundaria_groups_mdl',		'groups');
			$this->load->model('secundaria_students_mdl',	'students');
			if ( $this->session->userdata('cas-secundaria-userdashboard') == 'root' ) {
			$this->phpexcel->getProperties()->setCreator("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
							 ->setLastModifiedBy("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
							 ->setTitle("Niños con Aptitudes Sobresalientes de la escuela " . $this->input->get('schoolname') . "")
							 ->setSubject("Sistema IdeA-CAS")
							 ->setDescription("Niños con Aptitudes Sobresalientes de la escuela " . $this->input->get('schoolname') . "")
							 ->setKeywords("aptitudes niños sobresalientes escuelas")
							 ->setCategory("Niños con Aptitudes Sobresalientes");
			
			$this->phpexcel->getDefaultStyle()->getFont()->setName('Arial');
			$this->phpexcel->getDefaultStyle()->getFont()->setSize(8);
			
			// Rename worksheet
			$this->phpexcel->getActiveSheet()->setTitle('Resultados de niños CAS');
			
			
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$this->phpexcel->setActiveSheetIndex(0);
			$this->phpexcel->getActiveSheet()->mergeCells('A1:Z6');
			
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('img/bnr/bnr.logotype.png');
			$objDrawing->setHeight(90);
			$objDrawing->setCoordinates('A1');
			$objDrawing->setWorksheet($this->phpexcel->getActiveSheet());
			
			
			// beg: adding the content
			$this->phpexcel->getActiveSheet()->mergeCells('A7:L7');
			$this->phpexcel->getActiveSheet()->mergeCells('A8:L8');
			$this->phpexcel->setActiveSheetIndex(0)
			            ->setCellValue('A7', 'Dirección General de Operaciones de Servicios Educativos')
			            ->setCellValue('A8', 'Dirección de Educacion Especial');
			            
			$this->phpexcel->getActiveSheet()->mergeCells('A10:B15');
			$this->phpexcel->getActiveSheet()->mergeCells('C10:J10');
			$this->phpexcel->getActiveSheet()->mergeCells('K10:P10');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A10', "1\nCLAVES PARA EL LLENADO")
												   ->setCellValue('C10', "ATENCIÓN")
												   ->setCellValue('K10', "NO ATENCIÓN");
			
			// -----------------------
			
			$this->phpexcel->getActiveSheet()->mergeCells('C11:D11');
			$this->phpexcel->getActiveSheet()->mergeCells('E11:F11');
			$this->phpexcel->getActiveSheet()->mergeCells('G11:H11');
			$this->phpexcel->getActiveSheet()->mergeCells('I11:J11');
			$this->phpexcel->getActiveSheet()->mergeCells('K11:L11');
			$this->phpexcel->getActiveSheet()->mergeCells('M11:N11');
			$this->phpexcel->getActiveSheet()->mergeCells('O11:P11');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C11', "EA")
												   ->setCellValue('E11', "FN")
												   ->setCellValue('G11', "DIA")
												   ->setCellValue('I11', "AC")
												   ->setCellValue('K11', "B")
												   ->setCellValue('M11', "CN")
												   ->setCellValue('O11', "DI");
			// -----------------------
			
			$this->phpexcel->getActiveSheet()->mergeCells('C12:D15');
			$this->phpexcel->getActiveSheet()->mergeCells('E12:F15');
			$this->phpexcel->getActiveSheet()->mergeCells('G12:H15');
			$this->phpexcel->getActiveSheet()->mergeCells('I12:J15');
			$this->phpexcel->getActiveSheet()->mergeCells('K12:L15');
			$this->phpexcel->getActiveSheet()->mergeCells('M12:N15');
			$this->phpexcel->getActiveSheet()->mergeCells('O12:P15');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C12', "Enriquecimiento de ambientes para potenciar el aprendizaje")
												   ->setCellValue('E12', "Filosofía para niños")
												   ->setCellValue('G12', "Desarrollo de la inteligencia a través del arte")
												   ->setCellValue('I12', "Aceleración")
												   ->setCellValue('K12', "Baja")
												   ->setCellValue('M12', "Cambio de nivel")
												   ->setCellValue('O12', "Dificultad para la identificación");
			
			// -----------------------
			
			$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setWrapText(true);
			$this->phpexcel->getActiveSheet()->getStyle('A10:P11')->getFont()->setBold(true);

			// -----------------------
			
			$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('A19:P25')->getAlignment()->setWrapText(true);
			$this->phpexcel->getActiveSheet()->mergeCells('A19:A20');
			$this->phpexcel->getActiveSheet()->mergeCells('B19:L19');
			$this->phpexcel->getActiveSheet()->mergeCells('B20:L20');
			$this->phpexcel->getActiveSheet()->mergeCells('A21:A24');
			$this->phpexcel->getActiveSheet()->mergeCells('B21:F24');
			$this->phpexcel->getActiveSheet()->mergeCells('G21:I24');
			$this->phpexcel->getActiveSheet()->mergeCells('J21:J24');
			$this->phpexcel->getActiveSheet()->mergeCells('K21:K24');
			$this->phpexcel->getActiveSheet()->mergeCells('L21:L24');
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A19', "2")
												   ->setCellValue('B19', "CRO:")
												   ->setCellValue('B20', "ESCUELA:")
												   ->setCellValue('A21', "3\n\nNo.")
												   ->setCellValue('B21', "NOMBRE DEL NIÑO")
												   ->setCellValue('G21', "CURP")
												   ->setCellValue('J21', "EDAD")
												   ->setCellValue('K21', "GRADO")
												   ->setCellValue('L21', "GRUPO");
			$this->phpexcel->getActiveSheet()->getStyle('A19:L24')->getFont()->setBold(true);
			
			// -----------------------
			
			
			$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			/**
			$this->phpexcel->getActiveSheet()->mergeCells('P22:U22');
			$this->phpexcel->getActiveSheet()->mergeCells('V22:Z22');
			$this->phpexcel->getActiveSheet()->mergeCells('M19:U19');
			$this->phpexcel->getActiveSheet()->mergeCells('M20:U20');
			$this->phpexcel->getActiveSheet()->mergeCells('V19:Z19');
			$this->phpexcel->getActiveSheet()->mergeCells('V20:Z20');
			*/
			$this->phpexcel->getActiveSheet()->mergeCells('M21:O22');
			/**
			$this->phpexcel->getActiveSheet()->mergeCells('P21:Z21');
			*/
			$this->phpexcel->getActiveSheet()->mergeCells('M23:N24');
			$this->phpexcel->getActiveSheet()->mergeCells('O23:O24');
			/**
			$this->phpexcel->getActiveSheet()->mergeCells('P23:P24');
			$this->phpexcel->getActiveSheet()->mergeCells('Q23:Q24');
			$this->phpexcel->getActiveSheet()->mergeCells('R23:R24');
			$this->phpexcel->getActiveSheet()->mergeCells('S23:S24');
			$this->phpexcel->getActiveSheet()->mergeCells('T23:U24');
			$this->phpexcel->getActiveSheet()->mergeCells('V23:V24');
			$this->phpexcel->getActiveSheet()->mergeCells('W23:W24');
			$this->phpexcel->getActiveSheet()->mergeCells('X23:X24');
			$this->phpexcel->getActiveSheet()->mergeCells('Y23:Z24');
			*/
			$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M21', "4 NOMINACIÓN")
												   ->setCellValue('M23', "SISTEMA")
												   ->setCellValue('O23', "ESCUELA/USAER");
			
			$this->phpexcel->getActiveSheet()->getStyle('M19:Z22')->getFont()->setBold(true);
			$this->phpexcel->getActiveSheet()->getStyle('B20:Z20')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
			$this->phpexcel->getActiveSheet()->getStyle('P22:Z22')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
			// end: adding the content
			
			
			$schools = $this->schools->getAllSchools();
			
			$student_no = 1;
			$row_no = 25;
			foreach ( $schools as $school ) {
				
				/**
				switch ( $school->school_turn ) {
					case 'ja':				$turn = 'Jornada Ampliada';		break;
					case 'tc':				$turn = 'Tiempo Completo';		break;
					case 'v':				$turn = 'Vespertino';			break;
					case 'm': default:		$turn = 'Matutino';
				}
				*/
				
				/**
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M19', "ZONA DE SUPERVISIÓN: " . $school->school_supervision_zone)
													   ->setCellValue('M20', "CCT: " . $school->school_cct)
													   ->setCellValue('V19', "USAER: " . $school->school_usaer)
													   ->setCellValue('V20', "TURNO: " . $turn)
													   ->setCellValue('B19', "CRO: " . $school->school_crosee)
													   ->setCellValue('B20', "ESCUELA: " . $school->school_name);
				*/
				$students = $this->students->getSchoolStudents($school->school_id);
				foreach ( $students as $student ) {
					$performanceArea = $this->students->getPerformanceArea($student->student_id);
					
					if ( strlen(trim($performanceArea)) > 0 ) {
						(($row_no % 2)?$this->phpexcel->getActiveSheet()->getStyle('A' . $row_no . ':Z' . $row_no . '')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA'):'');
						$group_info = $this->groups->getGroupInfo($student->student_group_id);
						$this->phpexcel->getActiveSheet()->mergeCells('B' . $row_no . ':F' . $row_no . '');
						$this->phpexcel->getActiveSheet()->mergeCells('G' . $row_no . ':I' . $row_no . '');
						$this->phpexcel->getActiveSheet()->mergeCells('M' . $row_no . ':N' . $row_no . '');
						$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . $row_no, $student_no)
															   ->setCellValue('B' . $row_no, $student->student_lname . ' ' . $student->student_fname)
															   ->setCellValue('G' . $row_no, strtoupper($student->student_curp))
															   ->setCellValue('J' . $row_no, $this->strings_mdl->get_child_age(trim($student->student_curp)))
															   ->setCellValue('K' . $row_no, $group_info->group_grade)
															   ->setCellValue('L' . $row_no, $group_info->group_name)
															   ->setCellValue('M' . $row_no, $performanceArea);
						$row_no++;
						$student_no++;
					}
				}
				
				/**
				
				$total_students = $this->schools->school_groups_students_counter($school->school_id);
				
				$percent = ((($student_no - 1) * 100 ) / $total_students );
				
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . ($row_no + 3), '% de alumnos nominados de toda la escuela');
				$this->phpexcel->getActiveSheet()->mergeCells('A' . ($row_no + 3) . ':E' . ($row_no + 3) . '');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('F' . ($row_no + 3), ceil($percent) . '%');
				$this->phpexcel->getActiveSheet()->mergeCells('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '');
				$this->phpexcel->getActiveSheet()->getStyle('A' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getFont()->setBold(true);
				$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				*/
			}
			
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="[' . time() . '-nominados-del-sistema-idea-cas.xlsx"');
			header('Cache-Control: max-age=0');
			
			$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
			$objWriter->save('php://output');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
			
		}
		// end: excel_schools
		
		
		
		
		
		/**
		 * 
		 * excel_max_nominated
		 * 
		 * method to make an excel file from schools
		 */
		public function excel_max_nominated () {
			$this->load->model('secundaria_schools_mdl',	'schools');
			$this->load->model('secundaria_groups_mdl',		'groups');
			$this->load->model('secundaria_students_mdl',	'students');
			if ( $this->session->userdata('cas-secundaria-userdashboard') == 'root' ) {
				$this->phpexcel->getProperties()->setCreator("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
								 ->setLastModifiedBy("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
								 ->setTitle("Niños con Aptitudes Sobresalientes de la escuela " . $this->input->get('schoolname') . "")
								 ->setSubject("Sistema IdeA-CAS")
								 ->setDescription("Niños con Aptitudes Sobresalientes de la escuela " . $this->input->get('schoolname') . "")
								 ->setKeywords("aptitudes niños sobresalientes escuelas")
								 ->setCategory("Niños con Aptitudes Sobresalientes");
				
				$this->phpexcel->getDefaultStyle()->getFont()->setName('Arial');
				$this->phpexcel->getDefaultStyle()->getFont()->setSize(8);
				
				// Rename worksheet
				$this->phpexcel->getActiveSheet()->setTitle('Resultados de niños CAS');
				
				
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$this->phpexcel->setActiveSheetIndex(0);
				$this->phpexcel->getActiveSheet()->mergeCells('A1:Z6');
				
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Logo');
				$objDrawing->setDescription('Logo');
				$objDrawing->setPath('img/bnr/bnr.logotype.png');
				$objDrawing->setHeight(90);
				$objDrawing->setCoordinates('A1');
				$objDrawing->setWorksheet($this->phpexcel->getActiveSheet());
				
				
				// beg: adding the content
				$this->phpexcel->getActiveSheet()->mergeCells('A7:L7');
				$this->phpexcel->getActiveSheet()->mergeCells('A8:L8');
				$this->phpexcel->setActiveSheetIndex(0)
				            ->setCellValue('A7', 'Dirección General de Operaciones de Servicios Educativos')
				            ->setCellValue('A8', 'Dirección de Educacion Especial');
				            
				$this->phpexcel->getActiveSheet()->mergeCells('A10:B15');
				$this->phpexcel->getActiveSheet()->mergeCells('C10:J10');
				$this->phpexcel->getActiveSheet()->mergeCells('K10:P10');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A10', "1\nCLAVES PARA EL LLENADO")
													   ->setCellValue('C10', "ATENCIÓN")
													   ->setCellValue('K10', "NO ATENCIÓN");
				
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->mergeCells('C11:D11');
				$this->phpexcel->getActiveSheet()->mergeCells('E11:F11');
				$this->phpexcel->getActiveSheet()->mergeCells('G11:H11');
				$this->phpexcel->getActiveSheet()->mergeCells('I11:J11');
				$this->phpexcel->getActiveSheet()->mergeCells('K11:L11');
				$this->phpexcel->getActiveSheet()->mergeCells('M11:N11');
				$this->phpexcel->getActiveSheet()->mergeCells('O11:P11');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C11', "EA")
													   ->setCellValue('E11', "FN")
													   ->setCellValue('G11', "DIA")
													   ->setCellValue('I11', "AC")
													   ->setCellValue('K11', "B")
													   ->setCellValue('M11', "CN")
													   ->setCellValue('O11', "DI");
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->mergeCells('C12:D15');
				$this->phpexcel->getActiveSheet()->mergeCells('E12:F15');
				$this->phpexcel->getActiveSheet()->mergeCells('G12:H15');
				$this->phpexcel->getActiveSheet()->mergeCells('I12:J15');
				$this->phpexcel->getActiveSheet()->mergeCells('K12:L15');
				$this->phpexcel->getActiveSheet()->mergeCells('M12:N15');
				$this->phpexcel->getActiveSheet()->mergeCells('O12:P15');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C12', "Enriquecimiento de ambientes para potenciar el aprendizaje")
													   ->setCellValue('E12', "Filosofía para niños")
													   ->setCellValue('G12', "Desarrollo de la inteligencia a través del arte")
													   ->setCellValue('I12', "Aceleración")
													   ->setCellValue('K12', "Baja")
													   ->setCellValue('M12', "Cambio de nivel")
													   ->setCellValue('O12', "Dificultad para la identificación");
				
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setWrapText(true);
				$this->phpexcel->getActiveSheet()->getStyle('A10:P11')->getFont()->setBold(true);
	
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A19:P25')->getAlignment()->setWrapText(true);
				$this->phpexcel->getActiveSheet()->mergeCells('A19:A20');
				$this->phpexcel->getActiveSheet()->mergeCells('B19:L19');
				$this->phpexcel->getActiveSheet()->mergeCells('B20:L20');
				$this->phpexcel->getActiveSheet()->mergeCells('A21:A24');
				$this->phpexcel->getActiveSheet()->mergeCells('B21:F24');
				$this->phpexcel->getActiveSheet()->mergeCells('G21:I24');
				$this->phpexcel->getActiveSheet()->mergeCells('J21:J24');
				$this->phpexcel->getActiveSheet()->mergeCells('K21:K24');
				$this->phpexcel->getActiveSheet()->mergeCells('L21:L24');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A19', "2")
													   ->setCellValue('B19', "CRO:")
													   ->setCellValue('B20', "ESCUELA:")
													   ->setCellValue('A21', "3\n\nNo.")
													   ->setCellValue('B21', "NOMBRE DEL NIÑO")
													   ->setCellValue('G21', "CURP")
													   ->setCellValue('J21', "EDAD")
													   ->setCellValue('K21', "GRADO")
													   ->setCellValue('L21', "GRUPO");
				$this->phpexcel->getActiveSheet()->getStyle('A19:L24')->getFont()->setBold(true);
				
				// -----------------------
				
				
				$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				/**
				$this->phpexcel->getActiveSheet()->mergeCells('P22:U22');
				$this->phpexcel->getActiveSheet()->mergeCells('V22:Z22');
				$this->phpexcel->getActiveSheet()->mergeCells('M19:U19');
				$this->phpexcel->getActiveSheet()->mergeCells('M20:U20');
				$this->phpexcel->getActiveSheet()->mergeCells('V19:Z19');
				$this->phpexcel->getActiveSheet()->mergeCells('V20:Z20');
				*/
				$this->phpexcel->getActiveSheet()->mergeCells('M21:O22');
				/**
				$this->phpexcel->getActiveSheet()->mergeCells('P21:Z21');
				*/
				$this->phpexcel->getActiveSheet()->mergeCells('M23:N24');
				$this->phpexcel->getActiveSheet()->mergeCells('O23:O24');
				/**
				$this->phpexcel->getActiveSheet()->mergeCells('P23:P24');
				$this->phpexcel->getActiveSheet()->mergeCells('Q23:Q24');
				$this->phpexcel->getActiveSheet()->mergeCells('R23:R24');
				$this->phpexcel->getActiveSheet()->mergeCells('S23:S24');
				$this->phpexcel->getActiveSheet()->mergeCells('T23:U24');
				$this->phpexcel->getActiveSheet()->mergeCells('V23:V24');
				$this->phpexcel->getActiveSheet()->mergeCells('W23:W24');
				$this->phpexcel->getActiveSheet()->mergeCells('X23:X24');
				$this->phpexcel->getActiveSheet()->mergeCells('Y23:Z24');
				*/
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M21', "4 NOMINACIÓN")
													   ->setCellValue('M23', "SISTEMA")
													   ->setCellValue('O23', "ESCUELA/USAER");
				
				$this->phpexcel->getActiveSheet()->getStyle('M19:Z22')->getFont()->setBold(true);
				$this->phpexcel->getActiveSheet()->getStyle('B20:Z20')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
				$this->phpexcel->getActiveSheet()->getStyle('P22:Z22')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
				// end: adding the content
				
				
				$schools = $this->schools->getAllSchools();
				
				$student_no = 1;
				$row_no = 25;
				foreach ( $schools as $school ) {
					
					/**
					switch ( $school->school_turn ) {
						case 'ja':				$turn = 'Jornada Ampliada';		break;
						case 'tc':				$turn = 'Tiempo Completo';		break;
						case 'v':				$turn = 'Vespertino';			break;
						case 'm': default:		$turn = 'Matutino';
					}
					*/
					
					/**
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M19', "ZONA DE SUPERVISIÓN: " . $school->school_supervision_zone)
														   ->setCellValue('M20', "CCT: " . $school->school_cct)
														   ->setCellValue('V19', "USAER: " . $school->school_usaer)
														   ->setCellValue('V20', "TURNO: " . $turn)
														   ->setCellValue('B19', "CRO: " . $school->school_crosee)
														   ->setCellValue('B20', "ESCUELA: " . $school->school_name);
					*/
					$students = $this->students->getSchoolStudents($school->school_id);
					foreach ( $students as $student ) {
						$performanceArea = $this->students->getPerformanceArea($student->student_id);
						
						if ( strlen(trim($performanceArea)) > 0 ) {
							if ( strlen(trim($performanceArea)) >= 7  ) {
								(($row_no % 2)?$this->phpexcel->getActiveSheet()->getStyle('A' . $row_no . ':Z' . $row_no . '')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA'):'');
								$group_info = $this->groups->getGroupInfo($student->student_group_id);
								$this->phpexcel->getActiveSheet()->mergeCells('B' . $row_no . ':F' . $row_no . '');
								$this->phpexcel->getActiveSheet()->mergeCells('G' . $row_no . ':I' . $row_no . '');
								$this->phpexcel->getActiveSheet()->mergeCells('M' . $row_no . ':N' . $row_no . '');
								$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . $row_no, $student_no)
																	   ->setCellValue('B' . $row_no, $student->student_lname . ' ' . $student->student_fname)
																	   ->setCellValue('G' . $row_no, strtoupper($student->student_curp))
																	   ->setCellValue('J' . $row_no, $this->strings_mdl->get_child_age(trim($student->student_curp)))
																	   ->setCellValue('K' . $row_no, $group_info->group_grade)
																	   ->setCellValue('L' . $row_no, $group_info->group_name)
																	   ->setCellValue('M' . $row_no, $performanceArea);
								$row_no++;
								$student_no++;
							}
						}
					}
					
					/**
					
					$total_students = $this->schools->school_groups_students_counter($school->school_id);
					
					$percent = ((($student_no - 1) * 100 ) / $total_students );
					
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . ($row_no + 3), '% de alumnos nominados de toda la escuela');
					$this->phpexcel->getActiveSheet()->mergeCells('A' . ($row_no + 3) . ':E' . ($row_no + 3) . '');
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('F' . ($row_no + 3), ceil($percent) . '%');
					$this->phpexcel->getActiveSheet()->mergeCells('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '');
					$this->phpexcel->getActiveSheet()->getStyle('A' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getFont()->setBold(true);
					$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					*/
				}
				
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="[' . time() . '-nominados-del-sistema-idea-cas.xlsx"');
				header('Cache-Control: max-age=0');
				
				$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
				$objWriter->save('php://output');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: excel_max_nominated
		
		
		
		
		
		/**
		 * ==========================================================================
		 * 
		 * beg: Preescolar
		 * 
		 * ==========================================================================
		 */
			
			
			
			
			
			/**
			 * 
			 * preescolar_make_school_excel
			 */
			public function preescolar_make_school_excel () {
				$this->load->model('preescolar_schools_mdl',	'schools');
				$this->load->model('preescolar_groups_mdl',		'groups');
				$this->load->model('preescolar_students_mdl',	'students');
				$school = $this->schools->getSchoolInfo($this->input->get('schoolID'));
				
				$this->phpexcel->getProperties()->setCreator("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
								 ->setLastModifiedBy("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
								 ->setTitle("Niños con Aptitudes Sobresalientes de la escuela " . $school->school_name . "")
								 ->setSubject("Sistema IdeA-CAS")
								 ->setDescription("Niños con Aptitudes Sobresalientes de la escuela " . $school->school_name . "")
								 ->setKeywords("aptitudes niños sobresalientes escuelas")
								 ->setCategory("Niños con Aptitudes Sobresalientes");
				
				$this->phpexcel->getDefaultStyle()->getFont()->setName('Arial');
				$this->phpexcel->getDefaultStyle()->getFont()->setSize(8);
				
				// Rename worksheet
				$this->phpexcel->getActiveSheet()->setTitle('Resultados de niños CAS');
				
				
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$this->phpexcel->setActiveSheetIndex(0);
				$this->phpexcel->getActiveSheet()->mergeCells('A1:Z6');
				
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Logo');
				$objDrawing->setDescription('Logo');
				$objDrawing->setPath('img/bnr/bnr.logotype.png');
				$objDrawing->setHeight(90);
				$objDrawing->setCoordinates('A1');
				$objDrawing->setWorksheet($this->phpexcel->getActiveSheet());
				
				
				// beg: adding the content
				$this->phpexcel->getActiveSheet()->mergeCells('A7:L7');
				$this->phpexcel->getActiveSheet()->mergeCells('A8:L8');
				$this->phpexcel->setActiveSheetIndex(0)
				            ->setCellValue('A7', 'Dirección General de Operaciones de Servicios Educativos')
				            ->setCellValue('A8', 'Dirección de Educacion Especial');
				            
				$this->phpexcel->getActiveSheet()->mergeCells('A10:B15');
				$this->phpexcel->getActiveSheet()->mergeCells('C10:J10');
				$this->phpexcel->getActiveSheet()->mergeCells('K10:P10');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A10', "1\nCLAVES PARA EL LLENADO")
													   ->setCellValue('C10', "ATENCIÓN")
													   ->setCellValue('K10', "NO ATENCIÓN");
				
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->mergeCells('C11:D11');
				$this->phpexcel->getActiveSheet()->mergeCells('E11:F11');
				$this->phpexcel->getActiveSheet()->mergeCells('G11:H11');
				$this->phpexcel->getActiveSheet()->mergeCells('I11:J11');
				$this->phpexcel->getActiveSheet()->mergeCells('K11:L11');
				$this->phpexcel->getActiveSheet()->mergeCells('M11:N11');
				$this->phpexcel->getActiveSheet()->mergeCells('O11:P11');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C11', "EA")
													   ->setCellValue('E11', "FN")
													   ->setCellValue('G11', "DIA")
													   ->setCellValue('I11', "AC")
													   ->setCellValue('K11', "B")
													   ->setCellValue('M11', "CN")
													   ->setCellValue('O11', "DI");
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->mergeCells('C12:D15');
				$this->phpexcel->getActiveSheet()->mergeCells('E12:F15');
				$this->phpexcel->getActiveSheet()->mergeCells('G12:H15');
				$this->phpexcel->getActiveSheet()->mergeCells('I12:J15');
				$this->phpexcel->getActiveSheet()->mergeCells('K12:L15');
				$this->phpexcel->getActiveSheet()->mergeCells('M12:N15');
				$this->phpexcel->getActiveSheet()->mergeCells('O12:P15');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C12', "Enriquecimiento de ambientes para potenciar el aprendizaje")
													   ->setCellValue('E12', "Filosofía para niños")
													   ->setCellValue('G12', "Desarrollo de la inteligencia a través del arte")
													   ->setCellValue('I12', "Aceleración")
													   ->setCellValue('K12', "Baja")
													   ->setCellValue('M12', "Cambio de nivel")
													   ->setCellValue('O12', "Dificultad para la identificación");
				
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setWrapText(true);
				$this->phpexcel->getActiveSheet()->getStyle('A10:P11')->getFont()->setBold(true);
	
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A19:P25')->getAlignment()->setWrapText(true);
				$this->phpexcel->getActiveSheet()->mergeCells('A19:A20');
				$this->phpexcel->getActiveSheet()->mergeCells('B19:L19');
				$this->phpexcel->getActiveSheet()->mergeCells('B20:L20');
				$this->phpexcel->getActiveSheet()->mergeCells('A21:A24');
				$this->phpexcel->getActiveSheet()->mergeCells('B21:F24');
				$this->phpexcel->getActiveSheet()->mergeCells('G21:I24');
				$this->phpexcel->getActiveSheet()->mergeCells('J21:J24');
				$this->phpexcel->getActiveSheet()->mergeCells('K21:K24');
				$this->phpexcel->getActiveSheet()->mergeCells('L21:L24');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A19', "2")
													   ->setCellValue('B19', "DIRECCIÓN OPERATIVA:")
													   ->setCellValue('B20', "ESCUELA:")
													   ->setCellValue('A21', "3\n\nNo.")
													   ->setCellValue('B21', "NOMBRE DEL NIÑO")
													   ->setCellValue('G21', "CURP")
													   ->setCellValue('J21', "EDAD")
													   ->setCellValue('K21', "GRADO")
													   ->setCellValue('L21', "GRUPO");
				$this->phpexcel->getActiveSheet()->getStyle('A19:L24')->getFont()->setBold(true);
				
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->mergeCells('P22:U22');
				$this->phpexcel->getActiveSheet()->mergeCells('V22:Z22');
				$this->phpexcel->getActiveSheet()->mergeCells('M19:U19');
				$this->phpexcel->getActiveSheet()->mergeCells('M20:U20');
				$this->phpexcel->getActiveSheet()->mergeCells('V19:Z19');
				$this->phpexcel->getActiveSheet()->mergeCells('V20:Z20');
				$this->phpexcel->getActiveSheet()->mergeCells('M21:O22');
				$this->phpexcel->getActiveSheet()->mergeCells('P21:Z21');
				$this->phpexcel->getActiveSheet()->mergeCells('M23:N24');
				$this->phpexcel->getActiveSheet()->mergeCells('O23:O24');
				$this->phpexcel->getActiveSheet()->mergeCells('P23:P24');
				$this->phpexcel->getActiveSheet()->mergeCells('Q23:Q24');
				$this->phpexcel->getActiveSheet()->mergeCells('R23:R24');
				$this->phpexcel->getActiveSheet()->mergeCells('S23:S24');
				$this->phpexcel->getActiveSheet()->mergeCells('T23:U24');
				$this->phpexcel->getActiveSheet()->mergeCells('V23:V24');
				$this->phpexcel->getActiveSheet()->mergeCells('W23:W24');
				$this->phpexcel->getActiveSheet()->mergeCells('X23:X24');
				$this->phpexcel->getActiveSheet()->mergeCells('Y23:Z24');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M19', "DIRECCIÓN OPERATIVA PREESCOLAR:")
													   ->setCellValue('M20', "CCT:")
													   ->setCellValue('V19', "CAPEP:")
													   ->setCellValue('V20', "TURNO:")
													   ->setCellValue('M21', "4 NOMINACIÓN")
													   ->setCellValue('P21', "5 SITUACIÓN ACTUAL")
													   ->setCellValue('P22', "ATENCIÓN")
													   ->setCellValue('V22', "NO ATENCIÓN")
													   ->setCellValue('M23', "SISTEMA")
													   ->setCellValue('O23', "ESCUELA/CAPEP")
													   ->setCellValue('P23', "EA")
													   ->setCellValue('Q23', "")									// no borrar este campo vacio
													   ->setCellValue('R23', "")									// no borrar este campo vacio
													   ->setCellValue('S23', "AC")
													   ->setCellValue('T23', "Otros\n(especificar)")
													   ->setCellValue('V23', "B")
													   ->setCellValue('W23', "CN")
													   ->setCellValue('X23', "DI")
													   ->setCellValue('Y23', "Otros\n(especificar)");
				$this->phpexcel->getActiveSheet()->getStyle('M19:Z22')->getFont()->setBold(true);
				$this->phpexcel->getActiveSheet()->getStyle('B20:Z20')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
				$this->phpexcel->getActiveSheet()->getStyle('P22:Z22')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
				// end: adding the content
				
				switch ( $school->school_turn ) {
					case 'ja':				$turn = 'Jornada Ampliada';		break;
					case 'tc':				$turn = 'Tiempo Completo';		break;
					case 'v':				$turn = 'Vespertino';			break;
					case 'm': default:		$turn = 'Matutino';
				}
				
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M19', "DIRECCIÓN OPERATIVA CAPEP: " . $school->school_supervision_zone)
													   ->setCellValue('M20', "CCT: " . $school->school_cct)
													   ->setCellValue('V19', "CAPEP: " . $school->school_usaer)
													   ->setCellValue('V20', "TURNO: " . $turn)
													   ->setCellValue('B19', "DIRECCIÓN OPERATIVA: " . $school->school_crosee)
													   ->setCellValue('B20', "ESCUELA: " . $school->school_name);
				
				$student_no = 1;
				$row_no = 25;
				$array_counter = 0;
				$students = $this->students->getSchoolStudents($school->school_id);
				
				$array_students = array();
				if ( !empty($students) ){
					foreach ( $students as $student ) {
						
						$group_info = $this->groups->getGroupInfo($student->student_group_id);
						
						$array_students[] = array (
							'student_group_name'		=> $group_info->group_name,
							'student_id'				=> $student->student_id,
							'student_fname'				=> $student->student_fname,
							'student_lname'				=> $student->student_lname,
							'student_curp'				=> $student->student_curp,
							'student_sex'				=> $student->student_sex,
							'student_user_id'			=> $student->student_user_id,
							'student_school_id'			=> $student->student_school_id,
							'student_school_cct'		=> $student->student_school_cct,
							'student_grade'				=> $student->student_grade,
							'student_group_id'			=> $student->student_group_id,
							'student_school_level'		=> $student->student_school_level,
							'student_is_deleted'		=> $student->student_is_deleted,
							'student_end_app'			=> $student->student_end_app,
							'student_is_down'			=> $student->student_is_down
						);
						
					}
				}
				
				asort($array_students);
				
				if ( !empty($students) ) {
					foreach ( $array_students as $student ) {
						$performanceArea = $this->students->getPerformanceArea($student['student_id']);
						
						if ( strlen(trim($performanceArea)) > 0 ) {
							
							(($row_no % 2) ? $this->phpexcel->getActiveSheet()->getStyle('A' . $row_no . ':Z' . $row_no . '')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA'):'');
							$group_info = $this->groups->getGroupInfo($student['student_group_id']);
							$this->phpexcel->getActiveSheet()->mergeCells('B' . $row_no . ':F' . $row_no . '');
							$this->phpexcel->getActiveSheet()->mergeCells('G' . $row_no . ':I' . $row_no . '');
							$this->phpexcel->getActiveSheet()->mergeCells('M' . $row_no . ':N' . $row_no . '');
							$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
							$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . $row_no, $student_no)
																   ->setCellValue('B' . $row_no, $student['student_lname'] . ' ' . $student['student_fname'])
																   ->setCellValue('G' . $row_no, strtoupper($student['student_curp']))
																   ->setCellValue('J' . $row_no, $this->strings_mdl->get_child_age(trim($student['student_curp'])))
																   ->setCellValue('K' . $row_no, $group_info->group_grade)
																   ->setCellValue('L' . $row_no, $group_info->group_name)
																   ->setCellValue('M' . $row_no, $performanceArea);
							$row_no++;
							$student_no++;
						}
					}
				}
				/**
				
				$total_students = $this->schools->school_groups_students_counter($school->school_id);
				
				$percent = ((($student_no - 1) * 100 ) / $total_students );
				
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . ($row_no + 3), '% de alumnos nominados de toda la escuela');
				$this->phpexcel->getActiveSheet()->mergeCells('A' . ($row_no + 3) . ':E' . ($row_no + 3) . '');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('F' . ($row_no + 3), ceil($percent) . '%');
				$this->phpexcel->getActiveSheet()->mergeCells('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '');
				$this->phpexcel->getActiveSheet()->getStyle('A' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getFont()->setBold(true);
				$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				*/
				
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="[' . time() . '-' . $school->school_id . '] ' . url_title($school->school_name, '_', TRUE) . '.xlsx"');
				header('Cache-Control: max-age=0');
				
				$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
				$objWriter->save('php://output');
				
			}
			// end: preescolar_make_school_excel
			
			
			
			
			
			/**
			 * 
			 * preescolar_all_nominated
			 */
			public function preescolar_all_nominated () {
				
				$this->load->model('preescolar_schools_mdl',	'schools');
				$this->load->model('preescolar_groups_mdl',		'groups');
				$this->load->model('preescolar_students_mdl',	'students');
				if ( $this->session->userdata('cas-preescolar-userdashboard') == 'root' ) {
				$this->phpexcel->getProperties()->setCreator("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
								 ->setLastModifiedBy("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
								 ->setTitle("Niños con Aptitudes Sobresalientes de la escuela " . $this->input->get('schoolname') . "")
								 ->setSubject("Sistema IdeA-CAS")
								 ->setDescription("Niños con Aptitudes Sobresalientes de la escuela " . $this->input->get('schoolname') . "")
								 ->setKeywords("aptitudes niños sobresalientes escuelas")
								 ->setCategory("Niños con Aptitudes Sobresalientes");
				
				$this->phpexcel->getDefaultStyle()->getFont()->setName('Arial');
				$this->phpexcel->getDefaultStyle()->getFont()->setSize(8);
				
				// Rename worksheet
				$this->phpexcel->getActiveSheet()->setTitle('Resultados de niños CAS');
				
				
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$this->phpexcel->setActiveSheetIndex(0);
				$this->phpexcel->getActiveSheet()->mergeCells('A1:Z6');
				
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Logo');
				$objDrawing->setDescription('Logo');
				$objDrawing->setPath('img/bnr/bnr.logotype.png');
				$objDrawing->setHeight(90);
				$objDrawing->setCoordinates('A1');
				$objDrawing->setWorksheet($this->phpexcel->getActiveSheet());
				
				
				// beg: adding the content
				$this->phpexcel->getActiveSheet()->mergeCells('A7:L7');
				$this->phpexcel->getActiveSheet()->mergeCells('A8:L8');
				$this->phpexcel->setActiveSheetIndex(0)
				            ->setCellValue('A7', 'Dirección General de Operaciones de Servicios Educativos')
				            ->setCellValue('A8', 'Dirección de Educacion Especial');
				            
				$this->phpexcel->getActiveSheet()->mergeCells('A10:B15');
				$this->phpexcel->getActiveSheet()->mergeCells('C10:J10');
				$this->phpexcel->getActiveSheet()->mergeCells('K10:P10');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A10', "1\nCLAVES PARA EL LLENADO")
													   ->setCellValue('C10', "ATENCIÓN")
													   ->setCellValue('K10', "NO ATENCIÓN");
				
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->mergeCells('C11:D11');
				$this->phpexcel->getActiveSheet()->mergeCells('E11:F11');
				$this->phpexcel->getActiveSheet()->mergeCells('G11:H11');
				$this->phpexcel->getActiveSheet()->mergeCells('I11:J11');
				$this->phpexcel->getActiveSheet()->mergeCells('K11:L11');
				$this->phpexcel->getActiveSheet()->mergeCells('M11:N11');
				$this->phpexcel->getActiveSheet()->mergeCells('O11:P11');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C11', "EA")
													   ->setCellValue('E11', "FN")
													   ->setCellValue('G11', "DIA")
													   ->setCellValue('I11', "AC")
													   ->setCellValue('K11', "B")
													   ->setCellValue('M11', "CN")
													   ->setCellValue('O11', "DI");
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->mergeCells('C12:D15');
				$this->phpexcel->getActiveSheet()->mergeCells('E12:F15');
				$this->phpexcel->getActiveSheet()->mergeCells('G12:H15');
				$this->phpexcel->getActiveSheet()->mergeCells('I12:J15');
				$this->phpexcel->getActiveSheet()->mergeCells('K12:L15');
				$this->phpexcel->getActiveSheet()->mergeCells('M12:N15');
				$this->phpexcel->getActiveSheet()->mergeCells('O12:P15');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C12', "Enriquecimiento de ambientes para potenciar el aprendizaje")
													   ->setCellValue('E12', "Filosofía para niños")
													   ->setCellValue('G12', "Desarrollo de la inteligencia a través del arte")
													   ->setCellValue('I12', "Aceleración")
													   ->setCellValue('K12', "Baja")
													   ->setCellValue('M12', "Cambio de nivel")
													   ->setCellValue('O12', "Dificultad para la identificación");
				
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setWrapText(true);
				$this->phpexcel->getActiveSheet()->getStyle('A10:P11')->getFont()->setBold(true);
	
				// -----------------------
				
				$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('A19:P25')->getAlignment()->setWrapText(true);
				$this->phpexcel->getActiveSheet()->mergeCells('A19:A20');
				$this->phpexcel->getActiveSheet()->mergeCells('B19:L19');
				$this->phpexcel->getActiveSheet()->mergeCells('B20:L20');
				$this->phpexcel->getActiveSheet()->mergeCells('A21:A24');
				$this->phpexcel->getActiveSheet()->mergeCells('B21:F24');
				$this->phpexcel->getActiveSheet()->mergeCells('G21:I24');
				$this->phpexcel->getActiveSheet()->mergeCells('J21:J24');
				$this->phpexcel->getActiveSheet()->mergeCells('K21:K24');
				$this->phpexcel->getActiveSheet()->mergeCells('L21:L24');
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A19', "2")
													   ->setCellValue('B19', "DIRECCIÓN OPERATIVA:")
													   ->setCellValue('B20', "ESCUELA:")
													   ->setCellValue('A21', "3\n\nNo.")
													   ->setCellValue('B21', "NOMBRE DEL NIÑO")
													   ->setCellValue('G21', "CURP")
													   ->setCellValue('J21', "EDAD")
													   ->setCellValue('K21', "GRADO")
													   ->setCellValue('L21', "GRUPO");
				$this->phpexcel->getActiveSheet()->getStyle('A19:L24')->getFont()->setBold(true);
				
				// -----------------------
				
				
				$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				/**
				$this->phpexcel->getActiveSheet()->mergeCells('P22:U22');
				$this->phpexcel->getActiveSheet()->mergeCells('V22:Z22');
				$this->phpexcel->getActiveSheet()->mergeCells('M19:U19');
				$this->phpexcel->getActiveSheet()->mergeCells('M20:U20');
				$this->phpexcel->getActiveSheet()->mergeCells('V19:Z19');
				$this->phpexcel->getActiveSheet()->mergeCells('V20:Z20');
				*/
				$this->phpexcel->getActiveSheet()->mergeCells('M21:O22');
				/**
				$this->phpexcel->getActiveSheet()->mergeCells('P21:Z21');
				*/
				$this->phpexcel->getActiveSheet()->mergeCells('M23:N24');
				$this->phpexcel->getActiveSheet()->mergeCells('O23:O24');
				/**
				$this->phpexcel->getActiveSheet()->mergeCells('P23:P24');
				$this->phpexcel->getActiveSheet()->mergeCells('Q23:Q24');
				$this->phpexcel->getActiveSheet()->mergeCells('R23:R24');
				$this->phpexcel->getActiveSheet()->mergeCells('S23:S24');
				$this->phpexcel->getActiveSheet()->mergeCells('T23:U24');
				$this->phpexcel->getActiveSheet()->mergeCells('V23:V24');
				$this->phpexcel->getActiveSheet()->mergeCells('W23:W24');
				$this->phpexcel->getActiveSheet()->mergeCells('X23:X24');
				$this->phpexcel->getActiveSheet()->mergeCells('Y23:Z24');
				*/
				$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M21', "4 NOMINACIÓN")
													   ->setCellValue('M23', "SISTEMA")
													   ->setCellValue('O23', "ESCUELA/USAER");
				
				$this->phpexcel->getActiveSheet()->getStyle('M19:Z22')->getFont()->setBold(true);
				$this->phpexcel->getActiveSheet()->getStyle('B20:Z20')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
				$this->phpexcel->getActiveSheet()->getStyle('P22:Z22')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
				// end: adding the content
				
				
				$schools = $this->schools->getAllSchools();
				
				$student_no = 1;
				$row_no = 25;
				foreach ( $schools as $school ) {
					
					/**
					switch ( $school->school_turn ) {
						case 'ja':				$turn = 'Jornada Ampliada';		break;
						case 'tc':				$turn = 'Tiempo Completo';		break;
						case 'v':				$turn = 'Vespertino';			break;
						case 'm': default:		$turn = 'Matutino';
					}
					*/
					
					/**
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M19', "ZONA DE SUPERVISIÓN: " . $school->school_supervision_zone)
														   ->setCellValue('M20', "CCT: " . $school->school_cct)
														   ->setCellValue('V19', "USAER: " . $school->school_usaer)
														   ->setCellValue('V20', "TURNO: " . $turn)
														   ->setCellValue('B19', "CRO: " . $school->school_crosee)
														   ->setCellValue('B20', "ESCUELA: " . $school->school_name);
					*/
					$students = $this->students->getSchoolStudents($school->school_id);
					if ( !empty($students) ) {
						foreach ( $students as $student ) {
							$performanceArea = $this->students->getPerformanceArea($student->student_id);
							
							if ( strlen(trim($performanceArea)) > 0 ) {
								(($row_no % 2)?$this->phpexcel->getActiveSheet()->getStyle('A' . $row_no . ':Z' . $row_no . '')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA'):'');
								$group_info = $this->groups->getGroupInfo($student->student_group_id);
								$this->phpexcel->getActiveSheet()->mergeCells('B' . $row_no . ':F' . $row_no . '');
								$this->phpexcel->getActiveSheet()->mergeCells('G' . $row_no . ':I' . $row_no . '');
								$this->phpexcel->getActiveSheet()->mergeCells('M' . $row_no . ':N' . $row_no . '');
								$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . $row_no, $student_no)
																	   ->setCellValue('B' . $row_no, $student->student_lname . ' ' . $student->student_fname)
																	   ->setCellValue('G' . $row_no, strtoupper($student->student_curp))
																	   ->setCellValue('J' . $row_no, $this->strings_mdl->get_child_age(trim($student->student_curp)))
																	   ->setCellValue('K' . $row_no, $group_info->group_grade)
																	   ->setCellValue('L' . $row_no, $group_info->group_name)
																	   ->setCellValue('M' . $row_no, $performanceArea);
								$row_no++;
								$student_no++;
							}
						}
					}
					/**
					
					$total_students = $this->schools->school_groups_students_counter($school->school_id);
					
					$percent = ((($student_no - 1) * 100 ) / $total_students );
					
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . ($row_no + 3), '% de alumnos nominados de toda la escuela');
					$this->phpexcel->getActiveSheet()->mergeCells('A' . ($row_no + 3) . ':E' . ($row_no + 3) . '');
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('F' . ($row_no + 3), ceil($percent) . '%');
					$this->phpexcel->getActiveSheet()->mergeCells('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '');
					$this->phpexcel->getActiveSheet()->getStyle('A' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getFont()->setBold(true);
					$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					*/
				}
				
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="[' . time() . '-nominados-del-sistema-idea-cas.xlsx"');
				header('Cache-Control: max-age=0');
				
				$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
				$objWriter->save('php://output');
				}
				else
					$this->load->view('errors/errors-not-access-allowed');
				
			}
			// end: preescolar_all_nominated
			
			
			
			
			
			/**
			 * 
			 * preescolar_excel_max_nominated
			 */
			public function preescolar_excel_max_nominated () {
				
				$this->load->model('preescolar_schools_mdl',	'schools');
				$this->load->model('preescolar_groups_mdl',		'groups');
				$this->load->model('preescolar_students_mdl',	'students');
				if ( $this->session->userdata('cas-preescolar-userdashboard') == 'root' ) {
					$this->phpexcel->getProperties()->setCreator("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
									 ->setLastModifiedBy("Sistema IdeA-CAS - http://educacionespecial.sepdf.gob.mx/cas/")
									 ->setTitle("Niños con Aptitudes Sobresalientes de la escuela " . $this->input->get('schoolname') . "")
									 ->setSubject("Sistema IdeA-CAS")
									 ->setDescription("Niños con Aptitudes Sobresalientes de la escuela " . $this->input->get('schoolname') . "")
									 ->setKeywords("aptitudes niños sobresalientes escuelas")
									 ->setCategory("Niños con Aptitudes Sobresalientes");
					
					$this->phpexcel->getDefaultStyle()->getFont()->setName('Arial');
					$this->phpexcel->getDefaultStyle()->getFont()->setSize(8);
					
					// Rename worksheet
					$this->phpexcel->getActiveSheet()->setTitle('Resultados de niños CAS');
					
					
					// Set active sheet index to the first sheet, so Excel opens this as the first sheet
					$this->phpexcel->setActiveSheetIndex(0);
					$this->phpexcel->getActiveSheet()->mergeCells('A1:Z6');
					
					$objDrawing = new PHPExcel_Worksheet_Drawing();
					$objDrawing->setName('Logo');
					$objDrawing->setDescription('Logo');
					$objDrawing->setPath('img/bnr/bnr.logotype.png');
					$objDrawing->setHeight(90);
					$objDrawing->setCoordinates('A1');
					$objDrawing->setWorksheet($this->phpexcel->getActiveSheet());
					
					
					// beg: adding the content
					$this->phpexcel->getActiveSheet()->mergeCells('A7:L7');
					$this->phpexcel->getActiveSheet()->mergeCells('A8:L8');
					$this->phpexcel->setActiveSheetIndex(0)
					            ->setCellValue('A7', 'Dirección General de Operaciones de Servicios Educativos')
					            ->setCellValue('A8', 'Dirección de Educacion Especial');
					            
					$this->phpexcel->getActiveSheet()->mergeCells('A10:B15');
					$this->phpexcel->getActiveSheet()->mergeCells('C10:J10');
					$this->phpexcel->getActiveSheet()->mergeCells('K10:P10');
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A10', "1\nCLAVES PARA EL LLENADO")
														   ->setCellValue('C10', "ATENCIÓN")
														   ->setCellValue('K10', "NO ATENCIÓN");
					
					// -----------------------
					
					$this->phpexcel->getActiveSheet()->mergeCells('C11:D11');
					$this->phpexcel->getActiveSheet()->mergeCells('E11:F11');
					$this->phpexcel->getActiveSheet()->mergeCells('G11:H11');
					$this->phpexcel->getActiveSheet()->mergeCells('I11:J11');
					$this->phpexcel->getActiveSheet()->mergeCells('K11:L11');
					$this->phpexcel->getActiveSheet()->mergeCells('M11:N11');
					$this->phpexcel->getActiveSheet()->mergeCells('O11:P11');
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C11', "EA")
														   ->setCellValue('E11', "FN")
														   ->setCellValue('G11', "DIA")
														   ->setCellValue('I11', "AC")
														   ->setCellValue('K11', "B")
														   ->setCellValue('M11', "CN")
														   ->setCellValue('O11', "DI");
					// -----------------------
					
					$this->phpexcel->getActiveSheet()->mergeCells('C12:D15');
					$this->phpexcel->getActiveSheet()->mergeCells('E12:F15');
					$this->phpexcel->getActiveSheet()->mergeCells('G12:H15');
					$this->phpexcel->getActiveSheet()->mergeCells('I12:J15');
					$this->phpexcel->getActiveSheet()->mergeCells('K12:L15');
					$this->phpexcel->getActiveSheet()->mergeCells('M12:N15');
					$this->phpexcel->getActiveSheet()->mergeCells('O12:P15');
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('C12', "Enriquecimiento de ambientes para potenciar el aprendizaje")
														   ->setCellValue('E12', "Filosofía para niños")
														   ->setCellValue('G12', "Desarrollo de la inteligencia a través del arte")
														   ->setCellValue('I12', "Aceleración")
														   ->setCellValue('K12', "Baja")
														   ->setCellValue('M12', "Cambio de nivel")
														   ->setCellValue('O12', "Dificultad para la identificación");
					
					// -----------------------
					
					$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('A10:P15')->getAlignment()->setWrapText(true);
					$this->phpexcel->getActiveSheet()->getStyle('A10:P11')->getFont()->setBold(true);
		
					// -----------------------
					
					$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('A19:A24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('B21:L24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('A19:P25')->getAlignment()->setWrapText(true);
					$this->phpexcel->getActiveSheet()->mergeCells('A19:A20');
					$this->phpexcel->getActiveSheet()->mergeCells('B19:L19');
					$this->phpexcel->getActiveSheet()->mergeCells('B20:L20');
					$this->phpexcel->getActiveSheet()->mergeCells('A21:A24');
					$this->phpexcel->getActiveSheet()->mergeCells('B21:F24');
					$this->phpexcel->getActiveSheet()->mergeCells('G21:I24');
					$this->phpexcel->getActiveSheet()->mergeCells('J21:J24');
					$this->phpexcel->getActiveSheet()->mergeCells('K21:K24');
					$this->phpexcel->getActiveSheet()->mergeCells('L21:L24');
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A19', "2")
														   ->setCellValue('B19', "DIRECCIÓN OPERATIVA:")
														   ->setCellValue('B20', "ESCUELA:")
														   ->setCellValue('A21', "3\n\nNo.")
														   ->setCellValue('B21', "NOMBRE DEL NIÑO")
														   ->setCellValue('G21', "CURP")
														   ->setCellValue('J21', "EDAD")
														   ->setCellValue('K21', "GRADO")
														   ->setCellValue('L21', "GRUPO");
					$this->phpexcel->getActiveSheet()->getStyle('A19:L24')->getFont()->setBold(true);
					
					// -----------------------
					
					
					$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->phpexcel->getActiveSheet()->getStyle('M21:Z24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					/**
					$this->phpexcel->getActiveSheet()->mergeCells('P22:U22');
					$this->phpexcel->getActiveSheet()->mergeCells('V22:Z22');
					$this->phpexcel->getActiveSheet()->mergeCells('M19:U19');
					$this->phpexcel->getActiveSheet()->mergeCells('M20:U20');
					$this->phpexcel->getActiveSheet()->mergeCells('V19:Z19');
					$this->phpexcel->getActiveSheet()->mergeCells('V20:Z20');
					*/
					$this->phpexcel->getActiveSheet()->mergeCells('M21:O22');
					/**
					$this->phpexcel->getActiveSheet()->mergeCells('P21:Z21');
					*/
					$this->phpexcel->getActiveSheet()->mergeCells('M23:N24');
					$this->phpexcel->getActiveSheet()->mergeCells('O23:O24');
					/**
					$this->phpexcel->getActiveSheet()->mergeCells('P23:P24');
					$this->phpexcel->getActiveSheet()->mergeCells('Q23:Q24');
					$this->phpexcel->getActiveSheet()->mergeCells('R23:R24');
					$this->phpexcel->getActiveSheet()->mergeCells('S23:S24');
					$this->phpexcel->getActiveSheet()->mergeCells('T23:U24');
					$this->phpexcel->getActiveSheet()->mergeCells('V23:V24');
					$this->phpexcel->getActiveSheet()->mergeCells('W23:W24');
					$this->phpexcel->getActiveSheet()->mergeCells('X23:X24');
					$this->phpexcel->getActiveSheet()->mergeCells('Y23:Z24');
					*/
					$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M21', "4 NOMINACIÓN")
														   ->setCellValue('M23', "SISTEMA")
														   ->setCellValue('O23', "ESCUELA/USAER");
					
					$this->phpexcel->getActiveSheet()->getStyle('M19:Z22')->getFont()->setBold(true);
					$this->phpexcel->getActiveSheet()->getStyle('B20:Z20')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
					$this->phpexcel->getActiveSheet()->getStyle('P22:Z22')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
					// end: adding the content
					
					
					$schools = $this->schools->getAllSchools();
					
					$student_no = 1;
					$row_no = 25;
					foreach ( $schools as $school ) {
						
						/**
						switch ( $school->school_turn ) {
							case 'ja':				$turn = 'Jornada Ampliada';		break;
							case 'tc':				$turn = 'Tiempo Completo';		break;
							case 'v':				$turn = 'Vespertino';			break;
							case 'm': default:		$turn = 'Matutino';
						}
						*/
						
						/**
						$this->phpexcel->setActiveSheetIndex(0)->setCellValue('M19', "ZONA DE SUPERVISIÓN: " . $school->school_supervision_zone)
															   ->setCellValue('M20', "CCT: " . $school->school_cct)
															   ->setCellValue('V19', "USAER: " . $school->school_usaer)
															   ->setCellValue('V20', "TURNO: " . $turn)
															   ->setCellValue('B19', "CRO: " . $school->school_crosee)
															   ->setCellValue('B20', "ESCUELA: " . $school->school_name);
						*/
						$students = $this->students->getSchoolStudents($school->school_id);
						if ( !empty($students) ) {
							foreach ( $students as $student ) {
								$performanceArea = $this->students->getPerformanceArea($student->student_id);
								
								if ( strlen(trim($performanceArea)) > 0 ) {
									if ( strlen(trim($performanceArea)) >= 7  ) {
										(($row_no % 2)?$this->phpexcel->getActiveSheet()->getStyle('A' . $row_no . ':Z' . $row_no . '')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA'):'');
										$group_info = $this->groups->getGroupInfo($student->student_group_id);
										$this->phpexcel->getActiveSheet()->mergeCells('B' . $row_no . ':F' . $row_no . '');
										$this->phpexcel->getActiveSheet()->mergeCells('G' . $row_no . ':I' . $row_no . '');
										$this->phpexcel->getActiveSheet()->mergeCells('M' . $row_no . ':N' . $row_no . '');
										$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
										$this->phpexcel->getActiveSheet()->getStyle('J' . $row_no . ':M' . $row_no . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
										$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . $row_no, $student_no)
																			   ->setCellValue('B' . $row_no, $student->student_lname . ' ' . $student->student_fname)
																			   ->setCellValue('G' . $row_no, strtoupper($student->student_curp))
																			   ->setCellValue('J' . $row_no, $this->strings_mdl->get_child_age(trim($student->student_curp)))
																			   ->setCellValue('K' . $row_no, $group_info->group_grade)
																			   ->setCellValue('L' . $row_no, $group_info->group_name)
																			   ->setCellValue('M' . $row_no, $performanceArea);
										$row_no++;
										$student_no++;
									}
								}
							}
						}
						/**
						
						$total_students = $this->schools->school_groups_students_counter($school->school_id);
						
						$percent = ((($student_no - 1) * 100 ) / $total_students );
						
						$this->phpexcel->setActiveSheetIndex(0)->setCellValue('A' . ($row_no + 3), '% de alumnos nominados de toda la escuela');
						$this->phpexcel->getActiveSheet()->mergeCells('A' . ($row_no + 3) . ':E' . ($row_no + 3) . '');
						$this->phpexcel->setActiveSheetIndex(0)->setCellValue('F' . ($row_no + 3), ceil($percent) . '%');
						$this->phpexcel->getActiveSheet()->mergeCells('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '');
						$this->phpexcel->getActiveSheet()->getStyle('A' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getFont()->setBold(true);
						$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$this->phpexcel->getActiveSheet()->getStyle('F' . ($row_no + 3) . ':G' . ($row_no + 3) . '')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						
						*/
					}
					
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					header('Content-Disposition: attachment;filename="[' . time() . '-nominados-del-sistema-idea-cas.xlsx"');
					header('Cache-Control: max-age=0');
					
					$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
					$objWriter->save('php://output');
				}
				else
				$this->load->view('errors/errors-not-access-allowed');
				
			}
			// end: preescolar_excel_max_nominated
			
			
			
			
			
			
		/**
		 * ==========================================================================
		 * 
		 * end: Preescolar
		 * 
		 * ==========================================================================
		 */
	}