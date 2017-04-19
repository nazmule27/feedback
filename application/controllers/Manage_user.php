<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_user extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('Pdf');
        $this->pdf->fontpath = 'font/';
        $this->load->model('manage_user_model');;
        if(($this->session->userdata('role'))!=='superadmin') {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('login');
        }
    }
    public function index() {
        $data['all_user'] = $this->manage_user_model->getUsers();
        $this->load->view('manage_user_view', $data);
    }
    public function user_pdf(){
        $_SESSION["report_name"]='Feedback Users ';
        $data = $this->manage_user_model->getPdfData();
        $data = json_decode(json_encode($data), true);
        $header = array('SL', 'username', 'Full Name', 'Role');
        $w=[10, 45, 100, 35];
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->SetWidths($w);
        $this->pdf->UsersTable($header,$w,$data);
        $this->pdf->Output('Users_list.pdf', 'I');
    }
    public function add_user() {
        $this->load->view('add_user_view');
    }
    public function insert_user() {
        $result=$this->manage_user_model->checkUser($this->input->post('username'));
        if(empty($result)){
            $username=$this->input->post('username');
            $full_name=$this->input->post('full_name');
            $role=$this->input->post('role');


            $data = array(
                'username' => $username,
                'full_name' => $full_name,
                'role' => $role,
            );
            $this->manage_user_model->insertUser($data);
            redirect('manage_user');
        }
        else {
            $data['success_msg'] = '<div class="alert alert-danger text-center">This user already exist.<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a></div>';
            $this->load->view('add_user_view', $data);
        }
    }
    public function load_edit_user($user_id) {
        $data['e_user'] =$this->manage_user_model->getUserById($user_id);
        $this->load->view('edit_user_view', $data);
    }
    public function update_user($user_id) {
        $username=$this->input->post('username');
        $full_name=$this->input->post('full_name');
        $role=$this->input->post('role');


        $data = array(
            'username' => $username,
            'full_name' => $full_name,
            'role' => $role,
        );
        $this->manage_user_model->updateUser($user_id, $data);
        $data['e_user'] =$this->manage_user_model->getUserById($user_id);

        $data['success_msg'] = '<div class="alert alert-success text-center">User updated successfully.<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a></div>';
        //$this->load->view('edit_user_view', $data);
        redirect('manage_user');
    }
    public function delete_user($id) {
        $this->manage_user_model->deleteUserById($id);
        $data['all_user'] = $this->manage_user_model->getUsers();
        $this->load->view('manage_user_view', $data);
    }

}
?>