<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
	public function __construct()
	{
		//$this->load->database
		$this->load->database();
		$this->load->library('session');
	}
	function submit_user($name,$email,$password)
	{
		$this->load->helper('url');
		$data = array(
		'uid' => '',
		'name' => $name,
		'email' => $email,
		'password' => $password
		);
		if($this->db->insert('registration', $data))
		{
			echo "1";
			
		}
		else
		{
			echo "-1";
		}
		
   }
   function login_submit($email,$password,$admin)
   {
	   $this -> db -> select('*');
	   $this -> db -> from('registration');
	   $this -> db -> where('email', $email);
	   $this -> db -> or_where('admin', $admin);
	   $this -> db -> where('password',$password);
	   $this -> db -> limit(1);
	   $query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->row_array();
		}
		else
		{
			echo "-1";
		}
   }
   function show_data($email_name)
   {
	   $this -> db -> select('*');
	   $this -> db -> from('registration');
       $this->db -> where('email',$email_name);
	   $this -> db -> limit(1);
       $query = $this->db->get();
       return $query->result();
   }
   //insert into user table
	function insertUser($data)
    {
		return $this->db->insert('user1', $data);
	}
	
	//send verification email to user's email id
	function sendEmail($to_email)
	{
		$from_email = 'team@mydomain.com';
		$subject = 'Verify Your Email Address';
		$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://www.mydomain.com/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';
		
		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.mydomain.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = '********'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes
		$this->email->initialize($config);
		
		//send mail
		$this->email->from($from_email, 'Mydomain');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}
	
	//activate user account
	function verifyEmailID($key)
	{
		$data = array('status' => 1);
		$this->db->where('md5(email)', $key);
		return $this->db->update('user1', $data);
	}
}