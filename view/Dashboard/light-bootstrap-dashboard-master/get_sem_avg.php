<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 21/05/2019
 * Time: 03:15 م
 */

include_once('../../../controller/CourseController.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['semester']) && isset($_POST['year']) && isset($_POST['student'])) {
        $semester = $_POST['semester'];
        $year = $_POST['year'];
        $student = $_POST['student'];

        $table = CourseController::get_Semester_avg($year, $semester, $student);

        $a = array();

        foreach ($table as $item){
            array_push($a,$item);
        }
        echo json_encode($a);
    }
}
