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
            <h4>Feedback Summary on course '<?php echo $course_name[0]->course_name; ?>'</h4>
            <a class="download-pdf" href="<?php echo base_url().'instructor_home/course_feedback_pdf/'.$course_id.'/'.$semester_id ?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""></a>
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Statement</th>
                    <th width="50">Excellent</th>
                    <th width="50">Very Good</th>
                    <th width="50">Good</th>
                    <th width="50">Average</th>
                    <th width="50">Poor</th>
                    <th width="50">Average point</th>
                </tr>
                </thead>
                <tbody>
                <?php $k=1; $each_avg=0; for ($i = 0; $i < count($course_feedback); ++$i) {?>
                    <tr>
                        <td><?php echo $k;?></td>
                        <td><?php echo $course_feedback[$i]->question;?></td>
                        <td><?php echo $course_feedback[$i]->count4;?></td>
                        <td><?php echo $course_feedback[$i]->count3;?></td>
                        <td><?php echo $course_feedback[$i]->count2;?></td>
                        <td><?php echo $course_feedback[$i]->count1;?></td>
                        <td><?php echo $course_feedback[$i]->count0;?></td>
                        <td>
                            <?php
                            $total=($course_feedback[$i]->count4)+($course_feedback[$i]->count3)+($course_feedback[$i]->count2)+($course_feedback[$i]->count1)+($course_feedback[$i]->count0);
                            $points=(($course_feedback[$i]->count4)*5)+(($course_feedback[$i]->count3)*4)+(($course_feedback[$i]->count2)*3)+(($course_feedback[$i]->count1)*2)+(($course_feedback[$i]->count0)*1);
                            if($total!=0){
                                $each_avg+=($points/$total);
                                //echo $points/$total;
                                echo round($points/$total, 2);
                            }
                            else echo 'N/A';
                            ?>
                        </td>
                    </tr>
                    <?php $k++;} ?>
                </tbody>
            </table>
            <div class="avg-point">
                <?php echo '<b>Overall Average Point: '.round($each_avg/9,2).'</b>';?>
            </div>
            <h4>Expected Grade</h4>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Grade</th>
                            <th>Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $k=1; for ($i = 0; $i < count($grade_count); ++$i) {?>
                            <tr>
                                <td><?php echo $k;?></td>
                                <td><?php echo $grade_count[$i]->grade;?></td>
                                <td><?php echo $grade_count[$i]->counts;?></td>
                            </tr>
                            <?php $k++;} ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6">
                    <p>
                        Average weekly spent hour for this course outside the class (Approx.): <?php echo $avg_spent_hour_course[0]->w_spent_time_hour; ?>
                    </p>
                </div>
            </div>
            <h4>Comments:
                <a class="download-pdf" href="<?php echo base_url().'instructor_home/course_feedbackComments_pdf/'.$course_id.'/'.$semester_id ?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""></a>
            </h4>

            <br>
            <?php $k=1; for ($i = 0; $i < count($course_comment); ++$i) {
                if($course_comment[$i]->comments!=='') {
                    echo '<p>'.$k.'. '.$course_comment[$i]->comments.'</p>';
                    $k++;
                }
            }
            ?>
        </div>

    </div>
</div>
<!-- /home -->
<?php
$this->load->view('common/footer');
?>

