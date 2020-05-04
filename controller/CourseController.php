<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 18/05/2019
 * Time: 02:11 م
 */

include_once("connection.php");

class CourseController
{

    public static function get_Courses($semester_number)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  SELECT DISTINCT course.id, course.name
                  FROM semester_course
                  INNER JOIN course
                  ON semester_course.Course_id = course.id
                  INNER JOIN time_table
                  ON semester_course.Time_Table_id = time_table.id
                  INNER JOIN instructors
                  ON semester_course.Instructor_id = instructors.id
                  INNER JOIN semester
                  ON semester_course.Semester_id = semester.id
                  WHERE semester.number = '$semester_number'";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function get_sections($course_id)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  SELECT semester_course.id, time_table.Section_no, instructors.name, time_table.days, time_table.start_time, time_table.end_time
                  FROM semester_course
                  INNER JOIN course
                  ON semester_course.Course_id = course.id
                  INNER JOIN time_table
                  ON semester_course.Time_Table_id = time_table.id
                  INNER JOIN instructors
                  ON semester_course.Instructor_id = instructors.id
                  INNER JOIN semester
                  ON semester_course.Semester_id = semester.id
                  WHERE course.id = '$course_id'";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function check_section($semester_course_id)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  SELECT * 
                  FROM registered_courses 
                  WHERE 
                  registered_courses.Semester_Course_id = $semester_course_id";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function remove_course($semester_course_id, $student_id)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  DELETE
                  FROM registered_courses
                  WHERE 
                  registered_courses.Semester_Course_id = '$semester_course_id'
                  AND
                  registered_courses.Student_id = $student_id";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function get_years($student_id)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  SELECT DISTINCT semester.year
                  FROM semester
                  INNER JOIN semester_course
                  ON semester_course.Semester_id = semester.id
                  INNER JOIN registered_courses
                  ON registered_courses.Semester_Course_id = semester_course.id
                  WHERE registered_courses.Student_id = $student_id";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function get_semesters($student_id)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  SELECT DISTINCT semester.number
                  FROM semester
                  INNER JOIN semester_course
                  ON semester_course.Semester_id = semester.id
                  INNER JOIN registered_courses
                  ON registered_courses.Semester_Course_id = semester_course.id
                  WHERE registered_courses.Student_id = $student_id";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function get_table($year, $semester, $student)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  SELECT 
                  course.id, 
                  course.name AS course_name, 
                  instructors.name AS instr_name, 
                  time_table.Section_no,
                  time_table.room, 
                  time_table.days, 
                  time_table.start_time, 
                  time_table.end_time               
                  FROM registered_courses
                  INNER JOIN semester_course
                  ON registered_courses.Semester_Course_id = semester_course.id
                  INNER JOIN course
                  ON course.id = semester_course.Course_id
                  INNER JOIN instructors
                  ON instructors.id = semester_course.Instructor_id
                  INNER JOIN semester
                  ON semester.id = semester_course.Semester_id
                  INNER JOIN student
                  ON student.id = registered_courses.Student_id
                  INNER JOIN time_table
                  ON semester_course.Time_Table_id = time_table.id                  
                  WHERE semester.year = $year AND semester.number = $semester AND student.id = $student";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function get_grade($year, $semester, $student)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  SELECT 
                  course.id, 
                  course.name AS course_name, 
                  registered_courses.grade                
                  FROM registered_courses
                  INNER JOIN semester_course
                  ON registered_courses.Semester_Course_id = semester_course.id
                  INNER JOIN course
                  ON course.id = semester_course.Course_id
                  INNER JOIN instructors
                  ON instructors.id = semester_course.Instructor_id
                  INNER JOIN semester
                  ON semester.id = semester_course.Semester_id
                  INNER JOIN student
                  ON student.id = registered_courses.Student_id
                  INNER JOIN time_table
                  ON semester_course.Time_Table_id = time_table.id                  
                  WHERE semester.year = $year AND semester.number = $semester AND student.id = $student";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function get_Semester_avg($year, $semester, $student)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                SELECT TRUNCATE((SUM(registered_courses.grade * course.hours) / SUM(course.hours)), 2) AS avg
                FROM registered_courses
                INNER JOIN semester_course
                ON registered_courses.Semester_Course_id = semester_course.id
                INNER JOIN course
                ON course.id = semester_course.Course_id
                INNER JOIN semester
                ON semester.id = semester_course.Semester_id
                INNER JOIN student
                ON student.id = registered_courses.Student_id             
                WHERE 
                semester.year = $year 
                AND 
                semester.number = $semester 
                AND 
                student.id = $student";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    public static function conflict($semester_course_id, $student_id)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  SELECT semester_course.Course_id, time_table.days, time_table.start_time, time_table.end_time, semester.year, semester.number
                  FROM semester_course
                  INNER JOIN time_table
                  ON time_table.id = semester_course.Time_Table_id
                  INNER JOIN semester
                  ON semester.id = semester_course.Semester_id
                  INNER JOIN student
                  ON student.id = $student_id
                  WHERE
                  semester_course.id = $semester_course_id";
        $result = mysqli_query($connection, $query);

