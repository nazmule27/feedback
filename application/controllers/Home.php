<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        if(($this->session->userdata('role'))!=='student') {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }

    public function index() {
        $CI = &get_instance();
        $sid = $CI->session->userdata('username');
        $frole=$this->session->userdata('role');
        $cs = $CI->session->userdata('semester_id');
        //$cs=$_SESSION["current_semester"];
        if($frole=='teacher'){
            redirect('teacher_home');
        }
        else if($frole=='superadmin'){
            redirect('super_admin_home');
        }
        $data['course'] = $this->home_model->getCourses($sid, $cs);
        $data['exit'] = $this->home_model->getExits($sid);
        //$data['instructor'] = $this->home_model->getCourseTeacher($sid);
        $this->load->view('home_view', $data);
    }

}
?>