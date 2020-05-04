<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 23/05/2019
 * Time: 02:03 م
 */

include_once('../../../controller/CourseController.php');


//semester_course_id': semester_course_id,
//                'student_id': student_id

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['semester_course_id']) && isset($_POST['student_id'])){
        $semester_course_id = $_POST['semester_course_id'];
        $student_id = $_POST['student_id'];

        $result = CourseController::conflict($semester_course_id, $student_id);
        echo json_encode($result);
    }
}