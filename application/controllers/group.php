<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('group_model');
		$this->asideQuery = $this->aside_model->select_group(); // 左邊欄位
		$this->token = 'group_token'; // 設定權限
		$this->check_auth(); // 權限檢查
	}

	public function index(){
		$query = $this->group_model->select_all_data();
		$this->load->view('group', array(
			'query' => $query,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
		));
		return TRUE;
	}

	public function add_group(){
		$data['groupName'] = $this->input->post('groupName', TRUE);
		$this->group_model->insert_data($data);
		redirect('group');
		return TRUE;
	}

	public function delete_group($groupId = NULL){
		if($groupId == NULL){
			redirect('group');
			return FALSE;
		}
		if($groupId == 1){ //不允許修改管理員
			$this->load->view('failure', array(
				'message' => '管理員是最高權限，無法刪除管理員權限。',
				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
			));
			return FALSE;
		}
		$data['groupId'] = $groupId;
		$this->load->model('member_model');
		$query = $this->member_model->select_data_group_id($data);
		foreach ($query as $key => $value) {
			$this->member_model->delete_data_by_account($value->account);
		}
		$this->group_model->delete_data($data); // 刪除掉群組
		redirect('group');
		return TRUE;
	}

	public function edit_group($groupId = NULL){
		if($groupId == NULL){
			redirect('group');
			return FALSE;
		}
		if($groupId == 1){ //不允許修改管理員
			$this->load->view('failure', array(
				'message' => '管理員是最高權限，無法修改管理員權限。',
				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
			));
			return FALSE;
		}
		$data['groupId'] = $groupId;
		$query = $this->group_model->select_data_group_id($data); // 抓出指定groupId的值所有資料
		$this->load->view('edit_group', array(
			'query' => $query,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
		));
		return TRUE;
 	}

 	public function editing_group(){
 		$data['groupId'] = $this->input->post('groupId');
 		$data['groupName'] = $this->input->post('groupName');
 		$data['news_token'] = $this->input->post('news_token');
 		$data['group_token'] = $this->input->post('group_token');
 		$data['member_token'] = $this->input->post('member_token');
 		$data['file_token'] = $this->input->post('file_token');
 		$data['page_token'] = $this->input->post('page_token');
 		$data['ad_token'] = $this->input->post('ad_token');
 		$query = $this->group_model->update_data($data);
 		if( ! $query){
 			$this->load->view('failure', array(
 				'message' => '更新失敗，請確保都輸入正確。',
 				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
			));
 			return FALSE;
 		}
 		$this->load->view('success', array(
 			'message' => '更新成功喲。',
 			'redirectUrl' => 'group',
 			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
		));
		return TRUE;
 	}

}

/* End of file */