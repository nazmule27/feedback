<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super_admin_home_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getCourses($sid) {
        $query=$this->db->query("SELECT DISTINCT tt1.*, IFNULL(instructor_given, 0) AS instructor_given FROM
(SELECT t1.*, IFNULL(course_given, 0) AS course_given FROM
(SELECT DISTINCT
  `s`.`teacher_id`,
  `u`.`full_name`,
  `s`.`course_id`,
  `c`.`course_name`,
  `s`.`semester_id`
FROM
  `semester_course_instructor` `s`,
  `feedback_users` `u`,
  `course_list` `c`
WHERE `s`.`teacher_id` = `u`.`username`
  AND `s`.`course_id` = `c`.`course_id`
  AND `s`.`semester_id` = "."'".$sid."'"." ) t1
  LEFT JOIN
(SELECT course_id, COUNT(course_id) AS course_given FROM feedbacks_for_course WHERE semester_id = "."'".$sid."'"."  GROUP BY course_id, semester_id) t2
ON t1.course_id = t2.course_id) tt1
LEFT JOIN
(SELECT instructor, course_id, COUNT(course_id) AS instructor_given FROM feedbacks_for_instructor WHERE semester_id = "."'".$sid."'"."  GROUP BY course_id, instructor, semester_id) tt2
ON tt1.course_id = tt2.course_id AND tt1.teacher_id = tt2.instructor
ORDER BY tt1.course_id, tt1.teacher_id
");
        return $result = $query->result();
    }

    public function getFeedbackSummeryForExit() {
        $query=$this->db->query("
SELECT xx.question, yy.count4, yy.count3, yy.count2, yy.count1, yy.count0 FROM questiions_for_exit xx,
((SELECT '1' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_1) AS count4 FROM feedbacks_for_exit WHERE value_1='4') A,
(SELECT COUNT(value_1) AS count3 FROM feedbacks_for_exit WHERE value_1='3') B,
(SELECT COUNT(value_1) AS count2 FROM feedbacks_for_exit WHERE value_1='2') C,
(SELECT COUNT(value_1) AS count1 FROM feedbacks_for_exit WHERE value_1='1') D,
(SELECT COUNT(value_1) AS count0 FROM feedbacks_for_exit WHERE value_1='0') E)
UNION ALL
(SELECT '2' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_2) AS count4 FROM feedbacks_for_exit WHERE value_2='4') A,
(SELECT COUNT(value_2) AS count3 FROM feedbacks_for_exit WHERE value_2='3') B,
(SELECT COUNT(value_2) AS count2 FROM feedbacks_for_exit WHERE value_2='2') C,
(SELECT COUNT(value_2) AS count1 FROM feedbacks_for_exit WHERE value_2='1') D,
(SELECT COUNT(value_2) AS count0 FROM feedbacks_for_exit WHERE value_2='0') E)
UNION ALL
(SELECT '3' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_3) AS count4 FROM feedbacks_for_exit WHERE value_3='4') A,
(SELECT COUNT(value_3) AS count3 FROM feedbacks_for_exit WHERE value_3='3') B,
(SELECT COUNT(value_3) AS count2 FROM feedbacks_for_exit WHERE value_3='2') C,
(SELECT COUNT(value_3) AS count1 FROM feedbacks_for_exit WHERE value_3='1') D,
(SELECT COUNT(value_3) AS count0 FROM feedbacks_for_exit WHERE value_3='0') E)
UNION ALL
(SELECT '4' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_4) AS count4 FROM feedbacks_for_exit WHERE value_4='4') A,
(SELECT COUNT(value_4) AS count3 FROM feedbacks_for_exit WHERE value_4='3') B,
(SELECT COUNT(value_4) AS count2 FROM feedbacks_for_exit WHERE value_4='2') C,
(SELECT COUNT(value_4) AS count1 FROM feedbacks_for_exit WHERE value_4='1') D,
(SELECT COUNT(value_4) AS count0 FROM feedbacks_for_exit WHERE value_4='0') E)
UNION ALL
(SELECT '5' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_5) AS count4 FROM feedbacks_for_exit WHERE value_5='4') A,
(SELECT COUNT(value_5) AS count3 FROM feedbacks_for_exit WHERE value_5='3') B,
(SELECT COUNT(value_5) AS count2 FROM feedbacks_for_exit WHERE value_5='2') C,
(SELECT COUNT(value_5) AS count1 FROM feedbacks_for_exit WHERE value_5='1') D,
(SELECT COUNT(value_5) AS count0 FROM feedbacks_for_exit WHERE value_5='0') E)
UNION ALL
(SELECT '6' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_6) AS count4 FROM feedbacks_for_exit WHERE value_6='4') A,
(SELECT COUNT(value_6) AS count3 FROM feedbacks_for_exit WHERE value_6='3') B,
(SELECT COUNT(value_6) AS count2 FROM feedbacks_for_exit WHERE value_6='2') C,
(SELECT COUNT(value_6) AS count1 FROM feedbacks_for_exit WHERE value_6='1') D,
(SELECT COUNT(value_6) AS count0 FROM feedbacks_for_exit WHERE value_6='0') E)
UNION ALL
(SELECT '7' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_7) AS count4 FROM feedbacks_for_exit WHERE value_7='4') A,
(SELECT COUNT(value_7) AS count3 FROM feedbacks_for_exit WHERE value_7='3') B,
(SELECT COUNT(value_7) AS count2 FROM feedbacks_for_exit WHERE value_7='2') C,
(SELECT COUNT(value_7) AS count1 FROM feedbacks_for_exit WHERE value_7='1') D,
(SELECT COUNT(value_7) AS count0 FROM feedbacks_for_exit WHERE value_7='0') E)
UNION ALL
(SELECT '8' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_8) AS count4 FROM feedbacks_for_exit WHERE value_8='4') A,
(SELECT COUNT(value_8) AS count3 FROM feedbacks_for_exit WHERE value_8='3') B,
(SELECT COUNT(value_8) AS count2 FROM feedbacks_for_exit WHERE value_8='2') C,
(SELECT COUNT(value_8) AS count1 FROM feedbacks_for_exit WHERE value_8='1') D,
(SELECT COUNT(value_8) AS count0 FROM feedbacks_for_exit WHERE value_8='0') E)
UNION ALL
(SELECT '9' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_9) AS count4 FROM feedbacks_for_exit WHERE value_9='4') A,
(SELECT COUNT(value_9) AS count3 FROM feedbacks_for_exit WHERE value_9='3') B,
(SELECT COUNT(value_9) AS count2 FROM feedbacks_for_exit WHERE value_9='2') C,
(SELECT COUNT(value_9) AS count1 FROM feedbacks_for_exit WHERE value_9='1') D,
(SELECT COUNT(value_9) AS count0 FROM feedbacks_for_exit WHERE value_9='0') E)
UNION ALL
(SELECT '10' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_10) AS count4 FROM feedbacks_for_exit WHERE value_10='4') A,
(SELECT COUNT(value_10) AS count3 FROM feedbacks_for_exit WHERE value_10='3') B,
(SELECT COUNT(value_10) AS count2 FROM feedbacks_for_exit WHERE value_10='2') C,
(SELECT COUNT(value_10) AS count1 FROM feedbacks_for_exit WHERE value_10='1') D,
(SELECT COUNT(value_10) AS count0 FROM feedbacks_for_exit WHERE value_10='0') E)
UNION ALL
(SELECT '11' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_11) AS count4 FROM feedbacks_for_exit WHERE value_11='4') A,
(SELECT COUNT(value_11) AS count3 FROM feedbacks_for_exit WHERE value_11='3') B,
(SELECT COUNT(value_11) AS count2 FROM feedbacks_for_exit WHERE value_11='2') C,
(SELECT COUNT(value_11) AS count1 FROM feedbacks_for_exit WHERE value_11='1') D,
(SELECT COUNT(value_11) AS count0 FROM feedbacks_for_exit WHERE value_11='0') E)
UNION ALL
(SELECT '12' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_12) AS count4 FROM feedbacks_for_exit WHERE value_12='4') A,
(SELECT COUNT(value_12) AS count3 FROM feedbacks_for_exit WHERE value_12='3') B,
(SELECT COUNT(value_12) AS count2 FROM feedbacks_for_exit WHERE value_12='2') C,
(SELECT COUNT(value_12) AS count1 FROM feedbacks_for_exit WHERE value_12='1') D,
(SELECT COUNT(value_12) AS count0 FROM feedbacks_for_exit WHERE value_12='0') E)
UNION ALL
(SELECT '13' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_13) AS count4 FROM feedbacks_for_exit WHERE value_13='4') A,
(SELECT COUNT(value_13) AS count3 FROM feedbacks_for_exit WHERE value_13='3') B,
(SELECT COUNT(value_13) AS count2 FROM feedbacks_for_exit WHERE value_13='2') C,
(SELECT COUNT(value_13) AS count1 FROM feedbacks_for_exit WHERE value_13='1') D,
(SELECT COUNT(value_13) AS count0 FROM feedbacks_for_exit WHERE value_13='0') E)
UNION ALL
(SELECT '14' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_14) AS count4 FROM feedbacks_for_exit WHERE value_14='4') A,
(SELECT COUNT(value_14) AS count3 FROM feedbacks_for_exit WHERE value_14='3') B,
(SELECT COUNT(value_14) AS count2 FROM feedbacks_for_exit WHERE value_14='2') C,
(SELECT COUNT(value_14) AS count1 FROM feedbacks_for_exit WHERE value_14='1') D,
(SELECT COUNT(value_14) AS count0 FROM feedbacks_for_exit WHERE value_14='0') E)
UNION ALL
(SELECT '15' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_15) AS count4 FROM feedbacks_for_exit WHERE value_15='4') A,
(SELECT COUNT(value_15) AS count3 FROM feedbacks_for_exit WHERE value_15='3') B,
(SELECT COUNT(value_15) AS count2 FROM feedbacks_for_exit WHERE value_15='2') C,
(SELECT COUNT(value_15) AS count1 FROM feedbacks_for_exit WHERE value_15='1') D,
(SELECT COUNT(value_15) AS count0 FROM feedbacks_for_exit WHERE value_15='0') E)
UNION ALL
(SELECT '16' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_16) AS count4 FROM feedbacks_for_exit WHERE value_16='4') A,
(SELECT COUNT(value_16) AS count3 FROM feedbacks_for_exit WHERE value_16='3') B,
(SELECT COUNT(value_16) AS count2 FROM feedbacks_for_exit WHERE value_16='2') C,
(SELECT COUNT(value_16) AS count1 FROM feedbacks_for_exit WHERE value_16='1') D,
(SELECT COUNT(value_16) AS count0 FROM feedbacks_for_exit WHERE value_16='0') E)
UNION ALL
(SELECT '17' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_17) AS count4 FROM feedbacks_for_exit WHERE value_17='4') A,
(SELECT COUNT(value_17) AS count3 FROM feedbacks_for_exit WHERE value_17='3') B,
(SELECT COUNT(value_17) AS count2 FROM feedbacks_for_exit WHERE value_17='2') C,
(SELECT COUNT(value_17) AS count1 FROM feedbacks_for_exit WHERE value_17='1') D,
(SELECT COUNT(value_17) AS count0 FROM feedbacks_for_exit WHERE value_17='0') E)
UNION ALL
(SELECT '18' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_18) AS count4 FROM feedbacks_for_exit WHERE value_18='4') A,
(SELECT COUNT(value_18) AS count3 FROM feedbacks_for_exit WHERE value_18='3') B,
(SELECT COUNT(value_18) AS count2 FROM feedbacks_for_exit WHERE value_18='2') C,
(SELECT COUNT(value_18) AS count1 FROM feedbacks_for_exit WHERE value_18='1') D,
(SELECT COUNT(value_18) AS count0 FROM feedbacks_for_exit WHERE value_18='0') E)
UNION ALL
(SELECT '19' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_19) AS count4 FROM feedbacks_for_exit WHERE value_19='4') A,
(SELECT COUNT(value_19) AS count3 FROM feedbacks_for_exit WHERE value_19='3') B,
(SELECT COUNT(value_19) AS count2 FROM feedbacks_for_exit WHERE value_19='2') C,
(SELECT COUNT(value_19) AS count1 FROM feedbacks_for_exit WHERE value_19='1') D,
(SELECT COUNT(value_19) AS count0 FROM feedbacks_for_exit WHERE value_19='0') E)
UNION ALL
(SELECT '20' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_20) AS count4 FROM feedbacks_for_exit WHERE value_20='4') A,
(SELECT COUNT(value_20) AS count3 FROM feedbacks_for_exit WHERE value_20='3') B,
(SELECT COUNT(value_20) AS count2 FROM feedbacks_for_exit WHERE value_20='2') C,
(SELECT COUNT(value_20) AS count1 FROM feedbacks_for_exit WHERE value_20='1') D,
(SELECT COUNT(value_20) AS count0 FROM feedbacks_for_exit WHERE value_20='0') E)
UNION ALL
(SELECT '21' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_21) AS count4 FROM feedbacks_for_exit WHERE value_21='4') A,
(SELECT COUNT(value_21) AS count3 FROM feedbacks_for_exit WHERE value_21='3') B,
(SELECT COUNT(value_21) AS count2 FROM feedbacks_for_exit WHERE value_21='2') C,
(SELECT COUNT(value_21) AS count1 FROM feedbacks_for_exit WHERE value_21='1') D,
(SELECT COUNT(value_21) AS count0 FROM feedbacks_for_exit WHERE value_21='0') E)
UNION ALL
(SELECT '22' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_22) AS count4 FROM feedbacks_for_exit WHERE value_22='4') A,
(SELECT COUNT(value_22) AS count3 FROM feedbacks_for_exit WHERE value_22='3') B,
(SELECT COUNT(value_22) AS count2 FROM feedbacks_for_exit WHERE value_22='2') C,
(SELECT COUNT(value_22) AS count1 FROM feedbacks_for_exit WHERE value_22='1') D,
(SELECT COUNT(value_22) AS count0 FROM feedbacks_for_exit WHERE value_22='0') E)
UNION ALL
(SELECT '23' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_23) AS count4 FROM feedbacks_for_exit WHERE value_23='4') A,
(SELECT COUNT(value_23) AS count3 FROM feedbacks_for_exit WHERE value_23='3') B,
(SELECT COUNT(value_23) AS count2 FROM feedbacks_for_exit WHERE value_23='2') C,
(SELECT COUNT(value_23) AS count1 FROM feedbacks_for_exit WHERE value_23='1') D,
(SELECT COUNT(value_23) AS count0 FROM feedbacks_for_exit WHERE value_23='0') E)
UNION ALL
(SELECT '24' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_24) AS count4 FROM feedbacks_for_exit WHERE value_24='4') A,
(SELECT COUNT(value_24) AS count3 FROM feedbacks_for_exit WHERE value_24='3') B,
(SELECT COUNT(value_24) AS count2 FROM feedbacks_for_exit WHERE value_24='2') C,
(SELECT COUNT(value_24) AS count1 FROM feedbacks_for_exit WHERE value_24='1') D,
(SELECT COUNT(value_24) AS count0 FROM feedbacks_for_exit WHERE value_24='0') E)
UNION ALL
(SELECT '25' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_25) AS count4 FROM feedbacks_for_exit WHERE value_25='4') A,
(SELECT COUNT(value_25) AS count3 FROM feedbacks_for_exit WHERE value_25='3') B,
(SELECT COUNT(value_25) AS count2 FROM feedbacks_for_exit WHERE value_25='2') C,
(SELECT COUNT(value_25) AS count1 FROM feedbacks_for_exit WHERE value_25='1') D,
(SELECT COUNT(value_25) AS count0 FROM feedbacks_for_exit WHERE value_25='0') E)
UNION ALL
(SELECT '26' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_26) AS count4 FROM feedbacks_for_exit WHERE value_26='4') A,
(SELECT COUNT(value_26) AS count3 FROM feedbacks_for_exit WHERE value_26='3') B,
(SELECT COUNT(value_26) AS count2 FROM feedbacks_for_exit WHERE value_26='2') C,
(SELECT COUNT(value_26) AS count1 FROM feedbacks_for_exit WHERE value_26='1') D,
(SELECT COUNT(value_26) AS count0 FROM feedbacks_for_exit WHERE value_26='0') E)
UNION ALL
(SELECT '27' AS 'qid', A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT COUNT(value_27) AS count4 FROM feedbacks_for_exit WHERE value_27='4') A,
(SELECT COUNT(value_27) AS count3 FROM feedbacks_for_exit WHERE value_27='3') B,
(SELECT COUNT(value_27) AS count2 FROM feedbacks_for_exit WHERE value_27='2') C,
(SELECT COUNT(value_27) AS count1 FROM feedbacks_for_exit WHERE value_27='1') D,
(SELECT COUNT(value_27) AS count0 FROM feedbacks_for_exit WHERE value_27='0') E)) yy
WHERE xx.id=yy.qid
ORDER BY xx.id");
        return $result = $query->result();
    }

    public function getExitCommentForNextPlan() {
        $this->db->select("next_plan AS comments");
        $this->db->from("feedbacks_for_exit AS comments");
        $this->db->order_by("id desc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getExitCommentForSessionJam() {
        $this->db->select("comments_on_session_jam AS comments");
        $this->db->from("feedbacks_for_exit");
        $this->db->order_by("id desc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getExitCommentForSuggestions() {
        $this->db->select("suggestions_for_improving AS comments");
        $this->db->from("feedbacks_for_exit");
        $this->db->order_by("id desc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getExitCommentForIssue() {
        $this->db->select("comment_in_issue AS comments");
        $this->db->from("feedbacks_for_exit");
        $this->db->order_by("id desc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getInstructorNameOnly($tid) {
        $this->db->select('u.full_name');
        $this->db->from('feedback_users u');
        $this->db->where('u.username',$tid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getAvgSpentHourCourseWise($cid, $semid) {
        $this->db->select('c.course_id, ROUND(AVG(c.w_spent_time_hour),2) AS w_spent_time_hour');
        $this->db->from('feedbacks_for_course c');
        $this->db->where('c.course_id',$cid);
        $this->db->where('c.semester_id',$semid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getAvgSpentHourInstructorWise($cid, $tid, $semid) {
        $this->db->select('t.course_id, ROUND(AVG(t.w_spent_time_hour),2) AS w_spent_time_hour');
        $this->db->from('feedbacks_for_instructor t');
        $this->db->where('t.course_id',$cid);
        $this->db->where('t.instructor',$tid);
        $this->db->where('t.semester_id',$semid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getGradesCount($cid, $semid) {
        $query=$this->db->query("(SELECT grade.grade, IFNULL(counts, 0) AS counts FROM grade LEFT JOIN (SELECT expected_grade, COUNT(expected_grade) AS counts FROM feedbacks_for_course WHERE course_id='".$cid."' AND semester_id='".$semid."' GROUP BY expected_grade) t2 ON grade.grade=t2.expected_grade ORDER BY grade.grade)
        UNION ALL
        (SELECT 'Total' AS grade, COUNT(expected_grade) AS counts FROM feedbacks_for_course WHERE course_id='".$cid."' AND semester_id='".$semid."')");
        return $result = $query->result();
    }
    public function getGradesCountInstructor($cid, $tid, $semid) {
        $query=$this->db->query("(SELECT grade.grade, IFNULL(counts, 0) AS counts FROM grade LEFT JOIN (SELECT expected_grade, COUNT(expected_grade) AS counts FROM feedbacks_for_instructor WHERE course_id='".$cid."' AND semester_id='".$semid."' AND instructor='".$tid."' GROUP BY expected_grade) t2 ON grade.grade=t2.expected_grade ORDER BY grade.grade)
        UNION ALL
        (SELECT 'Total' AS grade, COUNT(expected_grade) AS counts FROM feedbacks_for_instructor WHERE course_id='".$cid."' AND semester_id='".$semid."' AND instructor='".$tid."' )");
        return $result = $query->result();
    }

    public function getCourseFeedbackGivenList($cid, $semid, $status) {
        $this->db->select('c.student_id, u.full_name');
        $this->db->from('semester_course c, feedback_users u');
        $this->db->where('`c`.`student_id`=`u`.username');
        $this->db->where('c.course_id',$cid);
        $this->db->where('`c`.`course_status`',$status);
        //$this->db->where('t.instructor',$tid);
        $this->db->where('c.semester_id',$semid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getInstructorFeedbackGivenList($cid, $semid, $tid, $status) {
        $this->db->select('c.student_id, u.full_name');
        $this->db->from('semester_course_instructor c, feedback_users u');
        $this->db->where('`c`.`student_id`=`u`.username');
        $this->db->where('c.course_id',$cid);
        $this->db->where('`c`.`teacher_status`',$status);
        $this->db->where('c.teacher_id',$tid);
        $this->db->where('c.semester_id',$semid);
        $query = $this->db->get();
        return $result = $query->result();
    }


    function __destruct() {
        $this->db->close();
    }

}