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
        <div class="col-md-7">
            <p >Name: <?php echo $full_name;?></p>
            <p >Student ID: <?php echo $username;?></p>
            <p >Feedback Detail:</p>
        </div>
        <div class="col-md-5">
            <p class="custom-message-box">[ Provided feedback will be stored without credential of student (anonymous feedback) ]</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Course Feedback</th>
                    <th>Instructor Feedback</th>
                </tr>
                </thead>
                <tbody>
                <?php $k=1; for ($i = 0; $i < count($course); ++$i) {?>
                    <tr>
                        <td><?php echo $k;?></td>
                        <?php
                        $status=$course[$i]->course_status;
                        if($status=='1') {
                            $status='btn disabled disableCus';
                        }
                        ?>
                        <td>Provide Feedback for <a target="_blank" class="<?php echo $status ?>" href="<?=base_url();?>course_feedback?cid=<?php echo $course[$i]->course_id;?>"> <?php echo $course[$i]->course_id.': '.$course[$i]->course_name;?> </a></td>
                        <!--<td><?php /*echo $course[$i]->course_id.': '.$course[$i]->course_name;*/?></td>-->
                        <td>
                            <?php
                            $teachers=explode(",", $course[$i]->teacher_id);
                            $teacher_status=explode(",", $course[$i]->teacher_status);
                            $teacher_name=explode(",", $course[$i]->full_name);
                            for ($x = 0; $x < count($teachers); ++$x) {
                                $status=$teacher_status[$x];
                                if($status=='1') {
                                    $status='btn disabled disableCus';
                                }
                                ?>
                                <p class="margin0">Provide Feedback for <a target="_blank" class="<?php echo $status ?>" href="<?=base_url();?>instructor_feedback?cid=<?php echo $course[$i]->course_id;?>&tid=<?php echo $teachers[$x];?>"> <?php echo $teacher_name[$x].' ('.$teachers[$x].')';?></a></p>
                                <?php
                            }
                            ?>
                        </td>

                    </tr>
                    <?php $k++;} ?>
                </tbody>
            </table>
            <?php
            $exit_status='btn disabled disNon';
            if (isset($exit[0]->exit_status)) {
                $exit_status=$exit[0]->exit_status;
                if($exit_status=='1') {
                    $exit_status='btn disabled disableCus';
                }
                else if($exit_status=='0') {
                    $exit_status='';
                }
            }
            ?>
            <a target="_blank" class="<?php echo $exit_status ?>" href="<?=base_url();?>exit_feedback">Exit Survey</a>
        </div>
    </div>
</div>
<!-- /home -->
<?php
$this->load->view('common/footer');
?>
