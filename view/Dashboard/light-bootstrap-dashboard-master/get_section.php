<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 18/05/2019
 * Time: 05:22 م
 */

include_once('../../../controller/CourseController.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['course_id'])) {
        $table = CourseController::get_sections($_POST['course_id']);
        $a = array();
        foreach ($table as $item){
            array_push($a,$item);
        }
//        print_r($a);
        echo json_encode($a);
    }
}