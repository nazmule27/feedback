<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor_home_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getSemesters() {
        $this->db->select("semester_id");
        $this->db->distinct("semester_id");
        $this->db->from("semester_course_instructor ");
        $this->db->order_by("id desc");
        $query = $this->db->get();
        return $result = $query->result();
    }

    /*public function getCourses1($tid) {
        $this->db->select("ci.course_id, ci.semester_id, c.course_name, ci.teacher_id, u.full_name");
        $this->db->distinct("ci.course_id, ci.semester_id");
        $this->db->from("semester_course_instructor ci, feedback_users u, course_list c");
        $this->db->where("`ci.teacher_id`=`u.username`");
        $this->db->where("`ci.course_id`=`c.course_id`");
        $this->db->where("ci.teacher_id", $tid);
        $this->db->order_by("ci.semester_id, ci.course_id");
        $query = $this->db->get();
        return $result = $query->result();
    }*/
    public function getCourses($sid, $tid) {
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
  AND `s`.`semester_id` = "."'".$sid."'"."
  AND `s`.`teacher_id` = "."'".$tid."'"."
  AND `s`.`course_id` = `c`.`course_id`) t1
  LEFT JOIN
(SELECT course_id, COUNT(course_id) AS course_given FROM feedbacks_for_course WHERE semester_id = "."'".$sid."'"." GROUP BY course_id, semester_id) t2
ON t1.course_id = t2.course_id) tt1
LEFT JOIN
(SELECT instructor, course_id, COUNT(course_id) AS instructor_given FROM feedbacks_for_instructor WHERE semester_id = "."'".$sid."'"." GROUP BY course_id, instructor, semester_id) tt2
ON tt1.course_id = tt2.course_id AND tt1.teacher_id = tt2.instructor
ORDER BY tt1.course_id, tt1.teacher_id
");
        return $result = $query->result();
    }

    public function getFeedbackSummeryForCourse($cid, $semid) {
        $query=$this->db->query("SELECT xx.question, yy.course_id, yy.count4, yy.count3, yy.count2, yy.count1, yy.count0 FROM questiions_for_course xx,
((SELECT '1' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count4 FROM feedbacks_for_course WHERE value_1='4'  AND course_id='".$cid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count3 FROM feedbacks_for_course WHERE value_1='3'  AND course_id='".$cid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count2 FROM feedbacks_for_course WHERE value_1='2'  AND course_id='".$cid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count1 FROM feedbacks_for_course WHERE value_1='1'  AND course_id='".$cid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count0 FROM feedbacks_for_course WHERE value_1='0'  AND course_id='".$cid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '2' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count4 FROM feedbacks_for_course WHERE value_2='4'  AND course_id='".$cid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count3 FROM feedbacks_for_course WHERE value_2='3'  AND course_id='".$cid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count2 FROM feedbacks_for_course WHERE value_2='2'  AND course_id='".$cid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count1 FROM feedbacks_for_course WHERE value_2='1'  AND course_id='".$cid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count0 FROM feedbacks_for_course WHERE value_2='0'  AND course_id='".$cid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '3' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count4 FROM feedbacks_for_course WHERE value_3='4'  AND course_id='".$cid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count3 FROM feedbacks_for_course WHERE value_3='3'  AND course_id='".$cid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count2 FROM feedbacks_for_course WHERE value_3='2'  AND course_id='".$cid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count1 FROM feedbacks_for_course WHERE value_3='1'  AND course_id='".$cid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count0 FROM feedbacks_for_course WHERE value_3='0'  AND course_id='".$cid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '4' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count4 FROM feedbacks_for_course WHERE value_4='4'  AND course_id='".$cid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count3 FROM feedbacks_for_course WHERE value_4='3'  AND course_id='".$cid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count2 FROM feedbacks_for_course WHERE value_4='2'  AND course_id='".$cid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count1 FROM feedbacks_for_course WHERE value_4='1'  AND course_id='".$cid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count0 FROM feedbacks_for_course WHERE value_4='0'  AND course_id='".$cid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '5' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count4 FROM feedbacks_for_course WHERE value_5='4'  AND course_id='".$cid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count3 FROM feedbacks_for_course WHERE value_5='3'  AND course_id='".$cid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count2 FROM feedbacks_for_course WHERE value_5='2'  AND course_id='".$cid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count1 FROM feedbacks_for_course WHERE value_5='1'  AND course_id='".$cid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count0 FROM feedbacks_for_course WHERE value_5='0'  AND course_id='".$cid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '6' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count4 FROM feedbacks_for_course WHERE value_6='4'  AND course_id='".$cid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count3 FROM feedbacks_for_course WHERE value_6='3'  AND course_id='".$cid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count2 FROM feedbacks_for_course WHERE value_6='2'  AND course_id='".$cid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count1 FROM feedbacks_for_course WHERE value_6='1'  AND course_id='".$cid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count0 FROM feedbacks_for_course WHERE value_6='0'  AND course_id='".$cid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '7' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count4 FROM feedbacks_for_course WHERE value_7='4'  AND course_id='".$cid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count3 FROM feedbacks_for_course WHERE value_7='3'  AND course_id='".$cid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count2 FROM feedbacks_for_course WHERE value_7='2'  AND course_id='".$cid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count1 FROM feedbacks_for_course WHERE value_7='1'  AND course_id='".$cid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count0 FROM feedbacks_for_course WHERE value_7='0'  AND course_id='".$cid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '8' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count4 FROM feedbacks_for_course WHERE value_8='4'  AND course_id='".$cid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count3 FROM feedbacks_for_course WHERE value_8='3'  AND course_id='".$cid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count2 FROM feedbacks_for_course WHERE value_8='2'  AND course_id='".$cid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count1 FROM feedbacks_for_course WHERE value_8='1'  AND course_id='".$cid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count0 FROM feedbacks_for_course WHERE value_8='0'  AND course_id='".$cid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '9' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count4 FROM feedbacks_for_course WHERE value_9='4'  AND course_id='".$cid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count3 FROM feedbacks_for_course WHERE value_9='3'  AND course_id='".$cid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count2 FROM feedbacks_for_course WHERE value_9='2'  AND course_id='".$cid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count1 FROM feedbacks_for_course WHERE value_9='1'  AND course_id='".$cid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count0 FROM feedbacks_for_course WHERE value_9='0'  AND course_id='".$cid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)) yy
WHERE xx.id=yy.qid");
        return $result = $query->result();
    }

    public function getFeedbackSummeryForTeacher($tid, $cid, $semid) {
        $query=$this->db->query("
SELECT xx.question, yy.course_id, yy.count4, yy.count3, yy.count2, yy.count1, yy.count0 FROM questiions_for_instructor xx,
((SELECT '1' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count4 FROM feedbacks_for_instructor WHERE value_1='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count3 FROM feedbacks_for_instructor WHERE value_1='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count2 FROM feedbacks_for_instructor WHERE value_1='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count1 FROM feedbacks_for_instructor WHERE value_1='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_1) AS count0 FROM feedbacks_for_instructor WHERE value_1='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '2' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count4 FROM feedbacks_for_instructor WHERE value_2='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count3 FROM feedbacks_for_instructor WHERE value_2='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count2 FROM feedbacks_for_instructor WHERE value_2='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count1 FROM feedbacks_for_instructor WHERE value_2='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_2) AS count0 FROM feedbacks_for_instructor WHERE value_2='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '3' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count4 FROM feedbacks_for_instructor WHERE value_3='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count3 FROM feedbacks_for_instructor WHERE value_3='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count2 FROM feedbacks_for_instructor WHERE value_3='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count1 FROM feedbacks_for_instructor WHERE value_3='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_3) AS count0 FROM feedbacks_for_instructor WHERE value_3='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '4' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count4 FROM feedbacks_for_instructor WHERE value_4='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count3 FROM feedbacks_for_instructor WHERE value_4='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count2 FROM feedbacks_for_instructor WHERE value_4='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count1 FROM feedbacks_for_instructor WHERE value_4='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_4) AS count0 FROM feedbacks_for_instructor WHERE value_4='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '5' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count4 FROM feedbacks_for_instructor WHERE value_5='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count3 FROM feedbacks_for_instructor WHERE value_5='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count2 FROM feedbacks_for_instructor WHERE value_5='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count1 FROM feedbacks_for_instructor WHERE value_5='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_5) AS count0 FROM feedbacks_for_instructor WHERE value_5='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '6' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count4 FROM feedbacks_for_instructor WHERE value_6='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count3 FROM feedbacks_for_instructor WHERE value_6='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count2 FROM feedbacks_for_instructor WHERE value_6='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count1 FROM feedbacks_for_instructor WHERE value_6='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_6) AS count0 FROM feedbacks_for_instructor WHERE value_6='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '7' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count4 FROM feedbacks_for_instructor WHERE value_7='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count3 FROM feedbacks_for_instructor WHERE value_7='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count2 FROM feedbacks_for_instructor WHERE value_7='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count1 FROM feedbacks_for_instructor WHERE value_7='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_7) AS count0 FROM feedbacks_for_instructor WHERE value_7='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '8' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count4 FROM feedbacks_for_instructor WHERE value_8='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count3 FROM feedbacks_for_instructor WHERE value_8='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count2 FROM feedbacks_for_instructor WHERE value_8='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count1 FROM feedbacks_for_instructor WHERE value_8='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_8) AS count0 FROM feedbacks_for_instructor WHERE value_8='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '9' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count4 FROM feedbacks_for_instructor WHERE value_9='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count3 FROM feedbacks_for_instructor WHERE value_9='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count2 FROM feedbacks_for_instructor WHERE value_9='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count1 FROM feedbacks_for_instructor WHERE value_9='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_9) AS count0 FROM feedbacks_for_instructor WHERE value_9='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '10' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_10) AS count4 FROM feedbacks_for_instructor WHERE value_10='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_10) AS count3 FROM feedbacks_for_instructor WHERE value_10='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_10) AS count2 FROM feedbacks_for_instructor WHERE value_10='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_10) AS count1 FROM feedbacks_for_instructor WHERE value_10='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_10) AS count0 FROM feedbacks_for_instructor WHERE value_10='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '11' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_11) AS count4 FROM feedbacks_for_instructor WHERE value_11='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_11) AS count3 FROM feedbacks_for_instructor WHERE value_11='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_11) AS count2 FROM feedbacks_for_instructor WHERE value_11='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_11) AS count1 FROM feedbacks_for_instructor WHERE value_11='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_11) AS count0 FROM feedbacks_for_instructor WHERE value_11='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '12' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_12) AS count4 FROM feedbacks_for_instructor WHERE value_12='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_12) AS count3 FROM feedbacks_for_instructor WHERE value_12='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_12) AS count2 FROM feedbacks_for_instructor WHERE value_12='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_12) AS count1 FROM feedbacks_for_instructor WHERE value_12='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_12) AS count0 FROM feedbacks_for_instructor WHERE value_12='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '13' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_13) AS count4 FROM feedbacks_for_instructor WHERE value_13='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_13) AS count3 FROM feedbacks_for_instructor WHERE value_13='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_13) AS count2 FROM feedbacks_for_instructor WHERE value_13='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_13) AS count1 FROM feedbacks_for_instructor WHERE value_13='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_13) AS count0 FROM feedbacks_for_instructor WHERE value_13='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '14' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_14) AS count4 FROM feedbacks_for_instructor WHERE value_14='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_14) AS count3 FROM feedbacks_for_instructor WHERE value_14='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_14) AS count2 FROM feedbacks_for_instructor WHERE value_14='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_14) AS count1 FROM feedbacks_for_instructor WHERE value_14='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_14) AS count0 FROM feedbacks_for_instructor WHERE value_14='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)
UNION ALL
(SELECT '15' AS 'qid', A.course_id, A.count4, B.count3, C.count2, D.count1, E.count0 FROM
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_15) AS count4 FROM feedbacks_for_instructor WHERE value_15='4'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') A,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_15) AS count3 FROM feedbacks_for_instructor WHERE value_15='3'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') B,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_15) AS count2 FROM feedbacks_for_instructor WHERE value_15='2'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') C,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_15) AS count1 FROM feedbacks_for_instructor WHERE value_15='1'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') D,
(SELECT CASE WHEN (course_id IS NULL) THEN '".$cid."' ELSE course_id END AS course_id, COUNT(value_15) AS count0 FROM feedbacks_for_instructor WHERE value_15='0'  AND course_id='".$cid."' AND instructor='".$tid."' AND semester_id='".$semid."') E
WHERE A.course_id=B.course_id
AND A.course_id=C.course_id
AND A.course_id=D.course_id
AND A.course_id=E.course_id)) yy
WHERE xx.id=yy.qid");
        return $result = $query->result();
    }
    public function getCommentForCourse($cid, $semid) {
        $this->db->select("comments");
        $this->db->from("feedbacks_for_course");
        $this->db->where("course_id", $cid);
        $this->db->where("semester_id", $semid);
        $this->db->order_by("id");
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function getCommentForInstructor($tid, $cid, $semid) {
        $this->db->select("comments");
        $this->db->from("feedbacks_for_instructor");
        $this->db->where("instructor", $tid);
        $this->db->where("course_id", $cid);
        $this->db->where("semester_id", $semid);
        $this->db->order_by("id");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function checkCourseInstructor($tid, $cid, $semid) {
        $this->db->select("i.course_id, d.semester_id, d.date_id");
        $this->db->distinct("i.course_id, d.semester_id, d.date_id");
        $this->db->from("date_range d, semester_course_instructor i");
        $this->db->where("`d`.`semester_id`=`i`.`semester_id`");
        $this->db->where("`i`.`teacher_id`", $tid);
        $this->db->where("`i`.`course_id`", $cid);
        $this->db->where("`i`.`semester_id`", $semid);
        $this->db->where("`d`.`date_id`='inst_feedback'");
        $this->db->where("NOW() BETWEEN `d`.`start_date` AND `d`.`end_date`");
        $query = $this->db->get();
        return $result = $query->result();
    }

    function __destruct() {
        $this->db->close();
    }

}