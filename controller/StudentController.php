<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 09/05/2019
 * Time: 05:16 م
 */

include_once("connection.php");

//error_reporting(E_ERROR | E_PARSE);

class StudentController
{

    public static function verify_password($id, $password)
    {
//        $psw_md5 = md5($password);
        $connection = DBConnection::get_instance()->get_connection();
        $query = "SELECT * from student WHERE id = '" . $id . "' AND password_md5 = '" . md5($password) . "'";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function get_student($id)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "SELECT * from student WHERE id = " . $id;
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function update_student($id, $email, $phone)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "UPDATE student SET email = '$email', phone = '$phone' WHERE id = '$id'";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function set_gpa($id){
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  UPDATE student SET gpa = (
                    SELECT TRUNCATE((SUM(registered_courses.grade * course.hours) / SUM(course.hours)), 2) as avg                
                    FROM registered_courses
                    INNER JOIN semester_course
                    ON registered_courses.Semester_Course_id = semester_course.id
                    INNER JOIN course
                    ON course.id = semester_course.Course_id
                    INNER JOIN semester
                    ON semester.id = semester_course.Semester_id  
                    WHERE  
                    student.id = $id)";
        $result = mysqli_query($connection, $query);
        return $result;
    }

}