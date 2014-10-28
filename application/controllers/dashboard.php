<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function  __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('yd_m');

	}
	public function index()
	{
		$this->load->view('Admin/index.html');
	}
	function unclassfied_list()//未分类列表
	{
		$this->load->view('Admin/pages/grab_list/unclassfied_list.html');
	}
	function file_list()//归档列表
	{
		$this->load->view('Admin/pages/grab_list/file_list.html');
	}
	function house_list()//房产列表
	{
		$this->load->view('Admin/pages/grab_list/house_list.html');
	}
	function car_list()//机动车列表
	{
		$this->load->view('Admin/pages/grab_list/car_list.html');
	}

	function unclassfied_list_json()
	{
		$result=$this->yd_m->select_list('0');
		$arr = array();
		foreach ($result as $r) {
			$item['item_id']=$r->item_id;
			$item['item_original_type']=$r->item_original_type;
			$item['item_title']=$r->item_title;
			$item['item_url']=$r->item_url;
			$item['grab_item_id']=$r->grab_item_id;
			$item['insert_time']=$r->insert_time;
			$item['item_type']=$r->item_type;
			$grab_target_type=$r->grab_target_type;
			$item['grab_target_type']=$this->yd_m->line_select('GrabTargetType','id',$grab_target_type)->description;
			$arr[]=$item;
		}
		echo json_encode($arr);
	}
	function file_list_json()//归档列表
	{
		$result=$this->yd_m->select_list('99');
		$arr = array();
		foreach ($result as $r) {
			$item['item_id']=$r->item_id;
			$item['item_original_type']=$r->item_original_type;
			$item['item_title']=$r->item_title;
			$item['item_url']=$r->item_url;
			$item['grab_item_id']=$r->grab_item_id;
			$item['insert_time']=$r->insert_time;
			$item['item_type']=$r->item_type;
			$grab_target_type=$r->grab_target_type;
			$item['grab_target_type']=$this->yd_m->line_select('GrabTargetType','id',$grab_target_type)->description;
			$arr[]=$item;
		}
		echo  json_encode($arr);

	}
	function house_list_json()//房产列表
	{
		$result=$this->yd_m->select_list('1');
		$arr = array();
		foreach ($result as $r) {
			$item['item_id']=$r->item_id;
			$item['item_original_type']=$r->item_original_type;
			$item['item_title']=$r->item_title;
			$item['item_url']=$r->item_url;
			$item['grab_item_id']=$r->grab_item_id;
			$item['insert_time']=$r->insert_time;
			$item['item_type']=$r->item_type;
			$grab_target_type=$r->grab_target_type;
			$item['grab_target_type']=$this->yd_m->line_select('GrabTargetType','id',$grab_target_type)->description;
			$arr[]=$item;
		}
		echo  json_encode($arr);
		
	}
	function car_list_json()
	{
		$result=$this->yd_m->select_list('2');
		$arr = array();
		foreach ($result as $r) {
			$item['item_id']=$r->item_id;
			$item['item_original_type']=$r->item_original_type;
			$item['item_title']=$r->item_title;
			$item['item_url']=$r->item_url;
			$item['grab_item_id']=$r->grab_item_id;
			$item['insert_time']=$r->insert_time;
			$item['item_type']=$r->item_type;
			$grab_target_type=$r->grab_target_type;
			$item['grab_target_type']=$this->yd_m->line_select('GrabTargetType','id',$grab_target_type)->description;
			$arr[]=$item;
		}
		echo  json_encode($arr);
	}
	function land_list_json()
	{
		$result=$this->yd_m->select_list('3');
		$arr = array();
		foreach ($result as $r) {
			$item['item_id']=$r->item_id;
			$item['item_original_type']=$r->item_original_type;
			$item['item_title']=$r->item_title;
			$item['item_url']=$r->item_url;
			$item['grab_item_id']=$r->grab_item_id;
			$item['insert_time']=$r->insert_time;
			$item['item_type']=$r->item_type;
			$grab_target_type=$r->grab_target_type;
			$item['grab_target_type']=$this->yd_m->line_select('GrabTargetType','id',$grab_target_type)->description;
			$arr[]=$item;
		}
		echo  json_encode($arr);
	}
	function type_list_json()
	{
		$result=$this->yd_m->select_type();
		echo json_encode($result);

	}
	// function return_unclassfied()
	// {
	// 	$item_type=$this->input->post('item_type');
	// 	$item_id=$this->input->post('item_id');
	// 	$arr=array('item_type'=>$item_type,'item_status'=>2);
	// 	$this->yd_m->update_list($item_id,$arr);
	// 	$data['message']=$item_type;
	// 	echo  json_encode($data);
	// }

	function updateType()
	{
		$item_type=$this->input->post('item_type');
		$item_id=$this->input->post('item_id');
		$item_status=$this->input->post('item_status');
		$arr=array('item_type'=>$item_type,'item_status'=>$item_status);
		$this->yd_m->update_list($item_id,$arr);
		$data['message']=$item_type;
		echo  json_encode($data);
	}
	function updateTypeFromUnClassfied()
	{
		$item_type=$this->input->post('item_type');
		$item_id=$this->input->post('item_id');
		$arr=array('item_type'=>$item_type ,'item_status'=>2);
		$this->yd_m->update_list($item_id,$arr);
		$sql="update CategoryCount set total_num=total_num-1,update_time=now() where id=1";//未归档的减1
		mysql_query($sql);
		$data['message']="成功";
		echo  json_encode($data);
	}

	function file()
	{
		$item_type=$this->input->post('item_type');
		$item_id=$this->input->post('item_id');
		$arr=array('item_type'=>$item_type);
		$this->yd_m->update_list($item_id,$arr);
		$sql="update CategoryCount set total_num=total_num-1,update_time=now() where id=1";//未归档的减1
		mysql_query($sql);
		$sql="update CategoryCount set total_num=total_num+1,update_time=now() where id=2";//归档的加1
		mysql_query($sql);
		$data['message']="成功";
		echo  json_encode($data);
	}

	function select_list_num_json()//未分类统计
	{
		$result=$this->yd_m->line_select('CategoryCount','id','1');//select 标的物未分类的数量
		$data['unclassfied_num']=(int)$result->total_num;
		$result=$this->yd_m->line_select('CategoryCount','id','2');//selec 已归档的总数
		$data['file_num']=(int)$result->total_num;
		$result=$this->yd_m->line_select('CategoryCount','id','3');
		//$data['house_num']=$result->total_num;
		$sql="select * from GrabList where item_type=1 and item_status=2";//已分类房产
		$data['house_num']=$this->db->query($sql)->num_rows();
		$sql="select * from GrabList where item_type=2 and item_status=2";//已分类机动车
		$data['car_num']=$this->db->query($sql)->num_rows();
		$sql="select * from GrabList where item_type=3 and item_status=2";//已分类房产
		$data['land_num']=$this->db->query($sql)->num_rows();
		$sql="select * from GrabList where item_type=4 and item_status=2";//已分类机动车
		$data['other_num']=$this->db->query($sql)->num_rows();
		



		echo json_encode($data);
	}

	function dashboard_json()
	{
		 $_tobay = date('Y-m-d 00:00:00',time());
		 $_tomorrow = date('Y-m-d 23:59:59',time());
		 $sql="SELECT SUM(NumItems) AS OrderTotal FROM SysLog WHERE EndTime BETWEEN '".$_tobay."' AND '".$_tomorrow."'";
		 $row=$this->db->query($sql)->row(0);
	  	 $data['today_add_items_num']=$row->OrderTotal;
	  	 $result=$this->yd_m->line_select('CategoryCount','id','1');//select 标的物未分类的数量
	  	 $data['unclassfied_num']=(int)$result->total_num;
	  	 echo json_encode($data);

	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */