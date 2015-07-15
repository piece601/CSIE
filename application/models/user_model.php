<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function select_data($data){ // 登入用
		$this->db->select('*');
		$this->db->from('member');
		$this->db->join('group', 'member.groupId = group.groupId');
		$this->db->where('account', $data['account']);
		$this->db->where('password', $data['password']);
		$query = $this->db->get();

		// $query = $this->db->get_where('member', array(
		// 	'account' => $data['account'],
		// 	'password' => $data['password']
		// ));
		return $query->row();
	}

	function select_data_by_email($email){
		$query = $this->db->get_where('member', array('email' => $email));
		return $query->row();
	}

	function select_data_by_forget($forget_token){
		$query = $this->db->get_where('member', array('forget_token' => $forget_token));
		return $query->result();
	}

	function update_data_by_forget($email, $forget_token){ //插入forget_token
		$this->db->where('email', $email);
		$this->db->update('member', array(
			'forget_token' => $forget_token
		));
		return $this->db->affected_rows();
	}

	function update_password_by_forget($forget_token, $password){ // 依照forget_token來修改掉密碼
		$this->db->where('forget_token', $forget_token);
		$this->db->update('member', array(
			'password' => $password,
			'forget_token' => ''
		));
		return $this->db->affected_rows();
	}

}