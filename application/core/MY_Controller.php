<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $asideQuery = NULL; // 左方navigation的array
	protected $headerQuery = NULL; // 上方navigation的array
	protected $token = NULL; // 檢查登入用的token

	function __construct(){
		parent::__construct();
		$this->header(); // 上方選單導航
		$this->aside(); // 左方選單導航
	}

	protected function header(){ // 上方navigation
		$this->load->model('header_model');
		$this->headerQuery = $this->header_model->select_header_data_by_page_category();
		return true;
	}

	protected function aside(){ // 左邊navigation
		$this->load->model('aside_model');
		$this->asideQuery = $this->aside_model->select_file(); // 左邊navigation若在各個controller的construct時候未設定，就會預設撈出檔案navigation
		return true;
	}

	protected function check_auth(){ // 檢查登入
		if ($this->token === NULL) { // 判斷token是否有設定，個群組權限不同而有不同
			echo '權限token尚未設定，請在Controller的__construct()裡面建立一個 $this->token = \'token名稱\'';
			exit();	// 把整個程式關掉
		}
		if( ! $this->session->userdata($this->token)){
			redirect();
			return false;
		}
		return true;
	}

}

/* End of file */