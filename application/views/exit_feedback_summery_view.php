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
            <h4>
                Feedback on Exit Survey
                <a class="download-pdf" href="<?php echo base_url().'super_admin_home/exit_summery_feedback_pdf'?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""></a>
            </h4>
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Statement</th>
                    <th>Excellent</th>
                    <th>Very Good</th>
                    <th>Good</th>
                    <th>Average</th>
                    <th>Poor</th>
                </tr>
                </thead>
                <tbody>
                <?php $k=1; for ($i = 0; $i < count($exit_feedback); ++$i) {?>
                    <tr>
                        <td><?php echo $k;?></td>
                        <td><?php echo $exit_feedback[$i]->question;?></td>
                        <td><?php echo $exit_feedback[$i]->count4;?></td>
                        <td><?php echo $exit_feedback[$i]->count3;?></td>
                        <td><?php echo $exit_feedback[$i]->count2;?></td>
                        <td><?php echo $exit_feedback[$i]->count1;?></td>
                        <td><?php echo $exit_feedback[$i]->count0;?></td>
                    </tr>
                    <?php $k++;} ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-12">
            <h4>
                Comments for Next Plan:
                <a class="download-pdf" href="<?php echo base_url().'instructor_home/exit_comments_for_next_plan_pdf'?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""></a>
            </h4>
            <br>
            <?php $k=1; for ($i = 0; $i < count($next_plan_comments); ++$i) {?>
                <p><?php echo $k.'. '. $next_plan_comments[$i]->comments;  ?></p>
            <?php $k++;} ?>
        </div>
        <div class="col-lg-12">
            <h4>
                Comments for Session Jam:
                <a class="download-pdf" href="<?php echo base_url().'instructor_home/exit_comments_for_session_jam_pdf'?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""></a>
            </h4>
            <br>
            <?php $k=1; for ($i = 0; $i < count($comments_on_session_jam); ++$i) {?>
                <p><?php echo $k.'. '. $comments_on_session_jam[$i]->comments;  ?></p>
                <?php $k++;} ?>
        </div>
        <div class="col-lg-12">
            <h4>
                Comments for Improving:
                <a class="download-pdf" href="<?php echo base_url().'instructor_home/exit_comments_for_improving_pdf'?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""></a>
            </h4>
            <br>
            <?php $k=1; for ($i = 0; $i < count($suggestions_for_improving); ++$i) {?>
                <p><?php echo $k.'. '. $suggestions_for_improving[$i]->comments;  ?></p>
                <?php $k++;} ?>
        </div>
        <div class="col-lg-12">
            <h4>
                Comments for Issue:
                <a class="download-pdf" href="<?php echo base_url().'instructor_home/exit_comments_for_issue_pdf'?>"><img src="<?=base_url();?>assets/img/pdfIcon.png" alt=""></a>
            </h4>
            <br>
            <?php $k=1; for ($i = 0; $i < count($comment_in_issue); ++$i) {?>
                <p><?php echo $k.'. '. $comment_in_issue[$i]->comments;  ?></p>
                <?php $k++;} ?>
        </div>
    </div>
</div>
<!-- /home -->
<?php
$this->load->view('common/footer');
?>

