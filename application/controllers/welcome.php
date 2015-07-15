<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->token = 'ad_token'; // 設定token名稱
	}

	public function index(){
		$this->load->model('advertisment_model'); // 載入廣告模組
		$adQuery = $this->advertisment_model->select_ad_data(); // 撈出所有廣告，放到右方側邊欄
		$this->load->view('index', array(
			'adQuery' => $adQuery,
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function select_data_json($newsClass = NULL){ // 首頁的公告
		$this->load->model('news_model');
		if($newsClass == NULL){
			$query = $this->news_model->select_all_data(10, 0); // 取10比資料, 從第0筆開始取
		} else {
			$query = $this->news_model->select_data_by_newsClass($newsClass, 10, 0); // 取10比資料, 從第0筆開始取
		}
		$count = 0;
		foreach ($query as $key => $value) {
			$data[$count]['newsDate'] = $value->newsDate;
			$data[$count]['newsTitle'] = $value->newsTitle;
			$data[$count]['newsId'] = $value->newsId;
			$data[$count]['newsClass'] = $value->newsClass;
			$data[$count]['newsClassName'] = $value->newsClassName;
			$count++;
		}
		$json_string = json_encode($data);
		echo($json_string);
		return true;
	}

}

/* End of file */