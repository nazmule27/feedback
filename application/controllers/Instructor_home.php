<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor_home extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('Pdf');
        $this->pdf->fontpath = 'font/';
        $this->load->model('instructor_home_model');
        $this->load->model('super_admin_home_model');
        $this->load->model('course_feedback_model');
        if((($this->session->userdata('role'))!=='superadmin')&&(($this->session->userdata('role'))!=='teacher')) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    public function index() {
        $data['semesters'] = $this->instructor_home_model->getSemesters();
        $this->load->view('instructor_home_view', $data);
    }
    public function semester_view($sid) {
        $CI = &get_instance();
        $tid = $CI->session->userdata('username');
        $data['my_courses'] = $this->instructor_home_model->getCourses($sid, $tid);
        $this->load->view('instructor_semester_view', $data);
    }
    public function course_feedback_given_list($cid, $semid, $status) {
        $CI = &get_instance();
        $tid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($tid, $cid, $semid);
        if($courseExist){
            $data['given_list'] = $this->super_admin_home_model->getCourseFeedbackGivenList($cid, $semid, $status);
            $data['course_id']=$cid;
            $data['semester_id']=$semid;
            $data['status']=$status;
            $data['course_name'] = $this->course_feedback_model->getCourseName($cid);
            $this->load->view('course_feedback_given_list_view', $data);
        }
        else {
            redirect('login/teacher_deny');
        }
    }
    public function instructor_feedback_given_list($cid, $semid, $status) {
        $CI = &get_instance();
        $tid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($tid, $cid, $semid);
        if($courseExist){
            $data['given_list'] = $this->super_admin_home_model->getInstructorFeedbackGivenList($cid, $semid, $tid, $status);
            $data['course_id']=$cid;
            $data['semester_id']=$semid;
            $data['teacher_id']=$tid;
            $data['status']=$status;
            $data['course_name'] = $this->course_feedback_model->getCourseName($cid);
            $this->load->view('instructor_feedback_given_list_view', $data);
        }
        else {
            redirect('login/teacher_deny');
        }
    }
    public function feedback_summery_course_wise($cid, $semid) {
        $CI = &get_instance();
        $tid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($tid, $cid, $semid);
        if($courseExist){
            $data['course_feedback'] = $this->instructor_home_model->getFeedbackSummeryForCourse($cid, $semid);
            $data['course_comment'] = $this->instructor_home_model->getCommentForCourse($cid, $semid);
            $data['course_id']=$cid;
            $data['semester_id']=$semid;
            $data['course_name'] = $this->course_feedback_model->getCourseName($cid);
            $data['avg_spent_hour_course'] = $this->super_admin_home_model->getAvgSpentHourCourseWise($cid, $semid);
            $data['grade_count'] = $this->super_admin_home_model->getGradesCount($cid, $semid);
            $this->load->view('course_feedback_summery_view', $data);
        }
        else {
            redirect('login/teacher_deny');
        }
    }
    public function feedback_summery_teacher_wise($tid, $cid, $semid) {
        $CI = &get_instance();
        $stid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($stid, $cid, $semid);
        if($courseExist && $stid==$tid){
            $data['teacher_feedback'] = $this->instructor_home_model->getFeedbackSummeryForTeacher($tid, $cid, $semid);
            $data['instructor_comment'] = $this->instructor_home_model->getCommentForInstructor($tid, $cid, $semid);
            $data['teacher_id']=$tid;
            $data['course_id']=$cid;
            $data['semester_id']=$semid;
            $data['course_name'] = $this->course_feedback_model->getCourseName($cid);
            $data['instructor_name'] = $this->super_admin_home_model->getInstructorNameOnly($tid);
            $data['avg_spent_hour_course_instructor'] = $this->super_admin_home_model->getAvgSpentHourInstructorWise($cid, $tid, $semid);
            $data['grade_count_instructor'] = $this->super_admin_home_model->getGradesCountInstructor($cid, $tid, $semid);
            $this->load->view('instructor_feedback_summery_view', $data);
        }
        else {
            redirect('login/teacher_deny');
        }
    }
    public function course_feedback_pdf($cid, $semid){
        $CI = &get_instance();
        $tid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($tid, $cid, $semid);
        if($courseExist){
            $_SESSION["report_name"]='Course Feedback Summery for '.$cid.' in Semester '.$semid;
            $data = $this->instructor_home_model->getFeedbackSummeryForCourse($cid, $semid);
            $data = json_decode(json_encode($data), true);
            $header = array('SL', 'Statements', 'Exclnt.', 'Very G.', 'Good', 'Avg', 'Poor', 'Avg P');
            $w = [7, 113, 12, 12, 12, 12, 12, 10];
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->AliasNbPages();
            $this->pdf->AddPage();
            $this->pdf->SetWidths($w);
            $this->pdf->SummeryFeedbackTable($header,$w,$data);
            $this->pdf->Output('course_feedback_summery_'.$cid.'.pdf', 'I');
        }
        else {
            redirect('login/teacher_deny');
        }
    }
    public function course_feedbackComments_pdf($cid, $semid){
        $CI = &get_instance();
        $tid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($tid, $cid, $semid);
        if($courseExist){
            $_SESSION["report_name"]='Course Feedback Comments for '.$cid.' in Semester '.$semid;
            $data = $this->instructor_home_model->getCommentForCourse($cid, $semid);
            $data = json_decode(json_encode($data), true);
            $header = array('SL', 'Comments');
            $w = [10, 180];
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->AliasNbPages();
            $this->pdf->AddPage();
            $this->pdf->SetWidths($w);
            $this->pdf->CourseFeedbackComments($header,$w,$data);
            $this->pdf->Output('course_feedback_comments_'.$cid.'.pdf', 'I');
        }
        else {
            redirect('login/teacher_deny');
        }
    }
    public function instructor_feedback_pdf($tid, $cid, $semid){
        $CI = &get_instance();
        $stid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($stid, $cid, $semid);
        if($courseExist && $stid==$tid){
            $_SESSION["report_name"]='Instructor Feedback Summery for '.$cid.' of '.$tid.' in Semester '.$semid;
            $data = $this->instructor_home_model->getFeedbackSummeryForTeacher($tid, $cid, $semid);
            $data = json_decode(json_encode($data), true);
            $header = array('SL', 'Statements', 'Exclnt.', 'Very G.', 'Good', 'Avg', 'Poor', 'Avg P.');
            $w = [7, 113, 12, 12, 12, 12, 12, 10];
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->AliasNbPages();
            $this->pdf->AddPage();
            $this->pdf->SetWidths($w);
            $this->pdf->SummeryFeedbackTable($header,$w,$data);
            $this->pdf->Output('instructor_feedback_summery_'.$cid.'_'.$tid.'.pdf', 'I');
        }
        else {
            redirect('login/teacher_deny');
        }
    }
    public function instructor_feedbackComments_pdf($tid, $cid, $semid){
        $CI = &get_instance();
        $stid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($stid, $cid, $semid);
        if($courseExist && $stid==$tid){
            $_SESSION["report_name"]='Instructor Feedback Comments for '.$cid.' of '.$tid.' in Semester '.$semid;
            $data = $this->instructor_home_model->getCommentForInstructor($tid, $cid, $semid);
            $data = json_decode(json_encode($data), true);
            $header = array('SL', 'Comments');
            $w = [10, 180];
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->AliasNbPages();
            $this->pdf->AddPage();
            $this->pdf->SetWidths($w);
            $this->pdf->CourseFeedbackComments($header,$w,$data);
            $this->pdf->Output('instructor_feedback_comments_'.$cid.'_'.$tid.'.pdf', 'I');
        }
        else {
            redirect('login/teacher_deny');
        }
    }
    public function course_given_list_pdf($cid, $semid, $status){
        $CI = &get_instance();
        $tid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($tid, $cid, $semid);
        if($courseExist){
            if($status==0){
                $isNot='not given';
            }
            else {
                $isNot='given';
            }
            $_SESSION["report_name"]='course feedback '.$isNot.' student list of '.$cid.' in semester '.$semid;
            $data = $this->super_admin_home_model->getCourseFeedbackGivenList($cid, $semid, $status);
            $data = json_decode(json_encode($data), true);
            $header = array('SL', 'Student ID', 'Name');
            $w = [10, 50, 130];
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->AliasNbPages();
            $this->pdf->AddPage();
            $this->pdf->SetWidths($w);
            $this->pdf->CourseFeedbackGivenList($header,$w,$data);
            $this->pdf->Output('course_given_list.pdf', 'I');
        }
        else {
            redirect('login/teacher_deny');
        }
    }
    public function instructor_given_list_pdf($cid, $semid, $tid, $status){
        $CI = &get_instance();
        $stid = $CI->session->userdata('username');
        $courseExist=$this->instructor_home_model->checkCourseInstructor($stid, $cid, $semid);
        if($courseExist && $stid==$tid){
            if($status==0){
                $isNot='not given';
            }
            else {
                $isNot='given';
            }
            $_SESSION["report_name"]='instructor feedback '.$isNot.' student list of '.$cid.' for '.$tid.' in semester '.$semid;
            $data = $this->super_admin_home_model->getInstructorFeedbackGivenList($cid, $semid, $tid, $status);
            $data = json_decode(json_encode($data), true);
            $header = array('SL', 'Student ID', 'Name');
            $w = [10, 50, 130];
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->AliasNbPages();
            $this->pdf->AddPage();
            $this->pdf->SetWidths($w);
            $this->pdf->CourseFeedbackGivenList($header,$w,$data);
            $this->pdf->Output('instructor_given_list.pdf', 'I');
        }
        else {
            redirect('login/teacher_deny');
        }
    }

}
?>