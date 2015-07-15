<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function select_data($newsId){
		$query = $this->db->get_where('news', array('newsId' => $newsId));
		return $query->row();
	}

	function select_all_data($num, $offset){ // num是一次取多少資料, offset是從第幾比開始取
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('news_category', 'news.newsClass = news_category.newsClass');
		$this->db->order_by("newsId","desc");//由大到小排序
		$this->db->limit($num, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	function select_newsFile($newsId){ // 把該篇公告的檔案撈出
		$query = $this->db->get_where('news_file', array('newsId' => $newsId));
		return $query->result();
	}

	function select_newsFile_by_newsFileId($newsFileId){ // 檔案PK撈出檔案資料
		$query = $this->db->get_where('news_file', array('newsFileId' => $newsFileId));
		return $query->row();
	}

	function select_data_by_newsClass($newsClass, $num, $offset){ // num是一次取多少資料, offset是從第幾比開始取
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('news_category', 'news.newsClass = news_category.newsClass');
		$this->db->order_by("newsId","desc");//由大到小排序
		$this->db->where('news.newsClass', $newsClass);
		$this->db->limit($num, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	function select_category($newsClass){
		$query = $this->db->get_where('news_category', array('newsClass' => $newsClass));
		return $query->row();
	}

	function select_all_category(){ // 把所有news_category撈出來
		$query = $this->db->get('news_category');
		return $query->result();
	}

	function insert_data($data){ // 新增一筆公告
		$this->db->insert('news', $data);
		$query = $this->db->insert_id(); // 回傳插入時候的id
		return $query;
	}

	function insert_data_newsFile($data){ // 新增一筆公告內的檔案
		$this->db->insert('news_file', $data);
		return true;
	}

	function delete_newsFile($newsFileId){ // 刪除公告的檔案
		$this->db->delete('news_file', array('newsFileId' => $newsFileId));
		return true;
	}

	function delete_news($newsId){ //  刪除公告
		$this->db->delete('news', array('newsId' => $newsId));
		return true;
	}

	function update_data($data){ // 更新公告
		$this->db->where('newsId', $data['newsId']);
		$this->db->update('news', $data);
		return true;
	}

	function count_data($newsClass = 'all'){ // 如果是all 就表示全部公告
		if($newsClass == 'all'){
			return $this->db->count_all('news');
		}
		$this->db->where('newsClass', $newsClass);
		$this->db->from('news');
		return $this->db->count_all_results();
	}

}