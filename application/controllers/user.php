<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	private function mailing($email = NULL, $forget_token = NULL){
		$this->load->library('email');
		$config = array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.gmail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'piececustom',
		    'smtp_pass' => 'piececustom1234567890',
		    'mailtype'  => 'html', 
		    'charset'   => 'utf-8',
		    'newline' => "\r\n"
		);
		$this->email->initialize($config);

    $this->email->from('piececustom@gmail.com', '系統');
    $this->email->to($email); 

    $this->email->subject('忘記密碼 - 系統寄發請勿回復');
    $str = '<a href="'.base_url('user/change/'.$forget_token).'">點擊此網址，來修改密碼</a>';
    $this->email->message($str);
    $this->email->send();
	}

	public function index(){
		$this->mailing();
		return false;
	}

	public function change($forget_token = NULL){ // 更改密碼，透過forget_token
		if ($forget_token == NULL) {
			redirect();
			return false;
		}

		if ( ! $data = $this->input->post('data')){ // 如果沒有data進來
			if ( ! empty($this->user_model->select_data_by_forget($forget_token))){ // 檢查有沒有這個forget_token
				$this->load->view('user_change', array(
					'asideQuery' => $this->asideQuery,
					'headerQuery' => $this->headerQuery
					));
				return true;
			} else {
				$this->load->view('failure', array(
					'message' => '抱歉您的驗證碼已經過期，或無效唷，請重新寄送驗證碼一次',
					'asideQuery' => $this->asideQuery,
					'headerQuery' => $this->headerQuery
					));
				return false;
			}
		}		

		if ( $data['password'] != $data['passwordwrt'] ){ // 兩次密碼不相等
			$this->load->view('failure', array(
				'message' => '兩次密碼不相等',
				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
				));
			return false;
		}

		if ( ! $this->user_model->update_password_by_forget($forget_token, $data['password'])){ // 如果更新密碼失敗
			$this->load->view('failure', array(
				'message' => '系統忙碌，請再試一次',
				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
				));
			return false;
		}
		$this->load->view('success', array(
			'message' => '密碼更新成功',
			'redirectUrl' => '',
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
		return true;
	}

	public function login(){
		$data['account'] = $this->input->post('account');
		$data['password'] = $this->input->post('password');
		
		$query = $this->user_model->select_data($data);
		if( ! $query){ // 登入失敗
			$this->load->view('failure', array(
				'message' => '帳號或者密碼錯誤囉。',
				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
				));
			return false;
		}
		$this->session->set_userdata($query); // 把權限存起來
		// print_r($this->session->all_userdata());
		// if($this->session->userdata('member_token')){
		// 	echo "fuck";
		// }
		redirect();
		return true;
	}

	public function logout(){ // 登出
		$this->session->sess_destroy();
		redirect();
		return true;
	}

	public function forget(){
		$this->load->library('form_validation'); //啟動驗證模組
		// 以下是驗證規則
		$this->form_validation->set_rules('email', '信箱', 'trim|required|valid_email|xss_clean');

  	if ($this->form_validation->run() == FALSE){
  		$this->load->view('forget', array(
  			'asideQuery' => $this->asideQuery,
  			'headerQuery' => $this->headerQuery
  			)); //初始載入頁面,以及 驗證失敗載入頁面
  		return true;
  	}
		// print_r($this->user_model->select_data_by_email($this->input->post('email')));
		if ( ! $query = $this->user_model->select_data_by_email($this->input->post('email'))){
			$this->load->view('failure', array(
				'message' => '查無此資料',
				'asideQuery' => $this->asideQuery,
  			'headerQuery' => $this->headerQuery
  		));
  		return false;
		}
		
		$forget_token = md5($query->password.time());
		if ( ! $this->user_model->update_data_by_forget($query->email, $forget_token)){
			$this->load->view('failure', array(
				'message' => '系統忙碌中，請再試一次',
				'asideQuery' => $this->asideQuery,
				'headerQuery' => $this->headerQuery
				));
			return false;
		}

		$this->mailing($query->email, $forget_token); // 寄發忘記密碼信

		$this->load->view('success', array(
			'message' => '已經驗證信寄送到您信箱囉，請到信箱收信',
			'redirectUrl' => '',
			'asideQuery' => $this->asideQuery,
			'headerQuery' => $this->headerQuery
			));
  	return true;
	}

}

/* End of file */