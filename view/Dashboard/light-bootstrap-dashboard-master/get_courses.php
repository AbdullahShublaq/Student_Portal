<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 18/05/2019
 * Time: 02:21 م
 */

include_once('../../../controller/CourseController.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['semester'])) {
        $semester_number = $_POST['semester'];
//        echo $semester_number;
        $table = CourseController::get_Courses($semester_number);
//        print_r($table);
        $a = array();

        foreach ($table as $item){
//            echo"<br>";
           // $tt += $item;
            array_push($a,$item);
//            echo"<br>";
        }
        echo json_encode($a);

    }
}
?>

