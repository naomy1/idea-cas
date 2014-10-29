<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Preescolar_groups_mdl extends CI_Model {
		
		
		
		
		
		/**
		 * 
		 * the constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		
		
		
		
		
		/**
		 * 
		 * getSchoolGroups
		 * 
		 * function to get the groups from a school based in the 
		 * school Id
		 * 
		 * @param integer $schoolID
		 */
		public function getSchoolGroups ($schoolID = 0) {
			$this->db->order_by('group_grade', 'asc');
			$this->db->order_by('group_name', 'asc');
			return $this->db->get_where('schools_groups', array('group_school_id' => $schoolID))->result();
		}
		// end: getSchoolGroups
		
		
		
		
		
		/**
		 * 
		 * getGroupInfo
		 * 
		 * function to get the group info
		 * 
		 * @param integer $groupID
		 */
		public function getGroupInfo ($groupID = 0, $select = '*') {
			$this->db->select($select);
			return $this->db->get_where('schools_groups', array('group_id' => $groupID), 1)->row();
		}
		// end: getGroupInfo
		
		
		
		
		
		/**
		 * 
		 * groupStudentsCounter
		 * 
		 * function to count the number of students registered in this group
		 * 
		 * @param integer $groupID
		 */
		public function groupStudentsCounter ($groupID = 0) {
			return $this->db->get_where('schools_groups_students', array('student_group_id ' => $groupID))->num_rows();
		}
		// end: groupStudentsCounter
		
		
		
		
		
		/**
		 * 
		 * group_exists
		 * 
		 * function to check if a group exists
		 * 
		 * @param array $group
		 */
		 public function group_exists ($group = array()) {
		 	
			if ( $group_exists = $this->db->get_where('schools_groups', $group) )
				if ( $group_exists->num_rows() == 0 )
					return false;
				else
					return true;
			else
				return true;
			
		 }
		 // end: group_exists
		 
		 
		 
		 
		 
		 /**
		  * 
		  * addgroup
		  * 
		  * function to add group
		  * 
		  * @param array $group
		  */
		  public function addgroup ($group) {
		  	$group['group_school_level'] = 1;
		  	if ( $this->db->insert('schools_groups', $group) )
				return true;
			else
				return false;
		  }
		  // end: addgroup
		  
		  
		  
		  
		  
		  /**
		   * 
		   * deletegroup
		   * 
		   * function to delete group and all the students in it
		   * 
		   * @param integer groupID
		   */
		  public function deletegroup ($groupID = 0) {
		  	$this->db->delete('schools_groups', array('group_id' => $groupID));
			$this->db->where('student_group_id', $groupID);
			$this->db->update('schools_groups_students', array('student_is_deleted' => 'true'));
		  }
		  // end: deletegroup
		  
		  
		  
		  
		  
		/**
		 * 
		 * group_exists_edit
		 * 
		 * function to check if a group exists
		 * 
		 * @param array $group
		 * @return integer -- group_id
		 */
		 public function group_exists_edit ($group = array()) {
			
			if ( $group_exists = $this->db->get_where('schools_groups', $group, 1) )
				if ( $group_exists->num_rows() == 1 )
					return $group_exists->row()->group_id;
				else
					return 0;
			else
				return 0;
			
		 }
		 // end: group_exists_edit
		 
		 
		 
		 
		 
		 /**
		  * 
		  * edit_group
		  * 
		  * function to edit the info about a group
		  * 
		  * @param integer $groupID
		  * @param array $group
		  */
		 public function edit_group ($groupID = 0, $group = array()) {
		 	$this->db->where('group_id', $groupID);
		 	if ( $this->db->update('schools_groups', $group) )
				return true;
			else
				return false;
		 }
		 // end: edit_group
		 
		 
		 
		 
		 
		/**
		 * 
		 * upgrade_grade_group
		 */
		public function upgrade_grade_group ($groupid_from = 0, $groupid_to = 0) {
			
			$this->db->select('group_id, group_grade');
			$group_from		= $this->db->get_where('schools_groups', array('group_id' => $groupid_from), 1)->row();
			$this->db->select('group_id, group_grade');
			$group_to		= $this->db->get_where('schools_groups', array('group_id' => $groupid_to), 1)->row();
			
			$where = array(
				'student_group_id'		=> $group_from->group_id,
				'student_grade'			=> $group_from->group_grade
			);
			$this->db->where($where);
			
			$update = array(
				'student_group_id'		=> $group_to->group_id,
				'student_grade'			=> $group_to->group_grade
			);
			if ( $this->db->update('schools_groups_students', $update) )
				return TRUE;
			else
				return FALSE;
			
		}
		// end: upgrade_grade_group
		
		/**
		 * 
		 * upgrade_grade_groups_school
		 */
		public function upgrade_grade_groups_school ($schoolid = 0, $groupid_from = 0, $groupid_to = 0) {
			
			$this->db->select('group_id, group_grade');
			$group_from		= $this->db->get_where('schools_groups', array('group_id' => $groupid_from), 1)->row();
			$this->db->select('group_id, group_grade');
			$group_to		= $this->db->get_where('schools_groups', array('group_id' => $groupid_to), 1)->row();
			
			
			$where = array(
				'student_group_id'		=> $group_from->group_id,
				'student_grade'			=> $group_from->group_grade,
				'student_school_id'		=> $schoolid
			);
			$this->db->where($where);
			
			$update = array(
				'student_group_id'		=> $group_to->group_id,
				'student_grade'			=> $group_to->group_grade
			);
			if ( $this->db->update('schools_groups_students', $update) )
				return TRUE;
			else
				return FALSE;
			
		}
		// end: upgrade_grade_groups_school
	}
