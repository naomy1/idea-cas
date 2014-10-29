<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Secundaria_students_mdl extends CI_Model {
		
		
		
		
		
		/**
		 * 
		 * variables
		 */
		var $db_table = 'schools_groups_students';
		// end: variables
		
		
		
		
		
		/**
		 * 
		 * the constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		
		
		
		
		
		/**
		 * 
		 * getGroupStudents
		 * 
		 * function to get the students from a group
		 * 
		 * @param integer $groupID
		 */
		public function getGroupStudents ($groupID = 0) {
			$this->db->order_by('student_lname ', 'asc');
			return $this->db->get_where($this->db_table, array('student_group_id' => $groupID, 'student_is_deleted' => 'false', 'student_is_down' => 'false'))->result();
		}
		// end: getGroupStudents
		
		
		
		
		
		/**
		 * 
		 * getSchoolStudents
		 * 
		 * method to get the students from a school identified by ID
		 * 
		 * @param integer $school_id
		 * @param string $select
		 * @return object
		 */
		public function getSchoolStudents ($school_id = 0, $select = '*') {
			$this->db->order_by('student_lname', 'asc');
			$this->db->select($select);
			$where = array(
				'student_school_id' => $school_id,
				'student_school_level' => 3
			);
			return $this->db->get_where($this->db_table, $where)->result();
		}
		// end: getSchoolStudents
		
		
		
		
		
		/**
		 * 
		 * student_exists
		 * 
		 * function to check if an student exists
		 * 
		 * @param array $student
		 */
		public function student_exists ($student = array()) {
			if ( $student_exists = $this->db->get_where($this->db_table, $student) )
				if ( $student_exists->num_rows() == 0 )
					return false;
				else
					return true;
			else
				return true;
		}
		// end: student_exists
		
		
		
		
		
		/**
		 * 
		 * addstudent
		 * 
		 * function to register a student into the database
		 * 
		 * @param array $student
		 */
		public function addstudent ($student = array()) {
			if ( $this->db->insert($this->db_table, $student) )
				return true;
			else
				return false;
		}
		// end: addstudent
		
		
		
		
		
		/**
		 * 
		 * deletestudent
		 * 
		 * function to delete student from the database
		 * 
		 * @param integer $studentID
		 */
		public function deletestudent ($studentID = 0) {
			$student = array(
				'student_is_deleted' => 'true',
				'student_is_down' => 'true',
				'student_school_id' => '0',
				'student_group_id' => '0',
				'student_school_cct' => ''
			);
			$this->db->where('student_id', $studentID);
			$this->db->update($this->db_table, $student);
		}
		// end: deletestudent
		
		
		
		
		
		/**
		 * 
		 * getStudentInfo
		 * 
		 * function to get the student information
		 * 
		 * @param integer $studentID
		 */
		public function getStudentInfo ($studentID = 0, $select = '*') {
			$this->db->select($select);
			return $this->db->get_where($this->db_table, array('student_id' => $studentID), 1)->row();
		}
		// end: getStudentInfo
		
		
		
		
		
		/**
		 * 
		 * getStudentInfo_by_curp
		 * 
		 * function to get the student information
		 * 
		 * @param integer $studentCurp
		 * @param string $select
		 */
		public function getStudentInfo_by_curp ($studentCurp = '', $select = '*') {
			$this->db->select($select);
			return $this->db->get_where($this->db_table, array('student_curp' => $studentCurp), 1)->row();
		}
		// end: getStudentInfo
		
		
		
		
		
		/**
		 * 
		 * updateStudent
		 * 
		 * function to update student info
		 */
		public function updateStudent ($studentID = 0, $student ) {
			$this->db->where('student_id', $studentID);
			if ( $this->db->update($this->db_table, $student) )
				return true;
			else
				return false;
		}
		// end: updateStudent
		
		
		
		
		
		/**
		 * 
		 * updateStudent_root
		 * 
		 * function to update student info
		 */
		public function updateStudent_root ($studentID = 0, $student ) {
			$student['student_grade'] = $this->db->get_where('schools_groups', array('group_id' => $student['student_group_id']), 1)->row()->group_grade;
			
			$this->db->where('student_id', $studentID);
			if ( $this->db->update($this->db_table, $student) )
				return TRUE;
			else
				return FALSE;
		}
		// end: updateStudent_root
		
		
		
		
		
		/**
		 * 
		 * getPerformanceArea
		 * 
		 * 
		 */
		public function getPerformanceArea ($student_id = 0) {
			$answers = $this->db->get_where('cas_app_answers', array('answer_student_id' => $student_id), 1);
			
			$performanceAreas = '';
			$allPerformance = 0;
			
			if ( $answers->num_rows() == 1 ){
				$answer = $answers->row();
				
				// beg: lingüístico
				$linguistico_dominio			= $this->answerBitCarry($answer->answer_4) + $this->answerBitCarry($answer->answer_11) + $this->answerBitCarry($answer->answer_10);
				$linguistico_funcionalidad		= $this->answerBitCarry($answer->answer_16) + $this->answerBitCarry($answer->answer_21) + $this->answerBitCarry($answer->answer_26);
				$linguistico_interes			= $this->answerBitCarry($answer->answer_45) + $this->answerBitCarry($answer->answer_40) + $this->answerBitCarry($answer->answer_35);
				
				if ( $linguistico_dominio >= 5 && $linguistico_funcionalidad >= 5 && $linguistico_interes >= 5 ) {
					if ( ( $linguistico_dominio + $linguistico_funcionalidad + $linguistico_interes ) >= 17 ) { 
						$performanceAreas .= 'L';
						$allPerformance++;
					}
				}
				// end: lingüístico
				
				// beg: científico
				$cientifico_dominio				= $this->answerBitCarry($answer->answer_5) + $this->answerBitCarry($answer->answer_6) + $this->answerBitCarry($answer->answer_7);
				$cientifico_funcionalidad		= $this->answerBitCarry($answer->answer_17) + $this->answerBitCarry($answer->answer_22) + $this->answerBitCarry($answer->answer_27);
				$cientifico_interes				= $this->answerBitCarry($answer->answer_44) + $this->answerBitCarry($answer->answer_39) + $this->answerBitCarry($answer->answer_34);
				
				if ( $cientifico_dominio >= 5 && $cientifico_funcionalidad >= 5 && $cientifico_interes >= 5 ) {
					if ( ( $cientifico_dominio + $cientifico_funcionalidad + $cientifico_interes ) >= 17 ) { 
						$performanceAreas .= ', C';
						$allPerformance++;
					}
				}
				// end: científico
				
				// beg: Socioafectivo
				$socioafectivo_dominio				= $this->answerBitCarry($answer->answer_12) + $this->answerBitCarry($answer->answer_1) + $this->answerBitCarry($answer->answer_15);
				$socioafectivo_funcionalidad		= $this->answerBitCarry($answer->answer_18) + $this->answerBitCarry($answer->answer_23) + $this->answerBitCarry($answer->answer_28);
				$socioafectivo_interes				= $this->answerBitCarry($answer->answer_38) + $this->answerBitCarry($answer->answer_43) + $this->answerBitCarry($answer->answer_33);
				
				if ( $socioafectivo_dominio >= 5 && $socioafectivo_funcionalidad >= 5 && $socioafectivo_interes >= 5 ) {
					if ( ( $socioafectivo_dominio + $socioafectivo_funcionalidad + $socioafectivo_interes ) >= 17 ) { 
						$performanceAreas .= ', S';
						$allPerformance++;
					}
				}
				// end: Socioafectivo
				
				// beg: deportivo
				$deportivo_dominio				= $this->answerBitCarry($answer->answer_2) + $this->answerBitCarry($answer->answer_8) + $this->answerBitCarry($answer->answer_14);
				$deportivo_funcionalidad		= $this->answerBitCarry($answer->answer_18) + $this->answerBitCarry($answer->answer_24) + $this->answerBitCarry($answer->answer_29);
				$deportivo_interes				= $this->answerBitCarry($answer->answer_42) + $this->answerBitCarry($answer->answer_37) + $this->answerBitCarry($answer->answer_32);
				
				if ( $deportivo_dominio >= 5 && $deportivo_funcionalidad >= 5 && $deportivo_interes >= 5 ) {
					if ( ( $deportivo_dominio + $deportivo_funcionalidad + $deportivo_interes ) >= 17 ) { 
						$performanceAreas .= ', D';
						$allPerformance++;
					}
				}
				// end: deportivo
				
				// beg: artistico
				$artistico_dominio				= $this->answerBitCarry($answer->answer_3) + $this->answerBitCarry($answer->answer_9) + $this->answerBitCarry($answer->answer_13);
				$artistico_funcionalidad		= $this->answerBitCarry($answer->answer_20) + $this->answerBitCarry($answer->answer_25) + $this->answerBitCarry($answer->answer_30);
				$artistico_interes				= $this->answerBitCarry($answer->answer_41) + $this->answerBitCarry($answer->answer_36) + $this->answerBitCarry($answer->answer_31);
				
				if ( $artistico_dominio >= 5 && $artistico_funcionalidad >= 5 && $artistico_interes >= 5 ) {
					if ( ( $artistico_dominio + $artistico_funcionalidad + $artistico_interes ) >= 17 ) {
						$performanceAreas .= ', A';
						$allPerformance++;
					}
				}
				// end: artistico
				
				if ( substr($performanceAreas, 0, 1) == ',' ) $performanceAreas = substr($performanceAreas, 1);
				
				return (($allPerformance == 5)?'(*) ' : '') . trim($performanceAreas);
				
			}
			else
				return '';
			
		}
		//end: getPerformanceArea
		
		
		
		
		
		/**
		 * 
		 * answerBitCarry
		 * 
		 * method to transform the answer (1,2,3,4) to gradual scale (2,1,-1,-2)
		 */
		private function answerBitCarry  ($answer) {
			switch ($answer) {
				case 2: $carry = 1;		break;
				case 3: $carry = -1;	break;
				case 4: $carry = -2;	break;
				case 1: default: $carry = 2;
			}
			return $carry;
		}
		// end: answerBitCarry
	}
