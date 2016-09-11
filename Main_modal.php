<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_m extends CI_Model{

	public function check($table, $arr){
		$query = $this->db->select()
						  ->from($table)
						  ->where($arr)
						  ->get();
		return $query->num_rows() > 0 ? TRUE : FALSE;
	}



	public function submit($table, $val){
		$this->db->insert($table, $val);
		return $this->db->insert_id() > 0 ? TRUE : FALSE;
	}



	public function get_all($table){
		$query = $this->db->select()
						  ->from($table)
						  ->get();
		return $query->result();
	}

	public function get_many($table, $arr){
		$query = $this->db->select()
						  ->from($table)
						  ->where($arr)
						  ->get();
		return $query->result();
	}

	public function get_row($table, $arr){
		$query = $this->db->select()
						  ->from($table)
						  ->where($arr)
						  ->get();
		return $query->row();
	}



	public function update_all($table, $arr){
		return $this->db->update($table, $arr) ? TRUE : FALSE;
	}
 
	public function update_by($table, $arr, $by){
		return $this->db->update($table, $arr, $by) ? TRUE : FALSE;
	}



	public function count_rows($table){
		return $this->db->count_all($table);
	}

	public function count_by($table, $arr){
		$query = $this->db->from($table)
						  ->where($arr)
						  ->get();
		return $query->num_rows();
	}

	public function _group($arr){
		$this->db->group_by(array("title", "date"));
		return $this;
	}


	public function _order($by, $s = FALSE){
		$t = $s === FALSE ? 'ASC' : 'desc';
		$this->db->order_by($by, $t);
		return $this;
	}

	public function _limit($limit, $offset = 0){
		$this->db->limit($limit, $offset);
		return $this;
	}

	public function _join($table, $match){
		$this->db->join($table, $match);
		return $this;
	}

	public function _delete($table, $match){
		$this->db->delete($table, $match);
		return $this;
	}

	public function _query($q){
		$query = $this->db->query($q);
		return $query->result();
	}

}
