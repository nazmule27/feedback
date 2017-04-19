<?php
$this->load->view('common/header');
$CI = &get_instance();
$semester_name = $CI->session->userdata('semester_id');
?>
<div class="container paddingT75">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Course Feedback</h3>
            <br>
            <form role="form" id="feedback_form" method="post" action="<?=base_url();?>course_feedback/insertFeedback">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="course_id">Course ID:</label>
                        <input type="text" class="form-control" name="course_id" value="<?php echo $this->input->get('cid'); ?>"  readonly required>
                    </div>
                    <div class="form-group">
                        <label for="course_name">Course name:</label>
                        <input type="text" class="form-control width300" name="course_name"  value="<?php echo $course_name[0]->course_name;?>" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="level">Your current level:</label>
                        <select name="level" class="form-control" required>
                            <option value="">Select One</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                            <option value="4">Level 4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="term">Your current term:</label>
                        <select name="term" class="form-control" required>
                            <option value="">Select One</option>
                            <option value="1">Term 1</option>
                            <option value="2">Term 2</option>
                        </select>
                    </div>
                    <!--<div class="form-group">
                        <label for="semester_name">Semester:</label>
                        <?php
                    /*                        $sem_options=$semesters;
                                            $sem_options = array('' => 'Select One') + $sem_options;
                                            $semester_id=$semester_name;
                                            echo form_dropdown('semester_name', $sem_options, $selected=$semester_id, 'class="form-control custom-text"');
                                            */?>
                    </div>-->
                    <div class="form-group">
                        <!--<label for="semester_name">Semester:</label>-->
                        <input type="hidden" class="form-control" name="semester_name" value="<?php echo $semester_name;?>">
                    </div>
                    <div class="form-group">
                        <label for="expected_grade">Expected grade in this course:</label>
                        <select name="expected_grade" class="form-control" required>
                            <option value="">Select One</option>
                            <option value="A+">A+</option>
                            <option value="A">A</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B">B</option>
                            <option value="B-">B-</option>
                            <option value="C+">C+</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room_no">Room no:</label>
                        <input type="text" class="form-control" maxlength="3" name="room_no" pattern="^[0-9]{3}" required>
                    </div>
                    <div class="form-group">
                        <label for="w_spent_time_hour">Weekly spent hours for this course outside the class (Approx.):</label>
                        <input type="text" class="form-control " name="w_spent_time_hour" maxlength="2" pattern="^[0-9]{1,2}" placeholder="in hours" required>
                    </div>
                    <div class="form-group">
                        <label for="instructor">Instructor:</label> course_generation
                        <?php
                        $comma='';
                        $instructorName='';
                        for ($i = 0; $i < count($instructor); ++$i){
                            $instructorName.= $comma.$instructor[$i]->full_name;
                            $comma=', ';
                        }
                        ?>
                        <input type="text" class="form-control width500" name="instructor" value="<?php echo $instructorName;?>" readonly>
                    </div>
                    <br><br>

                </div>
                <i class="fair">[Please give your honest and constructive opinions for helping us to improve. Your opinions will be used solely for our continuous improvement.]</i>
                <br>
                <br>
                <table class="table feedback-table">
                    <thead>
                        <tr>
                            <th>Focus</th>
                            <th>SL</th>
                            <th width="1500">Statement for Evaluation</th>
                            <th>Excellent</th>
                            <th>Very Good</th>
                            <th>Good</th>
                            <th>Average</th>
                            <th>Poor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="3"><p class="">Course Contents <br> and Organization</p></td>
                            <td>1</td>
                            <td class="tLeft">The course objectives are clear and well-defined</td>
                            <td><input type="radio" value="4" name="question_1" required></td>
                            <td><input type="radio" value="3" name="question_1"></td>
                            <td><input type="radio" value="2" name="question_1"></td>
                            <td><input type="radio" value="1" name="question_1"></td>
                            <td><input type="radio" value="0" name="question_1"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>The course covers all necessary topics in the field</td>
                            <td><input type="radio" value="4" name="question_2" required></td>
                            <td><input type="radio" value="3" name="question_2"></td>
                            <td><input type="radio" value="2" name="question_2"></td>
                            <td><input type="radio" value="1" name="question_2"></td>
                            <td><input type="radio" value="0" name="question_2"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>The course contents are well-organized; the contents encouraged me to participate in the class and study more</td>
                            <td><input type="radio" value="4" name="question_3" required></td>
                            <td><input type="radio" value="3" name="question_3"></td>
                            <td><input type="radio" value="2" name="question_3"></td>
                            <td><input type="radio" value="1" name="question_3"></td>
                            <td><input type="radio" value="0" name="question_3"></td>
                        </tr>
                        <tr>
                            <td rowspan="3"><p class="">Learning Resources</p></td>
                            <td>4</td>
                            <td class="tLeft">Course materials are adequate and available</td>
                            <td><input type="radio" value="4" name="question_4" required></td>
                            <td><input type="radio" value="3" name="question_4"></td>
                            <td><input type="radio" value="2" name="question_4"></td>
                            <td><input type="radio" value="1" name="question_4"></td>
                            <td><input type="radio" value="0" name="question_4"></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Reading materials such as textbooks, assignment sheets, etc., are easy to follow</td>
                            <td><input type="radio" value="4" name="question_5" required></td>
                            <td><input type="radio" value="3" name="question_5"></td>
                            <td><input type="radio" value="2" name="question_5"></td>
                            <td><input type="radio" value="1" name="question_5"></td>
                            <td><input type="radio" value="0" name="question_5"></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Availability of the required learning resources in the library and online is adequate and appropriate</td>
                            <td><input type="radio" value="4" name="question_6" required></td>
                            <td><input type="radio" value="3" name="question_6"></td>
                            <td><input type="radio" value="2" name="question_6"></td>
                            <td><input type="radio" value="1" name="question_6"></td>
                            <td><input type="radio" value="0" name="question_6"></td>
                        </tr>
                        <tr>
                            <td rowspan="3"><p class="">Additional Questions</p></td>
                            <td>7</td>
                            <td class="tLeft">The course demonstrates impacts in real life</td>
                            <td><input type="radio" value="4" name="question_7" required></td>
                            <td><input type="radio" value="3" name="question_7"></td>
                            <td><input type="radio" value="2" name="question_7"></td>
                            <td><input type="radio" value="1" name="question_7"></td>
                            <td><input type="radio" value="0" name="question_7"></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>The course contents seem to have good potentials to help me in higher studies</td>
                            <td><input type="radio" value="4" name="question_8" required></td>
                            <td><input type="radio" value="3" name="question_8"></td>
                            <td><input type="radio" value="2" name="question_8"></td>
                            <td><input type="radio" value="1" name="question_8"></td>
                            <td><input type="radio" value="0" name="question_8"></td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>The course contents seem to have good potentials to help me in my professional life</td>
                            <td><input type="radio" value="4" name="question_9" required></td>
                            <td><input type="radio" value="3" name="question_9"></td>
                            <td><input type="radio" value="2" name="question_9"></td>
                            <td><input type="radio" value="1" name="question_9"></td>
                            <td><input type="radio" value="0" name="question_9"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <label for="comments">Comments (if any):</label>
                    <textarea class="form-control"  name="comments" placeholder="Comments"></textarea>
                </div>
                <div class="g-recaptcha" data-sitekey="6Lf0uh4TAAAAADnhHiGYewquDs3mTsVAGzPLZ0Ma"></div>
                <div id="msg_captcha" style="color: red"></div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>

    </div>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>
<!-- /news -->

<?php
$this->load->view('common/footer');
?>
