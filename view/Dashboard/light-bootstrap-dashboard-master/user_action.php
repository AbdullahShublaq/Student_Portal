<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 12/05/2019
 * Time: 08:34 م
 */

include_once('../../../controller/StudentController.php');

$status = array("status" => false, "message" => "");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['student_email']) && isset($_POST['student_phone']) && isset($_POST['student_id'])) {

        $email = $_POST['student_email'];
        $phone = $_POST['student_phone'];
        $id = $_POST['student_id'];

        $result = StudentController::update_student($id, $email, $phone);
        if ($result) {
            $status["status"] = true;
            $status["message"] = "Added Successfully";
            echo json_encode($status);
        }else {
            $status["message"] = "Internal Server Error";
            echo json_encode($status);
        }

    } else {
        $status["message"] = "Some Data are Missing";
        echo json_encode($status);
    }
} else {
    $status["message"] = "Method is not Allowed";
    echo json_encode($status);
}
