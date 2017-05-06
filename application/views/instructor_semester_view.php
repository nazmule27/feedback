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
        <div class="col-md-6 col-ms-12 col-xs-12">
            <h4>Course Feedback List:</h4>
            <br>
            <div class="row">
                <div class="col-md-12 col-ms-12 col-xs-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <!--<th>Semester Name</th>-->
                            <th>Course Summary</th>
                            <th width="80">Course Feedback Given List</th>
                            <th width="110">Course Feedback Not Given List</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $k=1; for ($i = 0; $i < count($my_courses); ++$i) {?>
                            <tr>
                                <td><?php echo $k;?></td>
                                <!--<td><?php /*echo $my_courses[$i]->semester_id*/?></td>-->
                                <td>
                                    <?php echo '<a href="'.base_url().'instructor_home/feedback_summery_course_wise/'.$my_courses[$i]->course_id.'/'.$my_courses[$i]->semester_id.'">'.$my_courses[$i]->course_name.' ('.$my_courses[$i]->course_id.') ['.$my_courses[$i]->course_given.']'.' </a>' ?>
                                </td>
                                <td>
                                    <?php echo '<a href="'.base_url().'instructor_home/course_feedback_given_list/'.$my_courses[$i]->course_id.'/'.$my_courses[$i]->semester_id.'/1'.'">'.'Given List'.'</a>' ?>
                                </td>
                                <td>
                                    <?php echo '<a href="'.base_url().'instructor_home/course_feedback_given_list/'.$my_courses[$i]->course_id.'/'.$my_courses[$i]->semester_id.'/0'.'">'.'Not Given List'.'</a>' ?>
                                </td>
                            </tr>
                            <?php $k++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-ms-12 col-xs-12">
            <h4>Instructor Feedback  List:</h4>
            <br>
            <div class="row">
                <div class="col-md-12 col-ms-12 col-xs-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <!--<th>Semester Name</th>-->
                            <!--<th>Course Summary</th>-->
                            <th>Instructor Summary</th>
                            <th width="80">Instructor Feedback Given List</th>
                            <th width="110">Instructor Feedback Not Given List</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $k=1; for ($i = 0; $i < count($my_courses); ++$i) {?>
                            <tr>
                                <td><?php echo $k;?></td>
                                <!--<td><?php /*echo $my_courses[$i]->semester_id*/?></td>-->
                                <!--<td>
                                    <?php /*echo '<a href="'.base_url().'instructor_home/feedback_summery_course_wise/'.$my_courses[$i]->course_id.'/'.$my_courses[$i]->semester_id.'">'.$my_courses[$i]->course_name.' ('.$my_courses[$i]->course_id.') ('.$my_courses[$i]->course_given.')'.' </a>' */?>
                                </td>-->
                                <td><?php echo '<a href="'.base_url().'instructor_home/feedback_summery_teacher_wise/'.$username.'/'.$my_courses[$i]->course_id.'/'.$my_courses[$i]->semester_id.'"> '.$my_courses[$i]->course_name.' ('.$my_courses[$i]->course_id.') ['.$my_courses[$i]->instructor_given.']'.'</a>' ?></td>
                                <td>
                                    <?php echo '<a href="'.base_url().'instructor_home/instructor_feedback_given_list/'.$my_courses[$i]->course_id.'/'.$my_courses[$i]->semester_id.'/1'.'">'.'Given List'.'</a>' ?>
                                </td>
                                <td>
                                    <?php echo '<a href="'.base_url().'instructor_home/instructor_feedback_given_list/'.$my_courses[$i]->course_id.'/'.$my_courses[$i]->semester_id.'/0'.'">'.'Not Given List'.'</a>' ?>
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