        $add_course_id = "";
        $add_days = "";
        $add_stime = "";
        $add_etime = "";
        $add_semesterY = "";
        $add_semesterN = "";

        while ($row = $result->fetch_assoc()) {
            $add_course_id = $row['Course_id'];
            $add_days = $row['days'];
            $add_stime = $row['start_time'];
            $add_etime = $row['end_time'];
            $add_semesterY = $row['year'];
            $add_semesterN = $row['number'];
        }

        $query2 = "
                  SELECT course.id, course.name
                  FROM registered_courses
                  INNER JOIN semester_course
                  ON registered_courses.Semester_Course_id = semester_course.id
                  INNER JOIN course
                  ON semester_course.Course_id = course.id
                  INNER JOIN time_table
                  ON semester_course.Time_Table_id = time_table.id
                  INNER JOIN semester
                  ON semester.id = semester_course.Semester_id
                  WHERE 
                  registered_courses.Student_id = $student_id
                  AND 
                  (semester.year = $add_semesterY AND semester.number = $add_semesterN)
                  AND 
                  (time_table.days = '$add_days')
                  AND
                  (course.id <> $add_course_id)
                  AND
                  NOT ((time_table.end_time = $add_stime) AND (time_table.start_time < $add_stime))
                  AND
                  NOT ((time_table.start_time = $add_etime) AND (time_table.end_time > $add_etime))
                  AND
                  (
                  time_table.start_time BETWEEN $add_stime AND $add_etime
                  OR
                  time_table.end_time BETWEEN $add_stime AND $add_etime
                  OR
                  $add_stime BETWEEN  time_table.start_time AND time_table.end_time
                  OR
                  $add_etime BETWEEN  time_table.start_time AND time_table.end_time    
                  )
                  ";
        $result2 = mysqli_query($connection, $query2);

        $get_course_id = "";
        $get_course_name = "";

        $status = array("status" => false, "message" => "");
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $get_course_id = $row['id'];
                $get_course_name = $row['name'];
                $status = array("status" => true, "message" => "This course conflict with\n" . $get_course_id . " - " . $get_course_name);
            }
        } else {
            $status = array("status" => false, "message" => "Add Complete!");
        }

        return $status;

    }

    public static function check_course_found($course_id, $student_id)
    {
        $connection = DBConnection::get_instance()->get_connection();
        $query = "
                  SELECT registered_courses.Semester_Course_id
                  FROM registered_courses
                  INNER JOIN semester_course
                  ON semester_course.id =registered_courses.Semester_Course_id
                  INNER JOIN course
                  ON semester_course.Course_id = course.id
                  WHERE
                  course.id = $course_id
                  AND
                  registered_courses.Student_id = $student_id";
        $result = mysqli_query($connection, $query);

        return $result;
    }

    public static function add_course($semester_course_id, $student_id){
        $connection = DBConnection::get_instance()->get_connection();
        $grade = rand(60, 100);
        $query = "
                 INSERT INTO `registered_courses`(`Student_id`, `Semester_Course_id`, `grade`)                  
                 VALUES ($student_id, $semester_course_id, $grade)
                 ";
        $result = mysqli_query($connection, $query);
//        return mysqli_error($connection);
        return $result;
    }
}
