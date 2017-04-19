<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_feedback_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
        if(empty($this->session->userdata('role'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    public function checkUrl($student_id, $course_id, $sem_id) {
        $this->db->select('course_id');
        $this->db->from('semester_course');
        $this->db->where('student_id',$student_id);
        $this->db->where('course_id',$course_id);
        $this->db->where('semester_id',$sem_id);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getCourseName($cid) {
        $this->db->select('course_name');
        $this->db->from('course_list');
        $this->db->where('course_id',$cid);
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function getInstructor($cid) {
        $this->db->distinct('teacher_id, teacher_id');
        $this->db->from('semester_course_instructor');
        $this->db->where('course_id',$cid);
        $this->db->order_by('teacher_id');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['teacher_id']]=$row['teacher_id'];
        }
        return $arr;
    }
    public function getInstructorName($cid) {
        $CI = &get_instance();
        $sem_id = $CI->session->userdata('semester_id');
        $sid = $CI->session->userdata('username');
        $this->db->select('u.full_name');
        $this->db->from('semester_course_instructor s, feedback_users u');
        $this->db->where('s.teacher_id=u.username');
        $this->db->where('s.course_id',$cid);
        $this->db->where('s.student_id',$sid);
        $this->db->where('s.semester_id',$sem_id);
        $this->db->group_by("s.teacher_id");
        $this->db->order_by('s.teacher_id');
        $query = $this->db->get();
        return $result = $query->result();

    }
    public function getSemesters() {
        $this->db->distinct('semester_name');
        $this->db->from('semester_list');
        $this->db->order_by('id desc');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['semester_name']]=$row['semester_name'];
        }
        return $arr;
    }
    public function checkGivenFeedback($seid, $cid, $sid) {
        $this->db->select('course_status');
        $this->db->from('semester_course');
        $this->db->where('semester_id',$seid);
        $this->db->where('course_id',$cid);
        $this->db->where('student_id',$sid);
        return $this->db->get()->row();
    }

    public function saveFeedback($data)
    {
        $this->db->insert('feedbacks_for_course', $data);
    }
    public function updateList($semester_id, $sid, $cid, $data) {
        $this->db->where('semester_id',$semester_id);
        $this->db->where('student_id',$sid);
        $this->db->where('course_id',$cid);
        $this->db->update('semester_course', $data);
    }
//
    public function getCourseFeedback() {
        $CI = &get_instance();
        $id = $CI->session->userdata('username');
        $this->db->select("*");
        $this->db->from("semester_courses");
        $this->db->where("student_id", $id);
        $this->db->order_by("course_id");
        $query = $this->db->get();
        return $result = $query->result();
    }


    function __destruct() {
        $this->db->close();
    }

}