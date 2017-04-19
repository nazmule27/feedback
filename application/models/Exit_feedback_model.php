<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exit_feedback_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
        if(empty($this->session->userdata('role'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    public function checkGivenExitFeedback($sid) {
        $this->db->select('exit_status');
        $this->db->from('exit_survey');
        $this->db->where('student_id',$sid);
        return $this->db->get()->row();
    }
    public function foundGivenExitFeedback($sid) {
        $this->db->select('student_id');
        $this->db->from('feedbacks_for_exit');
        $this->db->where('student_id',$sid);
        return $this->db->get()->row();
    }
    public function saveExitSurveyFeedback($data)
    {
        $this->db->insert('feedbacks_for_exit', $data);
    }
    public function updateExitSurveyList($sid, $data) {
        $this->db->where('student_id',$sid);
        $this->db->update('exit_survey', $data);
    }

    function __destruct() {
        $this->db->close();
    }

}