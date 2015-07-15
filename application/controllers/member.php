<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('member_model');
		$this->asideQuery = $this->aside_model->select_group(); // 左邊欄位
		$this->token = 'member_token'; // 設定權限
		$this->check_auth(); //檢查權限
	}

	// 新增成員
	public function add_member(){ 

		$this->load->model('group_model');
		$query = $this->group_model->select_all_data(); // 把所有群組都撈出來

		$this->load->library('form_validation'); //啟動驗證模組
		// 以下是驗證規則
		$this->form_validation->set_rules('account', '帳號', 'trim|required|min_length[6]|xss_clean');
		$this->form_validation->set_rules('password', '密碼', 'trim|required|min_length[6]|xss_clean');
  	$this->form_validation->set_rules('passwordrt', '重複密碼', 'trim|required|matches[password]|min_length[6]|xss_clean');
		$this->form_validation->set_rules('email', '信箱', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('name', '姓名', 'trim|required|max_length[20]|xss_clean');
	  	// $this->form_validation->set_rules('telephone', '電話號碼', 'trim|required|min_length[8]|numeric|xss_clean');
	  	// $this->form_validation->set_rules('address', '地址', 'trim|required|min_length[5]|xss_clean');
	  	// $this->form_validation->set_rules('region', '地區', 'trim|required|min_length[5]|xss_clean');

		$data['account'] = trim($this->input->post('account', true));
		$data['password'] = trim($this->input->post('password', true));
		$data['email'] = trim($this->input->post('email', true));
		$data['name'] = trim($this->input->post('name', true));
		$data['groupId'] = trim($this->input->post('groupId', true));
		date_default_timezone_set("Asia/Taipei"); //設定時區
   	$data['createTime'] = date("Y-m-d H:i:s", time()); //把時間放進欄位
		// $data['telephone'] = trim($this->input->post('telephone', true));
		// $data['address'] = trim($this->input->post('address', true));
		// $data['region'] = trim($this->input->post('region', true));

	  	if ($this->form_validation->run() == false){
	  		$this->load->view('add_member', array(
	  			'query' => $query,
	  			'asideQuery' => $this->asideQuery,
	  			'headerQuery' => $this->headerQuery
	  			)); //初始載入頁面,以及 驗證失敗載入頁面
	  		return true;
	  	} else {
			if($this->member_model->check_user_exist($data)){
				$this->load->view('failure', array(
					'message' => '成員已經存在囉。',
					'asideQuery' => $this->asideQuery,
					'headerQuery' => $this->headerQuery
				));
				return false;
			}
			$this->member_model->insert_data($data);  //完成新增動作
	  		$this->load->view('success',array(
	  			'message' => '新增成員成功喲~^^~',
	  			'redirectUrl' => 'member',
	  			'asideQuery' => $this->asideQuery,
	  			'headerQuery' => $this->headerQuery
	  		));
	  		return true;
	  	}
	  	return true;
	}

	// 刪除成員
	public function delete_member($account = NULL){
		if($account == NULL){
			redirect('member');
			return false;
		}
		$this->member_model->delete_data_by_account($account);
		redirect('member');
		return true;
	}

	// 編輯成員權限
	public function edit_member($account = NULL){
		if($account == NULL){
			redirect('member');
			return false;
		}
		$memberQuery = $this->member_model->select_data_by_account($account); //把單筆成員資料撈出
		$this->load->model('group_model');
		$query = $this->group_model->select_all_data(); // 把所有群組都撈出來
		$this->load->view('edit_member', array(
			'query' => $query,
			'memberQuery' => $memberQuery,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function editing_member(){
		if( !$this->input->post('account')){ //判斷有無賬戶輸入
			redirect('member');
			return false;
		}
		date_default_timezone_set("Asia/Taipei"); //設定時區
   	$data['createTime'] = date("Y-m-d H:i:s", time()); //把時間放進欄位
		$data['account'] = $this->input->post('account', true);
		$data['email'] = $this->input->post('email', true);
		$data['groupId'] = $this->input->post('groupId', true);
		if( $this->input->post('password') != ''){ //如果密碼不為空 就表示有修改要存到data裡面進行更新
			$data['password'] = $this->input->post('password', true);
		}
		print_r($data);
		if( !$this->member_model->update_data($data) ){
			$this->load->view('failure', array(
				'message' => '更新帳號失敗，可能系統有問題',
				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
				));
			return false;
		}
		$this->load->view('success', array(
			'message' => '更新帳號成功喲！',
			'redirectUrl' => 'member',
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	// 顯示群組成員
	public function show_member($groupId = NULL){
		if($groupId == NULL){
			redirect('member');
			return false;
		}
		$data['groupId'] = $groupId;
		$query = $this->member_model->select_data_group_id($data); // 撈出群組內所有成員
		$this->load->model('group_model');
		$query2 = $this->group_model->select_data_group_id($data); // 撈出群組中文名
		$this->load->view('show_member', array(
			'query' => $query,
			'query2' => $query2,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function search_member(){
		$searchName = $this->input->post('searchName');
		$query = $this->member_model->select_all_data_use_like($searchName);
		$this->load->view('search_member', array(
			'query' => $query,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function upload_member_list(){
		$data['groupId'] = $this->input->post('groupId'); // 把群組id放進去
		$config["encrypt_name"] = TRUE;
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls|xlsx|csv'; //上傳文件格式
		$this->load->library('upload',$config); //讀取上傳的Lib

		if ($this->upload->do_upload()) //成功檔案要上傳
		{
			$arr = $this->upload->data();		
		} else {
			$this->load->view('failure',array(
				'message' => '新增成員失敗Q_Q..檔案副黨名必須為'.$config['allowed_types'],
				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
				));
			return false;
		}
		$this->load->library('PHPExcel');
		$this->load->library('PHPExcel/IOFactory');
		$reader = IOFactory::load("./uploads/$arr[file_name]");
		$sheet = $reader->getActiveSheet();

		$query = $this->member_model->select_all_account(); // 先把所有帳號撈出來
		for ($i = 1; $i <= $sheet->getHighestRow(); $i++) { // 判斷所有帳號有沒有衝突到
			foreach ($query as $key => $value) {
				if ($value->account == $sheet->getCell('A'.$i)->getValue()){
					@unlink("./uploads/$arr[file_name]"); // 衝突到先把上傳的excel刪除
					$this->load->view('failure', array(
						'message' => '帳號'.$value->account.'已經存在，請確保excel內的帳號沒有衝突',
						'asideQuery' => $this->asideQuery,
						'headerQuery' => $this->headerQuery
						));
					return false;
				}
			}
		}
		date_default_timezone_set("Asia/Taipei"); //設定時區
		for ($i = 1; $i <= $sheet->getHighestRow(); $i++) { // 把每一筆excel的資料新增到SQL
			$data['account'] = $sheet->getCell('A'.$i)->getValue();
			$data['password'] = $sheet->getCell('B'.$i)->getValue();
			$data['name'] = $sheet->getCell('C'.$i)->getValue();
			$data['email'] = $sheet->getCell('D'.$i)->getValue();
			$data['createTime'] = date("Y-m-d H:i:s", time()); //把時間放進欄位
			$this->member_model->insert_data($data);
		}
     	@unlink("./uploads/$arr[file_name]");
     	$this->load->view('success',array(
     		'message' => '新增成員成功^_^',
     		'redirectUrl' => 'member',
     		'asideQuery' => $this->asideQuery,
     		'headerQuery' => $this->headerQuery
     		));
		return true;
		// $this->load->view('')
	}

	public function index(){
		$query = $this->member_model->select_all_data();
		$this->load->model('group_model');
		$group = $this->group_model->select_all_data(); // 把所有群組都撈出來，大量新增用的
		$this->load->view('member',array(
			'query' => $query,
			'group' => $group,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
		));
		return true;
	}

}

/* End of file */