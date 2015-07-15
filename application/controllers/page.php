<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('page_model');
		$this->asideQuery = $this->aside_model->select_page(); // 左邊欄位
		$this->token = 'page_token'; // 設定權限
	}

	private function select_page_category($pageClass){ //把分頁內的子頁面撈出來
		$this->load->model('aside_model');
		$this->asideQuery = $this->aside_model->select_page_category($pageClass);
		return true;
	}

	public function index(){
		$this->check_auth(); // 權限檢查
		$query = $this->page_model->select_all_pageClassName();
		$this->load->view('page_manage', array(
			'query' => $query,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function add_category(){
		$this->check_auth(); // 權限檢查
		$data['pageClassName'] = $this->input->post('pageClassName');
		// do {
		// 	$data['pageClass'] = substr(md5(uniqid(rand(), true)), 0, 6);
		// } while ($this->page_model->select_pageClassName_by_pageClass($data['pageClass']));
		$this->page_model->insert_data_category($data);
		redirect('page');
		return true;
	}

	public function add_page($pageClass = NULL){
		$this->check_auth(); // 權限檢查
		if($pageClass == NULL){
			redirect('page');
			return false;
		}
		$this->select_page_category($pageClass); //aside專用

		$this->load->library('form_validation'); //啟動驗證模組
		// 以下是驗證規則
		$this->form_validation->set_rules('pageName', '頁面名稱', 'trim|required|xss_clean');
	  	$this->form_validation->set_rules('pageContent', '頁面內容', 'trim|required');

	  	$data['pageClass'] = trim($pageClass);
		$data['pageName'] = trim($this->input->post('pageName', true));
		$data['pageContent'] = trim($this->input->post('pageContent'));

	  	if ($this->form_validation->run() == FALSE){
	  		$this->load->view('add_page', array(
	  			'asideQuery' => $this->asideQuery,
	  			'headerQuery' => $this->headerQuery
	  			)); //初始載入頁面,以及 驗證失敗載入頁面
	  	} else {
				$this->page_model->insert_data($data);  //完成新增動作
	  		$this->load->view('success',array(
	  			'message' => "頁面新增成功喲~^^~",
	  			'redirectUrl' => 'page/category/'.$pageClass,
	  			'asideQuery' => $this->asideQuery,
	  			'headerQuery' => $this->headerQuery
	  		));
	  		return true;
	  	}
	}

	public function view($pageId = NULL){
		if($pageId == NULL){
			redirect('page');
			return false;
		}
		$query = $this->page_model->select_data_by_pageId($pageId);
		$this->select_page_category($query->pageClass); //aside專用
		$this->load->view('page_view', array(
			'query' => $query,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function category($pageClass = NULL){
		$this->check_auth(); // 權限檢查
		if($pageClass == NULL){
			redirect('page');
			return false;
		}
		$query = $this->page_model->select_data($pageClass); // 把所有同分類頁面撈出
		$page_category = $this->page_model->select_pageClassName($pageClass); // 把類別中文名撈出
		$this->load->view('page_category', array(
			'query' => $query,
			'page_category' => $page_category,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function delete_category($pageClass = NULL){ // 刪除分類，同時刪除同分類檔案資料
		$this->check_auth(); // 權限檢查
		if($pageClass == NULL){
			redirect('page/');
			return false;
		}
		$query = $this->page_model->select_data($pageClass);
		foreach ($query as $key => $value) { // 刪除所有同分類的頁面
			$this->page_model->delete_page($value->pageId); 
		}
		$this->page_model->delete_category($pageClass); // 從資料庫刪除分類
		redirect('page');
		return true;
	}

	public function delete_page($pageClass = NULL, $pageId = NULL){
		$this->check_auth(); // 權限檢查
		if($pageClass == NULL || $pageId == NULL){
			redirect('page/category/'.$pageClass);
			return false;
		}
		$this->page_model->delete_page($pageId);
		redirect('page/category/'.$pageClass);
		return true;
	}

	public function edit_page($pageId = NULL){
		$this->check_auth(); // 權限檢查
		if($pageId == NULL){
			redirect('page');
			return false;
		}
		$query = $this->page_model->select_data_by_pageId($pageId);
		$this->load->view('edit_page', array(
			'query' => $query,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function editing_page($pageClass = NULL, $pageId = NULL){
		$this->check_auth(); // 權限檢查
		if($pageClass == NULL || $pageId == NULL){
			redirect('page/category/'.$pageClass);
			return false;
		}
		$data['pageClass'] = $pageClass;
		$data['pageId'] = $pageId;
		$data['pageName'] = trim($this->input->post('pageName', true));
		$data['pageContent'] = trim($this->input->post('pageContent'));
		$this->page_model->update_data($data);
		redirect('page/category/'.$pageClass);
		return true;
	}
}