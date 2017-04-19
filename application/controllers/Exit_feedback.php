<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exit_feedback extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('exit_feedback_model');
        if(($this->session->userdata('role'))!=='student') {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }

    public function index() {
        $this->load->view('exit_feedback_view');
    }
    public function success() {
        $this->load->view('success/course_success');
    }
    public function errors() {
        $this->load->view('errors/course_error');
    }
    public function insertFeedbackExit() {
        $CI = &get_instance();
        $student_id = $CI->session->userdata('username');
        $status = $this->exit_feedback_model->checkGivenExitFeedback($student_id);
        $found = $this->exit_feedback_model->foundGivenExitFeedback($student_id);
        $data = array(
            'student_id' => $student_id,
            'name' => $this->input->post('name'),
            'cgpa' => $this->input->post('cgpa'),
            'expected_cgpa' => $this->input->post('expected_cgpa'),
            'academic_performance' => $this->input->post('academic_performance'),
            'study_hour_outside_class' => $this->input->post('study_hour_outside_class'),
            'study_hour_during_pl' => $this->input->post('study_hour_during_pl'),
            'study_hour_during_exam' => $this->input->post('study_hour_during_exam'),
            'extra_curricular_activities' => $this->input->post('extra_curricular_activities'),
            'earning_activities' => $this->input->post('earning_activities'),
            'social_networking' => $this->input->post('social_networking'),
            'entertainment' => $this->input->post('entertainment'),
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
            'value_16' => $this->input->post('question_16'),
            'value_17' => $this->input->post('question_17'),
            'value_18' => $this->input->post('question_18'),
            'value_19' => $this->input->post('question_19'),
            'value_20' => $this->input->post('question_20'),
            'value_21' => $this->input->post('question_21'),
            'value_22' => $this->input->post('question_22'),
            'value_23' => $this->input->post('question_23'),
            'value_24' => $this->input->post('question_24'),
            'value_25' => $this->input->post('question_25'),
            'value_26' => $this->input->post('question_26'),
            'value_27' => $this->input->post('question_27'),
            'current_involvement' => $this->input->post('current_involvement'),
            'next_plan' => $this->input->post('next_plan'),
            'comments_on_session_jam' => $this->input->post('comments_on_session_jam'),
            'suggestions_for_improving' => $this->input->post('suggestions_for_improving'),
            'comment_in_issue' => $this->input->post('comment_in_issue'),
        );
        $data2 = array(
            'exit_status' => '1',

        );
        if((($status->exit_status)=='0')&&(empty($found->student_id))) {
            $this->exit_feedback_model->saveExitSurveyFeedback($data);
            $this->exit_feedback_model->updateExitSurveyList($student_id, $data2);
            $data['success_msg'] = '<div class="alert alert-success text-center">Your Feedback successfully uploaded!<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a></div>';
            redirect('instructor_feedback/success');
        }
        else if((($status->exit_status)=='1')||(!empty($found->student_id))) {
            redirect('course_feedback/errors');
        }
        else {
            $data['success_msg'] = '<div class="alert alert-danger text-center">Error Occurred!<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a></div>';
            $this->load->view('exit_feedback_view', $data);
        }
    }
}
?>