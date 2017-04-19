
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model("login_model", "login");
    }
    public function index() {
        if($_POST) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->library('Radius');
            $ip_radius_server="172.16.101.11";
            $shared_secret="testing123*cse";
            //$radius = new Radius($ip_radius_server, $shared_secret);
            //$resultRadius = $radius->AccessRequest($username, $password);

            //$result = $this->login->validate_user($_POST);
            //if(!empty($resultRadius)) {
                $result = $this->login->data_user($_POST);
                $std_date = $this->login->std_date();

                if(isset($result)){
                    $data = [
                        'role' => $result->role,
                        'username' => $result->username,
                        'full_name' => $result->full_name,
                        //'semester_id' => $result->semester_id,
                        'semester_id' => $std_date[0]->semester_id,

                    ];
                    $this->session->set_userdata($data);
                    if($result->role=='student') {
                        if(date('Y-m-d h:i:s')<=$std_date[0]->start_date) {
                            redirect('login/student_deny');
                        }
                        else if(date('Y-m-d h:i:s')>=$std_date[0]->end_date) {
                            redirect('login/student_deny2');
                        }
                        else {
                            redirect('home');
                        }
                    }
                    else if($result->role=='teacher') {
                        redirect('instructor_home');
                    }
                    else if($result->role=='superadmin') {
                        redirect('super_admin_home');
                    }
                }
                else{
                    $this->session->set_flashdata('login_fail', 'This username is not registered in this system,<br> Please contact to admin!');
                    redirect('login');
                }
            /*} else {
                $this->session->set_flashdata('login_fail', 'Username or password is wrong!');
                redirect('login');
            }*/
        }

        $this->load->view("login_view");
    }
    public function logout() {
        $data = ['role', 'username', 'full_name', 'semester_id'];
        $this->session->unset_userdata($data);
        redirect('login');
    }
    public function teacher_deny() {
        $this->load->view("access/teacher_access_error");
    }
    public function student_deny() {
        $std_date = $this->login->std_date();
        $sd['std']=$std_date[0]->start_date;
        $this->load->view("access/student_access_error", $sd);
    }
    public function student_deny2() {
        $std_date = $this->login->std_date();
        $ed['ed']=$std_date[0]->end_date;
        $this->load->view("access/student_access_error2", $ed);
    }
}
