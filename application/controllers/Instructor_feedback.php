<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor_feedback extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('instructor_feedback_model');
        $this->load->model('course_feedback_model');
        if(($this->session->userdata('role'))!=='student') {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    public function index() {
        $CI = &get_instance();
        $student_id = $CI->session->userdata('username');
        $course_id=$this->input->get('cid');
        $teacher_id=$this->input->get('tid');
        $sem_id = $CI->session->userdata('semester_id');
        $url=$this->instructor_feedback_model->checkUrl($student_id, $course_id, $teacher_id, $sem_id);
        if(($url)){
            $data['course_name'] = $this->course_feedback_model->getCourseName($this->input->get('cid'));
            $data['instructor'] = $this->instructor_feedback_model->getInstructor($this->input->get('tid'));
            //$data['semesters'] = $this->course_feedback_model->getSemesters();
            $this->load->view('instructor_feedback_view', $data);
        }
        else{
            $this->load->view('errors/invalid_url');
        }
    }
    public function success() {
        $this->load->view('success/course_success');
    }
    public function errors() {
        $this->load->view('errors/course_error');
    }
    public function insertFeedbackInstructor() {
        $CI = &get_instance();
        $student_id = $CI->session->userdata('username');
        $semester_id = $CI->session->userdata('semester_id');
        $status = $this->instructor_feedback_model->checkInstructorGivenFeedback($semester_id, $this->input->post('course_id'),  $student_id, $this->input->post('instructor'));
        $data = array(
            'course_id' => $this->input->post('course_id'),
            'course_name' => $this->input->post('course_name'),
            'semester_id' => $this->input->post('semester_name'),
            'year' =>  date("Y"),
            'level' => $this->input->post('level'),
            'term' => $this->input->post('term'),
            'expected_grade' => $this->input->post('expected_grade'),
            'room_no' => $this->input->post('room_no'),
            'instructor' => $this->input->post('instructor'),
            'w_spent_time_hour' => $this->input->post('w_spent_time_hour'),
            'value_1' => $this->input->post('question_1'),
            'value_2' => $this->input->post('question_2'),
            'value_3' => $this->input->post('question_3'),
            'value_4' => $this->input->post('question_4'),
            'value_5' => $this->input->post('question_5'),
            'value_6' => $this->input->post('question_6'),
            'value_7' => $this->input->post('question_7'),
            'value_8' => $this->input->post('question_8'),
            'value_9' => $this->input->post('question_9'),
            'value_10' => $this->input->post('question_10'),
            'value_11' => $this->input->post('question_11'),
            'value_12' => $this->input->post('question_12'),
            'value_13' => $this->input->post('question_13'),
            'value_14' => $this->input->post('question_14'),
            'value_15' => $this->input->post('question_15'),
            'comments' => $this->input->post('comments'),
        );
        $data2 = array(
            'teacher_status' => '1',

        );
        if(($status->teacher_status)=='0') {
            $this->instructor_feedback_model->saveFeedbackInstructor($data);
            $this->instructor_feedback_model->updateListInstructor($semester_id, $student_id, $this->input->post('course_id'), $this->input->post('instructor'), $data2);
            $data['success_msg'] = '<div class="alert alert-success text-center">Your Feedback successfully uploaded!<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a></div>';
            redirect('instructor_feedback/success');
        }
        else if(($status->teacher_status)=='1') {
            redirect('course_feedback/errors');
        }
        else {
            $data['success_msg'] = '<div class="alert alert-danger text-center">Error Occurred!<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a></div>';
            $this->load->view('instructor_feedback_view', $data);
        }
    }
}
?>