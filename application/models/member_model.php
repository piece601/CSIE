<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function check_user_exist($data){ // 檢查帳號是否存在
		$this->db->select("COUNT(*) AS users");
    $this->db->from("member");
    $this->db->where("account", $data['account']);
    $query = $this->db->get(); 
    return $query->row()->users > 0 ;
	}

	function select_all_data(){
		$this->db->select('*');
		$this->db->from('member');
		$this->db->join('group', 'member.groupId = group.groupId');
		$this->db->order_by("createTime","desc");//由大到小排序
		$query = $this->db->get();
		return $query->result();
	}

	function select_data_by_account($account){
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where('account', $account);
		$query = $this->db->get();
		return $query->row();
	}

	function select_data_group_id($data){
		$this->db->select('*');
		$this->db->from('member');
		$this->db->join('group', 'member.groupId = group.groupId');
		$this->db->where('member.groupId',$data['groupId']);
		$this->db->order_by("createTime","desc");//由大到小排序
		$query = $this->db->get();
		// $query = $this->db->get_where('member', array('groupId' => $data['groupId']));
		return $query->result();
	}

	function select_all_data_use_like($data){
		$this->db->select('*');
		$this->db->from('member');
		$this->db->join('group', 'member.groupId = group.groupId');
		$this->db->like('account', $data); 
		$this->db->or_like('name', $data);
		$this->db->order_by("createTime","desc");//由大到小排序
		$query = $this->db->get();
		return $query->result();
	}

	function select_all_account(){ // 把所有帳號撈出來
		$this->db->select('account');
		$this->db->from('member');
		$this->db->order_by("createTime","desc");//由大到小排序
		$query = $this->db->get();
		return $query->result();
	}

	function insert_data($data){ //新增成員
		$this->db->insert('member',$data);
		return true;
	}

	function update_data($data){ //更新成員資料
		$this->db->where('account', $data['account']);
		$this->db->update('member', $data);
		return $this->db->affected_rows() > 0; //判斷是否更新成功 >0 表示影響一筆 所以更新成功
	}

	function delete_data_by_account($account){
		$this->db->delete('member',array('account' => $account));
		return true;
	}
}