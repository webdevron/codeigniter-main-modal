<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_m extends CI_Model{


    public function check($table, $arr){
        $query = $this->db->select()
                    ->from($table)
                    ->where($arr)
                    ->get();
        return $query->num_rows() > 0 ? TRUE : FALSE;
    }


    public function count_row($table, $arr = FALSE){
        if(!$arr) return $this->db->count_all($table);
        else{
            $query = $this->db->from($table)->where($arr)->get();
            return $query->num_rows();
        }
    }


    public function del_row($table, $match){
        $this->db->delete($table, $match);
        return $this;
    }


    public function get_many($table, $arr = FALSE){
        $query = ($arr === FALSE) ? $this->db->select()->from($table)->get() : $this->db->select()->from($table)->where($arr)->get();
        return $query->result();
    }


    public function get_row($table, $arr){
        $query = $this->db->select()
                  ->from($table)
                  ->where($arr)
                  ->get();
        return $query->row();
    }


    public function get_col($col, $table, $arr){
        $query = $this->db->select($col)
                  ->from($table)
                  ->where($arr)
                  ->get();
        return $query->result();
    }


    public function resetId($table, $arr){

        // SELECT * from `user` ORDER BY `user_id`; 
        // SET @count = 0;
        // UPDATE `user`  SET `user_id` = @count:= @count + 1;
        // ALTER TABLE `user_id` AUTO_INCREMENT = 1;

        $this->db->where($arr)->delete($table);
        $rows = ($this->count_full($table)+1);
        $q = 'ALTER TABLE '.$table.' AUTO_INCREMENT = '.$rows;
        return $this->_query($q) ? TRUE : FALSE;
    }


    public function save($table, $val){
        $this->db->insert($table, $val);
        return $this->db->insert_id() > 0 ? $this->db->insert_id() : FALSE;
    }


    public function sum_tab($s, $t, $arr){
        $query = $this->db->select_sum($s)
                    ->from($t)
                    ->where($arr)
                    ->get();
        return $query->row();
    }


    public function update_tab($table, $arr, $by = FALSE){
        if(!$by) return $this->db->update($table, $arr) ? TRUE : FALSE;
        else return $this->db->update($table, $arr, $by) ? TRUE : FALSE;   
    }


    public function group_tab($arr){
        $this->db->group_by($arr);
        return $this;
    }


    public function incr_decr($tab, $cell, $operator, $match){
        $this->db->where($match);
        $this->db->set($cell, $cell.$operator, FALSE);
        $this->db->update($tab);
    }


    public function max_val($tab, $cell, $match){
        $query = $this->db
                ->select_max($cell)
                ->where($match)
                ->get($tab);
        return $query->row()->$cell;
    }


    public function min_val($tab, $cell, $match){
        $query = $this->db
                ->select_max($cell)
                ->where($match)
                ->get($tab);
        return $query->row()->$cell;
    }


    public function order_row($by, $s = FALSE){
        $t = $s === FALSE ?'desc' : 'ASC';
        $this->db->order_by($by, $t);
        return $this;
    }


    public function limit_row($limit, $offset = 0){
        $this->db->limit($limit, $offset);
        return $this;
    }


    public function join_tab($table, $match)
    {
        $this->db->join($table, $match);
        return $this;
    }


    public function get_unassigned_crs($crsT, $examExaminerT, $exam)
    {
        $q =$this->db->select()
                     ->from($crsT)
                     ->where(array('course_dept' => $exam->exam_dept, 'course_class'=>$exam->exam_class))
                     ->where('course_status', 1)
                     //->where('course_tab_id NOT IN (SELECT examiner_course FROM '.$examExaminerT.')', NULL, FALSE)
                     ->order_by('course_id')->get();
        return $q->result();
    }


    public function q($q){
        $query = $this->db->query($q);
        return $query->result();
    }


}
