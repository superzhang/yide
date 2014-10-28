<?php
class Cs_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function user_select($uname)
	{
		$this->db->where('user_name',$uname);
		$this->db->select('*');
		$query=$this->db->get('sys_user');
		return $query->result();
	}
	
	function insert($db,$arr)
	{	
 		$this->db->insert($db,$arr);
	}

	function select($db)
	{
		
		$q=$this->db->get($db);
		return $q->result();
	}

	function select_course($course_status,$course_status2)
	{
		$this->db->where('course_status',$course_status);
		$this->db->or_where('course_status',$course_status2);
		$this->db->order_by('course_id',"desc");
		$this->db->select('*');
		$query=$this->db->get('course');
		return $query->result();
	}



	function get_all($db,$per_page,$desc) 
	{
		
		
		$this->db->order_by($desc,"desc");
		$q = $this->db->get($db, $per_page, $this->uri->segment(3));
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}		
	}

	function get_search_course($db,$per_page,$course_name)
	{
		$this->db->like('course_name',$course_name);
		$this->db->order_by('course_id',"desc");
		$q = $this->db->get($db, $per_page, $this->uri->segment(3));
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}		
	}

	function get_search_student($db,$per_page,$content)
	{
		$this->db->where('student_name',$content);
		$this->db->or_where('student_phone',$content);
		$this->db->or_where('student_mobilesub',$content);
		$this->db->order_by('student_id',"desc");
		$q = $this->db->get($db, $per_page, $this->uri->segment(3));
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}		
	}
	// function select_line($id)
	// {
	// 	$this->db->where('id',$id);
	// 	$q=$this->db->get('gaochou');
	// 	return $q->result();
	// }
	// 
	function select_checkin($db,$per_page,$course_id,$group_id = 0)//报名或签到
	{
		$this->db->where('course_id',$course_id);
		if($group_id){
			$this->db->where('`group`',$group_id);
		}
		$q = $this->db->get($db, $per_page, $this->uri->segment(3));
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}		
	}
	
		function select_checkout($db,$per_page,$course_id,$checkout)//签出
	{
		$this->db->where('course_id',$course_id);
		$this->db->where('checkout',$checkout);
		$q = $this->db->get($db, $per_page, $this->uri->segment(3));
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}		
	}

	function update_course($old_course_id,$arr)
	{
		
        
        $this->db->where('course_id',$old_course_id);
        $this->db->update('course',$arr);
	}

		function update_series($old_series_id,$arr)
	{
		
        
        $this->db->where('series_id',$old_series_id);
        $this->db->update('series',$arr);
	}

	function update_checkin($course_id,$student_id,$arr)
	{
		$this->db->where('course_id',$course_id);
		$this->db->where('student_id',$student_id);
        $this->db->update('checkin',$arr);
	}

	function line_select($db,$field,$value)
	{
		$this->db->where($field,$value);
		$this->db->select('*');
		$q=$this->db->get($db);
		
		return $q->row(0);
		
		
	}
	function checkin_select($db,$field1,$value1,$field2,$value2)
	{
		$this->db->where($field1,$value1);
		$this->db->where($field2,$value2);
		$this->db->select('*');
		$q=$this->db->get($db);
		
		return $q->row(0);
	}

	function delete($db,$field,$value)
	{
		$this->db->where($field,$value);
		$this->db->delete($db); 
	}
	function delete_double($db,$field1,$value1,$field2,$value2)
	{
		$this->db->where($field1,$value1);
		$this->db->where($field2,$value2);
		$this->db->delete($db); 
	}

	function count_num($db,$course_id)
	{
		$this->db->where('course_id', $course_id);
		$this->db->from($db);
	  	return $this->db->count_all_results();
	}
	function count_checkout_num($db,$course_id,$checkout)
	{
		$this->db->where('course_id', $course_id);
		$this->db->where('checkout',$checkout);
		$this->db->from($db);
	  	return $this->db->count_all_results();
	}

	function count_checkin_num($student_id,$series_id)//统计这个人的单个系列的签到数量
	{
		$this->db->where('student_id',$student_id);
		$this->db->where('series_id',$series_id);
		$q=$this->db->get('checkin');
		return $q->num_rows();
	}

	function select_course_by_series($series_id)
	{
		$this->db->where('series_id',$series_id);
		$this->db->select('*');
		$q=$this->db->get('course');
		return $q->result();
	}
	
}