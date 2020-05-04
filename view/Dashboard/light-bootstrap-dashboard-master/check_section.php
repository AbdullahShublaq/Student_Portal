<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 18/05/2019
 * Time: 06:47 م
 */

include_once('../../../controller/CourseController.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['section_id'])){
        $secion_id = $_POST['section_id'];
        $result = CourseController::check_section($secion_id);
        if($result->num_rows > 0){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
}