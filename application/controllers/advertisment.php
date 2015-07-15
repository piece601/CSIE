<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisment extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('advertisment_model');
		$this->asideQuery = $this->aside_model->select_advertisment(); // 左邊欄位
		$this->token = 'ad_token'; // 設定token名稱
		$this->check_auth(); // 檢查權限
	}

	public function index(){ // 廣告管理
		$query = $this->advertisment_model->select_ad_data();
		$this->load->view('advertisment', array(
			'query' => $query,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function add_advertisment(){
		$data['logoTitle'] = $this->input->post('logoTitle');
		$data['logoUrl'] = $this->input->post('logoUrl');

		$config["encrypt_name"] = TRUE;
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg'; //上傳文件格式

		$this->load->library('upload',$config); //讀取上傳的Lib
		if ($this->upload->do_upload()){ //檔案成功上傳
			$data['logoPath'] = 'uploads/'.$this->upload->data()['file_name'];
		} else {
			$this->load->view('failure', array(
				'message' => '上傳失敗，附黨名只允許為'.$config['allowed_types'],
				'headerQuery' => $this->headerQuery
				));
			return false;
		}
		$this->advertisment_model->insert_ad_data($data);
		redirect('advertisment');
		return true;
	}

	public function delete_advertisment($adId){
		$query = $this->advertisment_model->select_ad_data_by_adId($adId);
		@unlink($query->logoPath); // 實際刪除檔案
		$this->advertisment_model->delete_ad_data($adId);
		redirect('advertisment');
		return true;
	}

	public function edit_advertisment($adId){
		$query = $this->advertisment_model->select_ad_data_by_adId($adId);
		$this->load->library('form_validation'); //啟動驗證模組
		// 以下是驗證規則
		$this->form_validation->set_rules('logoTitle', 'logo名稱', 'trim|required|xss_clean');
		$this->form_validation->set_rules('logoUrl', '網址', 'trim|required');
		$data['logoTitle'] = trim($this->input->post('logoTitle', true));
		$data['logoUrl'] = trim($this->input->post('logoUrl', true));
		$data['adId'] = trim($adId);
  	if ($this->form_validation->run() == FALSE){
  		$this->load->view('edit_advertisment', array(
  			'query' => $query,
  			'asideQuery' => $this->asideQuery,
  			'headerQuery' => $this->headerQuery
  			)); //初始載入頁面,以及 驗證失敗載入頁面
  		return true;
  	} else {
  		$config["encrypt_name"] = TRUE;
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg'; //上傳文件格式

			$this->load->library('upload',$config); //讀取上傳的Lib
			if ($this->upload->do_upload()){ //檔案成功上傳
				@unlink($query->logoPath); // 刪除掉舊的檔案
				$data['logoPath'] = 'uploads/'.$this->upload->data()['file_name'];
			} 
			// else {
			// 	$this->load->view('failure', array(
			// 		'message' => '上傳失敗，附黨名只允許為'.$config['allowed_types']
			// 		));
			// 	return false;
			// }
			$this->advertisment_model->update_ad_data($data);  //完成新增動作
	  		$this->load->view('success',array(
	  			'message' => '修改廣告成功喲~^^~',
	  			'redirectUrl' => 'advertisment',
	  			'asideQuery' => $this->asideQuery,
	  			'headerQuery' => $this->headerQuery
	  		));
  		return true;
  	}
  	return true;

	}
}