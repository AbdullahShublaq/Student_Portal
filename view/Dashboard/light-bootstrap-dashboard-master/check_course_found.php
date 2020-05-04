<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 23/05/2019
 * Time: 03:47 م
 */

include_once('../../../controller/CourseController.php');


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['course_id']) && isset($_POST['student_id'])){
        $semester_course_id = $_POST['course_id'];
        $student_id = $_POST['student_id'];

        $result = CourseController::check_course_found($semester_course_id, $student_id);

        $status = array("status" => false, "message" => "");
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $status = array("status" => true, "message" => $row['Semester_Course_id']);
            }
        }else{
            $status = array("status" => false, "message" => "");
        }

        echo json_encode($status);
    }
}