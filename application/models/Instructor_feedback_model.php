<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor_feedback_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
        if(empty($this->session->userdata('role'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    public function checkUrl($student_id, $course_id, $teacher_id, $sem_id) {
        $this->db->select('course_id');
        $this->db->from('semester_course_instructor');
        $this->db->where('student_id',$student_id);
        $this->db->where('course_id',$course_id);
        $this->db->where('teacher_id',$teacher_id);
        $this->db->where('semester_id',$sem_id);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getInstructor($tid) {
        $CI = &get_instance();
        $sem_id = $CI->session->userdata('semester_id');
        $sid = $CI->session->userdata('username');

        $this->db->select('u.username, u.full_name');
        $this->db->from('semester_course_instructor s, feedback_users u');
        $this->db->where('s.teacher_id=u.username');
        $this->db->where('s.teacher_id',$tid);
        $this->db->where('s.student_id',$sid);
        $this->db->where('s.semester_id',$sem_id);
        $this->db->group_by("s.teacher_id");
        $this->db->order_by('s.teacher_id');
        $query = $this->db->get();
        return $result = $query->result();

    }
    public function checkInstructorGivenFeedback($seid, $cid, $sid, $tid) {
        $this->db->select('teacher_status');
        $this->db->from('semester_course_instructor');
        $this->db->where('semester_id',$seid);
        $this->db->where('course_id',$cid);
        $this->db->where('student_id',$sid);
        $this->db->where('teacher_id',$tid);
        return $this->db->get()->row();
    }

    public function saveFeedbackInstructor($data)
    {
        $this->db->insert('feedbacks_for_instructor', $data);
    }
    public function updateListInstructor($semester_id, $sid, $cid, $tid, $data) {
        $this->db->where('semester_id',$semester_id);
        $this->db->where('student_id',$sid);
        $this->db->where('course_id',$cid);
        $this->db->where('teacher_id',$tid);
        $this->db->update('semester_course_instructor', $data);
    }

    function __destruct() {
        $this->db->close();
    }

}