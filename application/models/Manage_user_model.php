<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_user_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getPdfData() {
        $this->db->select('username, full_name, role', FALSE);
        $this->db->from('feedback_users');
        $this->db->order_by("username");
        $query=$this->db->get();
        return $query->result();
    }
    public function checkUser($username) {
        $this->db->select("username");
        $this->db->from("feedback_users");
        $this->db->where("username", $username);
        return $this->db->get()->row();
    }
    public function insertUser( $data) {
        $this->db->insert('feedback_users',$data);
    }
    public function getUsers() {
        $this->db->select("*");
        $this->db->from("feedback_users");
        $this->db->order_by("username");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getUserById($user_id) {
        $this->db->select("*");
        $this->db->from("feedback_users");
        $this->db->where("id", $user_id);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function updateUser($uid, $data) {
        $this->db->where('id',$uid);
        $this->db->update('feedback_users', $data);
    }
    public function deleteUserById($user_id) {
        $this->db->where('id', $user_id);
        $this->db->delete('feedback_users');
    }

    function __destruct() {
        $this->db->close();
    }

}