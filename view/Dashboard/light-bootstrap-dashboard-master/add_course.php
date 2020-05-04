<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 23/05/2019
 * Time: 03:58 م
 */

include_once('../../../controller/CourseController.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['semester_course_id']) && isset($_POST['student_id'])) {
        $semester_course_id = $_POST['semester_course_id'];
        $student_id = $_POST['student_id'];

//        echo json_encode($semester_course_id);
//        echo json_encode("<br>");
//        echo json_encode($student_id);
//        echo json_encode("<br>");

        $result = CourseController::add_course($semester_course_id, $student_id);

//        echo json_encode(print_r($result));
//        echo json_encode("<br>");
        echo json_encode($result);
    }
}