<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function select_all_data(){ // 把所有群組撈出
		$this->db->select('*');
		$this->db->from('group');
		$this->db->order_by("groupId","desc");//由大到小排序
		$query = $this->db->get();
		return $query->result();
	}

	function select_data_group_id($data){
		$query = $this->db->get_where('group', array('groupId' => $data['groupId']));
		return $query->row();
	}

	function insert_data($data){ //新增group
		$this->db->insert('group',$data);
	}

	function update_data($data){ // 更新權限
		$this->db->where('groupId', $data['groupId']);
		$this->db->update('group', $data);
		return $this->db->affected_rows();
	}

	function delete_data($data){ //刪除
		$this->db->delete('group', array('groupId' => $data['groupId'])); 
		return true;
	}

}