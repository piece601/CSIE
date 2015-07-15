<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('file_model');
		$this->token = 'file_token'; // 設定權限
	}

	public function add_category(){
		$this->check_auth(); // 權限檢查
		$data['fileClassName'] = $this->input->post('fileClassName');
		$this->file_model->insert_data_category($data);
		redirect('file');
		return true;
	}

	public function index(){
		$this->check_auth(); // 權限檢查
		$query = $this->file_model->select_all_fileClassName();
		$this->load->view('file_manage', array(
			'query' => $query,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function download($fileClass = NULL){
		if($fileClass == NULL){
			redirect('file');
			return false;
		}
		$query = $this->file_model->select_data_by_fileClass($fileClass);
		$file_category = $this->file_model->select_fileClassName($fileClass);
		$this->load->view('download', array(
			'query' => $query,
			'file_category' => $file_category,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;

	}

	public function delete_file($fileClass = NULL, $fileId = NULL){
		$this->check_auth(); // 權限檢查
		if($fileId == NULL || $fileClass == NULL){
			redirect('file/download/'.$fileClass);
			return false;
		}
		$query = $this->file_model->select_by_fileId($fileId);
		@unlink($query->filePath);
		$this->file_model->delete_data($fileId);
		redirect('file/download/'.$fileClass);
		return true;
	}

	public function delete_category($fileClass = NULL){ // 刪除分類，同時刪除同分類檔案資料
		$this->check_auth(); // 權限檢查
		if($fileClass == NULL){
			redirect('file');
			return false;
		}
		$query = $this->file_model->select_data_by_fileClass($fileClass); // 找到所有fileClass同類的資料
		foreach ($query as $key => $value) {
			@unlink($value->filePath); // 刪除掉檔案
			$this->file_model->delete_data($value->fileId); // 刪除掉資料庫的資料
		}
		$this->file_model->delete_category($fileClass); // 從資料庫刪除分類
		redirect('file');
		return true;
	}

	public function upload($fileClass = NULL){
		$this->check_auth(); // 權限檢查
		if($fileClass == NULL){
			redirect('file');
			return false;
		}
		$query = $this->file_model->select_fileClassName($fileClass);
		$this->load->view('upload', array(
			'query' => $query,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function uploading($fileClass = NULL){
		$this->check_auth(); // 權限檢查
		if($fileClass == NULL){
			redirect('file');
			return false;
		}
		$data['fileClass'] = trim($this->input->post('fileClass', true));
		$data['fileName'] = trim($this->input->post('fileName', true));
		$config["encrypt_name"] = TRUE;
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|zip|rar|xlsx|xls|csv|pdf|txt|doc|docx|ppt'; //上傳文件格式

		$this->load->library('upload', $config); // 讀取上傳的Lib
		if ($this->upload->do_upload()) { // 檔案成功上傳
			$data['filePath'] = 'uploads/'.$this->upload->data()['file_name'];
		} else {
			$this->load->view('failure', array(
				'message' => '上傳失敗，附黨名只允許為'.$config['allowed_types'],
				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
				));
			return false;
		}
		$this->file_model->insert_data($data); // 將上傳成功的資料寫入資料庫
		redirect('file/download/'.$fileClass);
		return true;
	}
}