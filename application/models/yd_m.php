<?php
class Yd_m extends CI_Model
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

	function select_list($item_type)
	{
		$this->db->where('item_type',$item_type);
		$this->db->order_by('item_id',"desc");
		$this->db->select('*');
		$query=$this->db->get('GrabList',100,0);
		return $query->result();
	}
	function select_type()
	{
		$this->db->select('*');
		$query=$this->db->get('TypeList');
		return $query->result();
	}

    function update_list($item_id,$arr)
	{
		$this->db->where('item_id', $item_id);
		$this->db->update('GrabList', $arr); 
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

	function line_select($db,$field,$value)
	{
		$this->db->where($field,$value);
		$this->db->select('*');
		$query=$this->db->get($db);
		return $query->row(0);


	}
}