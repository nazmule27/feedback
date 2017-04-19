<?php
$this->load->view('common/header');
$this->load->view('common/navbar');
$CI = &get_instance();
$role = $CI->session->userdata('role');
$username = $CI->session->userdata('username');
$full_name = $CI->session->userdata('full_name');
?>

<div class="container paddingT75">
    <div class="row">
        <div class="col-md-12 col-ms-12 col-xs-12">
            <h3>Feedback Semesters Dashboard:</h3>
            <br>
            <?php for ($i = 0; $i < count($semesters); ++$i) {?>
                <?php echo '<a class="btn btn-lg btn-success" href="'.base_url().'instructor_home/semester_view/'.$semesters[$i]->semester_id.'">'.'View Semester '.$semesters[$i]->semester_id.' </a>' ?>
            <?php } ?>
        </div>
    </div>
</div>
<!-- /home -->
<?php
$this->load->view('common/footer');
?>
