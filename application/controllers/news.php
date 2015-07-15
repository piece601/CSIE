<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('news_model');
		$this->asideQuery = $this->aside_model->select_news(); // 左邊欄位
		$this->token = 'news_token'; // 設定權限
	}

	public function index(){
		redirect('news/newslist');
		return true;
	}

	public function view($newsId = NULL){
		if($newsId == NULL){
			redirect('news');
			return false;
		}
		$query = $this->news_model->select_data($newsId); // 把公告撈出來
		$queryFile = $this->news_model->select_newsFile($query->newsId); //把該篇公告包含的檔案撈出
		$this->load->view('news_view', array(
			'query' => $query,
			'queryFile' => $queryFile,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function newslist($newsClass = 'all', $page = 0){ // newsClass是公告分類, page是第幾個頁面

		//載入分頁的class
		$this->load->library('pagination');
		$config['base_url'] = base_url('news/newslist/'.$newsClass.'/');
		$config['total_rows'] = $this->news_model->count_data($newsClass); //計算總共有多少筆資料
		$config['per_page'] = '10'; //設定一頁幾個數量
		$config['first_link'] = '&laquo;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '&raquo;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active disable"><a href="">'; // 當前的
		$config['cur_tag_close'] = '</li>'; // 當前的 結束
		$config['num_tag_open'] = '<li>'; // a連接 的起始
		$config['num_tag_close'] = '</li>'; // a連接 的結束
		// $config['full_tag_open'] = '<li>';
		// $config['full_tag_close'] = '</li>';
		// $config['num_links'] = 2; //下方導航一次顯示左右多幾個
		$config['uri_segment'] = 4; //第二個參數作為導航
		$this->pagination->initialize($config);

		if ($newsClass == 'all'){ // 如果沒newsClass表示全部的公告
			$query = $this->news_model->select_all_data($config['per_page'], $page);
			$query2 = new stdClass();
			$query2->newsClassName = '全部公告';
			$query2->newsClass = '';
		} else {
			$query = $this->news_model->select_data_by_newsClass($newsClass, $config['per_page'], $page);	
			$query2 = $this->news_model->select_category($newsClass); // 把當前的公告類別名稱撈出		
		}

		$this->load->view('newslist', array(
			'query' => $query,
			'query2' => $query2,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function add_news($newsClass = NULL){
		$this->check_auth(); // 權限檢查
		$this->load->library('form_validation'); //啟動驗證模組
		// 以下是驗證規則
		$this->form_validation->set_rules('newsTitle', '公告標題', 'trim|required|xss_clean');
		$this->form_validation->set_rules('newsContent', '公告內容', 'trim|required');
		
		$data['newsAuthor'] = $this->session->userdata('name');
		$data['newsTitle'] = trim($this->input->post('newsTitle', true));
		$data['newsContent'] = trim($this->input->post('newsContent'));
		date_default_timezone_set("Asia/Taipei"); //設定時區
   	$data['newsDate'] = date("Y-m-d", time()); //把時間放進欄位

   	if ($newsClass != NULL){
   		$query2 = $this->news_model->select_category($newsClass); //把類別撈出來
   	} else {
   		$query2 = new stdClass();
   		$query2->newsClassName = '全部公告';
   	}

  	if ($this->form_validation->run() == FALSE) {
  		$query = $this->news_model->select_all_category();
  		$this->load->view('add_news', array(
  			'query' => $query,
  			'query2' => $query2,
  			'asideQuery' => $this->asideQuery,
  			'headerQuery' => $this->headerQuery
  			)); //初始載入頁面,以及 驗證失敗載入頁面
  		return true;
  	} else {
  		$data['newsClass'] = trim($this->input->post('newsClass', true));
			$newsId = $this->news_model->insert_data($data);  //完成新增動作
  		$config["encrypt_name"] = TRUE;
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|zip|rar|xlsx|xls|csv|pdf|txt|doc|docx|ppt'; //上傳文件格式
			$this->load->library('upload',$config); //讀取上傳的Lib
			$newsFileName = $this->input->post('newsFileName'); // 上傳檔案的檔案名稱
			foreach ($_FILES as $key => $value) {
				if( !empty($value['name'])){
					if( !$this->upload->do_upload($key)){
						$this->load->view('failure', array(
							'message' => '上傳失敗，只允許上傳副黨名為'.$config['allowed_types'],
							'headerQuery' => $this->headerQuery
							));
						return false;
					}
					// echo $this->upload->data()['file_name'];
					$data2['newsFilePath'] = 'uploads/'.$this->upload->data()['file_name']; // 把檔案路徑放進去
					$data2['newsFileName'] = $newsFileName[$key]; // 檔案名稱放進去
					$data2['newsId'] = $newsId;
					$this->news_model->insert_data_newsFile($data2);
				}
			}
  		$this->load->view('success', array(
  			'message' => '新增公告成功喲~^^~',
  			'redirectUrl' => 'news/newslist/'.$newsClass,
  			'asideQuery' => $this->asideQuery,
  			'headerQuery' => $this->headerQuery
  		));
  		return true;
  	}
  	return true;
	}

	public function add_newsFile($newsId){
		$this->check_auth(); // 權限檢查
		if($newsId == NULL){
			redirect('news');
			return false;
		}
		$data['newsFileName'] = $this->input->post('newsFileName'); // 把收到的檔案名稱放到陣列裡
		$config["encrypt_name"] = TRUE;
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|zip|rar|xlsx|xls|csv|pdf|txt|doc|docx|ppt'; //上傳文件格式
		$this->load->library('upload', $config); //讀取上傳的Lib
		if( !$this->upload->do_upload() ){
			$this->load->view('failure', array(
				'message' => '上傳失敗，只允許上傳副黨名為'. $config['allowed_types'],
				'headerQuery' => $this->headerQuery
				));
			return false;
		}
		$data['newsId'] = $newsId;
		$data['newsFilePath'] = 'uploads/'.$this->upload->data()['file_name']; // 抓取上傳路徑
		$this->news_model->insert_data_newsFile($data);
		redirect('news/view/'.$newsId);
		return true;
	}

	public function delete_newsFile($newsFileId = NULL, $newsId = NULL){
		$this->check_auth(); // 權限檢查
		if($newsFileId == NULL OR $newsId == NULL){
			redirect();
			return false;
		}
		@unlink($this->news_model->select_newsFile_by_newsFileId($newsFileId)->newsFilePath); // 實際刪除公告內檔案
		$this->news_model->delete_newsFile($newsFileId);
		redirect('news/view/'.$newsId);
		return true;
	}

	public function delete_news($newsClass = NULL, $newsId = NULL){
		$this->check_auth(); // 權限檢查
		if( $newsClass == NULL OR $newsId == NULL){
			redirect();
			return false;
		}
		$this->news_model->delete_news($newsId); // 刪除公告
		$query = $this->news_model->select_newsFile($newsId); // 把該篇公告檔案撈出
		foreach ($query as $key => $value) {
			@unlink($value->newsFilePath); // 實際刪除該篇公告所有檔案
		}
		redirect('news/newslist/'.$newsClass);
		return true;
	}

	public function edit_news($newsId){
		$this->check_auth(); // 權限檢查
		if($newsId == NULL){
			redirect('news');
			return false;
		}
		$query = $this->news_model->select_data($newsId); // 把這筆資料撈出
		$query2 = $this->news_model->select_all_category(); // 公告分類選單
		$this->load->view('edit_news', array(
			'query' => $query,
			'query2' => $query2,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function editing_news($newsId = NULL){
		$this->check_auth(); // 權限檢查
		if($newsId == NULL){
			redirect('news/view/'.$newsId);
			return false;
		}
		$data['newsId'] = $newsId;
		$data['newsTitle'] = $this->input->post('newsTitle');
		$data['newsContent'] = $this->input->post('newsContent');
		$data['newsClass'] = $this->input->post('newsClass');
		$this->news_model->update_data($data);
		redirect('news/view/'.$newsId);
		return true;
	}

}

/* End of file */