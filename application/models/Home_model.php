<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getCourses($sid, $cs) {
        $this->db->select("t1.*, GROUP_CONCAT(distinct(t3.course_name)) as course_name, GROUP_CONCAT(t4.full_name) as full_name, GROUP_CONCAT(t2.teacher_id) AS teacher_id, GROUP_CONCAT(t2.teacher_status) AS teacher_status");
        $this->db->from("semester_course t1, course_list t3, feedback_users t4, date_range d");
        $this->db->join("semester_course_instructor t2","t2.course_id = t1.course_id", "LEFT");
        $this->db->where("t1.student_id", $sid);
        $this->db->where("t1.student_id=t2.student_id");
        $this->db->where("t1.course_id=t3.course_id");
        $this->db->where("t2.teacher_id=t4.username");
        $this->db->where("`d`.`date_id`='std_feedback'");
        $this->db->where("NOW() BETWEEN `d`.`start_date` AND `d`.`end_date`");
        $this->db->where("`t1`.`semester_id`=`d`.`semester_id`");
        $this->db->where("`t1`.`semester_id`", $cs);
        $this->db->where("`t2`.`semester_id`", $cs);
        $this->db->group_by("t1.course_id");
        $this->db->order_by("t1.course_id, t2.teacher_id asc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    /*public function getCourses($sid) {
        $this->db->select("t1.*, GROUP_CONCAT(distinct(t3.course_name)) as course_name, GROUP_CONCAT(t4.full_name) as full_name, GROUP_CONCAT(t2.teacher_id) AS teacher_id, GROUP_CONCAT(t2.teacher_status) AS teacher_status");
        $this->db->from("semester_course t1, course_list t3, feedback_users t4");
        $this->db->join("semester_course_instructor t2","t2.course_id = t1.course_id", "LEFT");
        $this->db->where("t1.student_id", $sid);
        $this->db->where("t1.student_id=t2.student_id");
        $this->db->where("t1.course_id=t3.course_id");
        $this->db->where("t2.teacher_id=t4.username");
        $this->db->group_by("t1.course_id");
        $this->db->order_by("t1.course_id, t2.teacher_id asc");
        $query = $this->db->get();
        return $result = $query->result();
    }*/
    public function getExits($sid) {
        $this->db->select("exit_status");
        $this->db->from("exit_survey");
        $this->db->where("student_id", $sid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    //
    public function getCourseTeacher($sid, $cid) {
        $this->db->select("*");
        $this->db->from("semester_course_instructor");
        $this->db->where("student_id", $sid);
        $this->db->where("course_id", $cid);
        $this->db->where("semester_id='Jun_2015'");
        $this->db->order_by("teacher_id");
        $query = $this->db->get();
        return $result = $query->result();
    }

    function __destruct() {
        $this->db->close();
    }

}