<?php
$this->load->view('common/header');
$this->load->view('common/navbar');
$CI = &get_instance();
$role = $CI->session->userdata('role');
$username = $CI->session->userdata('username');
$full_name = $CI->session->userdata('full_name');
if($status==0){
    $inNot='not given';
}
else {
    $inNot='given';
}
?>

<div class="container paddingT75">
    <div class="row">
        <div class="col-md-12 col-ms-12 col-xs-12">
            <h4>Instructor feedback <?php echo $inNot?> list of '<?php echo $course_name[0]->course_name; ?>' for <?php echo $teacher_id?>:</h4>
            <?php if($role=='teacher') { ?>
                <a class="download-pdf" target="_blank" title="Download as PDF" href="<?=base_url().'instructor_home/instructor_given_list_pdf/'.$course_id.'/'.$semester_id.'/'.$teacher_id.'/'.$status;?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""> </a>
            <?php } else if ($role=='superadmin') {?>
                <a class="download-pdf" target="_blank" title="Download as PDF" href="<?=base_url().'super_admin_home/instructor_given_list_pdf/'.$course_id.'/'.$semester_id.'/'.$teacher_id.'/'.$status;?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""> </a>
            <?php }?>
            <br>
            <div class="row">
                <div class="col-md-10 col-ms-10 col-xs-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <!--<th>Semester Name</th>-->
                            <th>Student ID</th>
                            <th>Student Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $k=1; for ($i = 0; $i < count($given_list); ++$i) {?>
                            <tr>
                                <td><?php echo $k;?></td>
                                <!--<td><?php /*echo $my_courses[$i]->semester_id*/?></td>-->
                                <td>
                                    <?php echo $given_list[$i]->student_id ?>
                                </td>
                                <td>
                                    <?php echo $given_list[$i]->full_name ?>
                                </td>
                            </tr>
                            <?php $k++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /home -->
<?php
$this->load->view('common/footer');
?>
