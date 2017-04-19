<?php
$this->load->view('common/header');
?>
<div class="container paddingT75">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Exit Survey:</h3>
            <br>
            <form role="form" method="post" action="<?=base_url();?>exit_feedback/insertFeedbackExit">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input type="text" class="form-control" name="name" maxlength="50" placeholder="Your name" required>
                    </div>
                    <div class="form-group">
                        <label for="cgpa">Your CGPA:</label>
                        <input type="text" class="form-control" name="cgpa" maxlength="4" pattern="^[2-4](\.\d{1,2})?" placeholder="Your CGPA" required>
                    </div>
                    <div class="form-group">
                        <label for="expected_cgpa">Expected CGPA:</label>
                        <input type="text" class="form-control" name="expected_cgpa"  maxlength="4" pattern="^[2-4](\.\d{1,2})?" placeholder="Expected CGPAC" required>
                    </div>
                    <div class="form-group">
                        <label for="academic_performance">Academic Performance:</label>
                        <select name="academic_performance" class="form-control" required>
                            <option value="">Select One</option>
                            <option value="Below expectation">Below expectation</option>
                            <option value="Up to the mark">Up to the mark</option>
                            <option value="Above expectation">Above expectation</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="study_hour_outside_class">Studying outside class during term:</label>
                        <input type="text" class="form-control" name="study_hour_outside_class" maxlength="3" pattern="^[0-9]+\d?" placeholder="in hour" required>
                    </div>
                    <div class="form-group">
                        <label for="study_hour_during_pl">Studying during PL:</label>
                        <input type="text" class="form-control" name="study_hour_during_pl" maxlength="3" pattern="^[0-9]+\d?" placeholder="in hour" required>
                    </div>
                    <div class="form-group">
                        <label for="study_hour_during_exam">Studying during exam:</label>
                        <input type="text" class="form-control" name="study_hour_during_exam" maxlength="3" pattern="^[0-9]+\d?" placeholder="in hour" required>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="form-group custom-control">
                                <label for="extra_curricular_activities">Extra-curricular activities:</label>
                                <textarea class="form-control"  name="extra_curricular_activities" placeholder="sports, social work, etc." maxlength="255"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group custom-control">
                                <label for="earning_activities">Activities related to earning:</label>
                                <textarea class="form-control"  name="earning_activities" placeholder="tutoring, etc." maxlength="255"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                                <div class="form-group custom-control">
                                    <label for="social_networking">Social networking:</label>
                                    <textarea class="form-control"  name="social_networking" placeholder="Facebook, cell phone conversation, etc." maxlength="255"></textarea>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group custom-control">
                                <label for="entertainment">Entertainment and relaxation:</label>
                                <textarea class="form-control"  name="entertainment" placeholder="" maxlength="255"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
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
                            <th>Fair</th>
                            <th>Poor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="10"><p class="">Skills, Abilities, and Attributes</p></td>
                            <td>1</td>
                            <td class="tLeft">An ability to acquire and apply knowledge of mathematics, science, algorithmic principles, engineering tools, and technology in the field of Computer Science and  Engineering</td>
                            <td><input type="radio" value="4" name="question_1" required></td>
                            <td><input type="radio" value="3" name="question_1"></td>
                            <td><input type="radio" value="2" name="question_1"></td>
                            <td><input type="radio" value="1" name="question_1"></td>
                            <td><input type="radio" value="0" name="question_1"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>An ability to identify and formulate computational models of real world problems and develop practical solutions</td>
                            <td><input type="radio" value="4" name="question_2" required></td>
                            <td><input type="radio" value="3" name="question_2"></td>
                            <td><input type="radio" value="2" name="question_2"></td>
                            <td><input type="radio" value="1" name="question_2"></td>
                            <td><input type="radio" value="0" name="question_2"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>An ability to analyze computational requirements or needs of information systems. Design and develop appropriate products, processes, and tools of varying complexity in a way that demonstrates comprehensions of the trade-offs involved in design choices</td>
                            <td><input type="radio" value="4" name="question_3" required></td>
                            <td><input type="radio" value="3" name="question_3"></td>
                            <td><input type="radio" value="2" name="question_3"></td>
                            <td><input type="radio" value="1" name="question_3"></td>
                            <td><input type="radio" value="0" name="question_3"></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="tLeft">An ability to design, conduct, analyze, evaluate, and interpret the results of computational modules appropriate to Computer Science and  Engineering and information technology</td>
                            <td><input type="radio" value="4" name="question_4" required></td>
                            <td><input type="radio" value="3" name="question_4"></td>
                            <td><input type="radio" value="2" name="question_4"></td>
                            <td><input type="radio" value="1" name="question_4"></td>
                            <td><input type="radio" value="0" name="question_4"></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>An ability to work effectively in multi-disciplinary teams and provide leadership</td>
                            <td><input type="radio" value="4" name="question_5" required></td>
                            <td><input type="radio" value="3" name="question_5"></td>
                            <td><input type="radio" value="2" name="question_5"></td>
                            <td><input type="radio" value="1" name="question_5"></td>
                            <td><input type="radio" value="0" name="question_5"></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td class="tLeft">An ability to effectively communicate orally, visually and in writing</td>
                            <td><input type="radio" value="4" name="question_6" required></td>
                            <td><input type="radio" value="3" name="question_6"></td>
                            <td><input type="radio" value="2" name="question_6"></td>
                            <td><input type="radio" value="1" name="question_6"></td>
                            <td><input type="radio" value="0" name="question_6"></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td class="tLeft">An ability to understand the impact of engineering decisions in national/global/societal/environmental context</td>
                            <td><input type="radio" value="4" name="question_7" required></td>
                            <td><input type="radio" value="3" name="question_7"></td>
                            <td><input type="radio" value="2" name="question_7"></td>
                            <td><input type="radio" value="1" name="question_7"></td>
                            <td><input type="radio" value="0" name="question_7"></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>An understanding of professional, ethical, legal, security and social responsibility</td>
                            <td><input type="radio" value="4" name="question_8" required></td>
                            <td><input type="radio" value="3" name="question_8"></td>
                            <td><input type="radio" value="2" name="question_8"></td>
                            <td><input type="radio" value="1" name="question_8"></td>
                            <td><input type="radio" value="0" name="question_8"></td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>A recognition of the need for an ability to engage in lifelong learning to cope up with contemporary and future/potential challenges</td>
                            <td><input type="radio" value="4" name="question_9" required></td>
                            <td><input type="radio" value="3" name="question_9"></td>
                            <td><input type="radio" value="2" name="question_9"></td>
                            <td><input type="radio" value="1" name="question_9"></td>
                            <td><input type="radio" value="0" name="question_9"></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>A broad education necessary to contribute effectively beyond their professional careers</td>
                            <td><input type="radio" value="4" name="question_10" required></td>
                            <td><input type="radio" value="3" name="question_10"></td>
                            <td><input type="radio" value="2" name="question_10"></td>
                            <td><input type="radio" value="1" name="question_10"></td>
                            <td><input type="radio" value="0" name="question_10"></td>
                        </tr>
                        <tr>
                            <td rowspan="17"><p class="">Overall Facilities</p></td>
                            <td>11</td>
                            <td class="tLeft">Course contents and syllabus</td>
                            <td><input type="radio" value="4" name="question_11" required></td>
                            <td><input type="radio" value="3" name="question_11"></td>
                            <td><input type="radio" value="2" name="question_11"></td>
                            <td><input type="radio" value="1" name="question_11"></td>
                            <td><input type="radio" value="0" name="question_11"></td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td class="tLeft">Effectiveness of the degree program to prepare you for the job</td>
                            <td><input type="radio" value="4" name="question_12" required></td>
                            <td><input type="radio" value="3" name="question_12"></td>
                            <td><input type="radio" value="2" name="question_12"></td>
                            <td><input type="radio" value="1" name="question_12"></td>
                            <td><input type="radio" value="0" name="question_12"></td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Your accessibility to the course teachers and their approach to help you</td>
                            <td><input type="radio" value="4" name="question_13" required></td>
                            <td><input type="radio" value="3" name="question_13"></td>
                            <td><input type="radio" value="2" name="question_13"></td>
                            <td><input type="radio" value="1" name="question_13"></td>
                            <td><input type="radio" value="0" name="question_13"></td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Knowledge of course teachers and their preparation for the class lectures</td>
                            <td><input type="radio" value="4" name="question_14" required></td>
                            <td><input type="radio" value="3" name="question_14"></td>
                            <td><input type="radio" value="2" name="question_14"></td>
                            <td><input type="radio" value="1" name="question_14"></td>
                            <td><input type="radio" value="0" name="question_14"></td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Adequacy and comprehensiveness of the class notes and reference materials</td>
                            <td><input type="radio" value="4" name="question_15" required></td>
                            <td><input type="radio" value="3" name="question_15"></td>
                            <td><input type="radio" value="2" name="question_15"></td>
                            <td><input type="radio" value="1" name="question_15"></td>
                            <td><input type="radio" value="0" name="question_15"></td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>Guidance and help received from your advisor regarding your study</td>
                            <td><input type="radio" value="4" name="question_16" required></td>
                            <td><input type="radio" value="3" name="question_16"></td>
                            <td><input type="radio" value="2" name="question_16"></td>
                            <td><input type="radio" value="1" name="question_16"></td>
                            <td><input type="radio" value="0" name="question_16"></td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Overall counseling during pursuing the program</td>
                            <td><input type="radio" value="4" name="question_17" required></td>
                            <td><input type="radio" value="3" name="question_17"></td>
                            <td><input type="radio" value="2" name="question_17"></td>
                            <td><input type="radio" value="1" name="question_17"></td>
                            <td><input type="radio" value="0" name="question_17"></td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>Supports from departmental office staffs</td>
                            <td><input type="radio" value="4" name="question_18" required></td>
                            <td><input type="radio" value="3" name="question_18"></td>
                            <td><input type="radio" value="2" name="question_18"></td>
                            <td><input type="radio" value="1" name="question_18"></td>
                            <td><input type="radio" value="0" name="question_18"></td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>Computer, Internet, and other ICT facilities</td>
                            <td><input type="radio" value="4" name="question_19" required></td>
                            <td><input type="radio" value="3" name="question_19"></td>
                            <td><input type="radio" value="2" name="question_19"></td>
                            <td><input type="radio" value="1" name="question_19"></td>
                            <td><input type="radio" value="0" name="question_19"></td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>Library facilities (books, computers, electronic database, study desks, etc.)</td>
                            <td><input type="radio" value="4" name="question_20" required></td>
                            <td><input type="radio" value="3" name="question_20"></td>
                            <td><input type="radio" value="2" name="question_20"></td>
                            <td><input type="radio" value="1" name="question_20"></td>
                            <td><input type="radio" value="0" name="question_20"></td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>Scope and opportunities of co-curricular and extra-curricular activities</td>
                            <td><input type="radio" value="4" name="question_21" required></td>
                            <td><input type="radio" value="3" name="question_21"></td>
                            <td><input type="radio" value="2" name="question_21"></td>
                            <td><input type="radio" value="1" name="question_21"></td>
                            <td><input type="radio" value="0" name="question_21"></td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>Opportunities and facilities for research and extension</td>
                            <td><input type="radio" value="4" name="question_22" required></td>
                            <td><input type="radio" value="3" name="question_22"></td>
                            <td><input type="radio" value="2" name="question_22"></td>
                            <td><input type="radio" value="1" name="question_22"></td>
                            <td><input type="radio" value="0" name="question_22"></td>
                        </tr>
                        <tr>
                            <td>23</td>
                            <td>Fairness in the evaluation (grading in quiz, assignment, exam, etc.)</td>
                            <td><input type="radio" value="4" name="question_23" required></td>
                            <td><input type="radio" value="3" name="question_23"></td>
                            <td><input type="radio" value="2" name="question_23"></td>
                            <td><input type="radio" value="1" name="question_23"></td>
                            <td><input type="radio" value="0" name="question_23"></td>
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>Practice of accountability and transparency in different activities of the department</td>
                            <td><input type="radio" value="4" name="question_24" required></td>
                            <td><input type="radio" value="3" name="question_24"></td>
                            <td><input type="radio" value="2" name="question_24"></td>
                            <td><input type="radio" value="1" name="question_24"></td>
                            <td><input type="radio" value="0" name="question_24"></td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>Departmental arrangements to facilitate job opportunities</td>
                            <td><input type="radio" value="4" name="question_25" required></td>
                            <td><input type="radio" value="3" name="question_25"></td>
                            <td><input type="radio" value="2" name="question_25"></td>
                            <td><input type="radio" value="1" name="question_25"></td>
                            <td><input type="radio" value="0" name="question_25"></td>
                        </tr>
                        <tr>
                            <td>26</td>
                            <td>Departmental inclination and effort for continuous improvement of the program</td>
                            <td><input type="radio" value="4" name="question_26" required></td>
                            <td><input type="radio" value="3" name="question_26"></td>
                            <td><input type="radio" value="2" name="question_26"></td>
                            <td><input type="radio" value="1" name="question_26"></td>
                            <td><input type="radio" value="0" name="question_26"></td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>Your satisfaction level about the program</td>
                            <td><input type="radio" value="4" name="question_27" required></td>
                            <td><input type="radio" value="3" name="question_27"></td>
                            <td><input type="radio" value="2" name="question_27"></td>
                            <td><input type="radio" value="1" name="question_27"></td>
                            <td><input type="radio" value="0" name="question_27"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="current_involvement">Your current involvement:</label>
                            <select name="current_involvement" class="form-control" required>
                                <option value="">Select One</option>
                                <option value="Already in job since">1. Already in job since</option>
                                <option value="Received offer letter for a job">2. Received offer letter for a job</option>
                                <option value="Searching for a job">3. Searching for a job</option>
                                <option value="Looking for higher studies">4. Looking for higher studies</option>
                                <option value="Others">5. Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="next_plan">Your next plan:</label>
                            <textarea class="form-control"  name="next_plan" placeholder="Your next plan" maxlength="255"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="comments_on_session_jam">Your comments on session jam at BUET for improvement:</label>
                            <textarea class="form-control"  name="comments_on_session_jam" placeholder="Your comments on session jam at BUET and suggestions for improvement" maxlength="255"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="suggestions_for_improving">Your suggestions for improving the program in CSE, BUET:</label>
                            <textarea class="form-control"  name="suggestions_for_improving" placeholder="Your suggestions for improving the program in CSE, BUET that you have pursued" maxlength="255"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment_in_issue">Comment in any other issue(s):</label>
                    <textarea class="form-control"  name="comment_in_issue" placeholder="Comment in any other issue(s)" maxlength="255"></textarea>
                </div>
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
