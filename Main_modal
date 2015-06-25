<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_m extends CI_Model{

	public function check($table, $arr){
		$query = $this->db->from($table)
						  ->where($arr)
						  ->get();
		return $query->num_rows() > 0 ? TRUE : FALSE;
	}

	public function submit($table, $val){
		$this->db->insert($table, $val);
		return $this->db->insert_id();
	}

	public function get_row($table, $key) {
		$query = $this->db->select()
						  ->from($table)
						  ->where($key)
						  ->get();
		return $query->row();
	}

	public function get_many($table, $arr){
		$query = $this->db->select()
						  ->from($table)
						  ->where($arr)
						  ->get();
		return $query->result();
	}

	public function get_all($table) {
		$query = $this->db->select()
						  ->from($table)
						  ->get();
		return $query->result();
	}

	public function get_like($table, $arr){
		$query = $this->db->select()
						  ->from($table)
						  ->like($arr)
						  ->get();
		return $query->result();
	}



	public function update_by($table, $arr, $key){
		$this->db->update($table, $arr, $key);
		return TRUE;
	}

	public function update_all($table, $arr, $key){
		$this->db->update($table, $arr, $key);
		return TRUE;
	}

	public function count_all($table){
		return $this->db->count_all($table);
	}

	public function count_by($table, $arr){
		$query = $this->db->from($table)
						  ->where($arr)
						  ->get();
		return $query->num_rows();
	}


	// ================= OPERATIONAL FUNCTIONS ================= //
	public function order($by, $s = FALSE){
		$t = $s === FALSE ? 'ASC' : 'desc';
		$this->db->order_by($by,$t);
		return $this;
	}

	public function limit($limit, $offset = 0){
		$this->db->limit($limit, $offset);
		return $this;
	}

	public function join($table, $match){
		$this->db->join($table, $match);
		return $this;
	}

	public function delete($table, $match){
		$this->db->delete($table, $match);
		return $this;
	}

	public function _query($q){
		$query = $this->db->query($q);
		return $query->result();
	}

}
