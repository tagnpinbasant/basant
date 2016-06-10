<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{
	public function __construct()
	{
		//$this->load->database
		$this->load->database();
		$this->load->library('session');
	}
	function show_data()
	{
	  $this->db->select("*"); 
	  $this->db->from('registration');
	  $query = $this->db->get();
	  return $query->result();
	 }
	 function show_data_id($data)
	 {
		$this->db->select('*');
		$this->db->from('registration');
		$this->db->where('uid', $data);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function show_data_by_id($id) {
	$condition = "uid =" . "'" . $id . "'";
	$this->db->select('*');
	$this->db->from('registration');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();
	$result = $query->result_array();
	//print_r($result);
  return $result;
	}
	public function show_update_id($id1)
	{
	$rlt = "uid =" . "'" . $id1 . "'";
	$this->db->select('*');
	$this->db->from('registration');
	$this->db->where($rlt);
	$this->db->limit(1);
	$query = $this->db->get();
	$result = $query->result_array();
	//print_r($result);
     return $result;
	}
	public function update_password($id_update)
	{
	   $rlt = "uid =" . "'" . $id_update . "'";
	$this->db->select('*');
	$this->db->from('registration');
	$this->db->where($rlt);
	$this->db->limit(1);
	$query = $this->db->get();
	$result = $query->result_array();
	//print_r($result);
     return $result;
	}
}