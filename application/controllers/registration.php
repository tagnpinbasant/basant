<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Registration extends CI_Controller {
	public function __construct()
		{
			parent::__construct();
			$this->load->model('User_model');
			$this->load->model('Admin_model');
			$this->load->library('session');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->helper('url');
		}
	public function index()
	{
		$data['title']='Registration Form';
		$data['baseurl']=base_url();
		$this->load->view('registration',$data);
	}	
	public function reg_submit()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		//echo $name;
		$this->User_model->submit_user($name,$email,$password);
	}
	public function login()
	{
		$data['title']='Login Form';
		$data['baseurl']=base_url();
		$this->load->view('login',$data);
	}
	public function submit_login()
	{
		$email = $this->input->post('email');
		$password =$this->input->post('password');
		$admin=$this->input->post('email');
		//echo $email;
		$data['userdata'] = $this->User_model->login_submit($email,$password,$admin);
		$this->session->set_userdata('uid',$data['userdata']['uid']);
		//print_r($data);
		//echo $data['userdata']['uid'];
		echo json_encode($data['userdata']);
	}
	public function mydisplay() 
	{
	//echo "hello";
	$data['baseurl']=base_url();
	 $id= $this->input->post('id');
	 //echo $date1;
	$data['single_show'] = $this->Admin_model->show_data_by_id($id);
	//print_r($data['single_show']);
    $this->load->view('delet_data', $data);		
	}	
	public function update_data()
	{
	 //echo "ok";
	 $data['baseurl']=base_url();
	 $id1=$this->input->post('id1');
	 $data['update_show']=$this->Admin_model->show_update_id($id1);
	// print_r($data['update_show']);
	$this->load->view('update-data', $data);	
	}
	public function update_password_data()
	{
	  //echo "ok";
	   $data['baseurl']=base_url();
	 $id_update=$this->input->post('id_update');
	 $data['password_show']=$this->Admin_model->update_password($id_update);
	 //print_r($data['password_show']);
	$this->load->view('update_password', $data);
	}
	public function welcome()
	{
		$data['title']='Welcome';
		$data['baseurl']=base_url();
		$email_name= $this->session->userdata('uid');
		print_r($email_name);
		$data['query']=$this->User_model->show_data($email_name);
		$this->load->view('welcome',$data);
	}
		public function logout()
	{
		$data['baseurl']=base_url();
		$this->session->unset_userdata('uid');
		//redirect(base_url(),'refresh');
		$this->load->view('login',$data);
	}
	public function show_all_data() 
	{
	   $id = $this->uri->segment(3);
	   $data['query'] = $this->Admin_model->show_data(); 
	   $data['single_id'] = $this->Admin_model->show_data_id($id);
	   $this->load->view('admin_welcome', $data); 
    }
	
	public function uploadimage() 
	{
	   $data = array();
	   $this->load->view('uploadimage', $data); 
    }
}		