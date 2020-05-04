<?php

include_once('../../../controller/StudentController.php');
include_once('../../../controller/CourseController.php');
include_once('../../../model/Student.php');

$server = "http://localhost:63342";
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['logged_in']) == true || $_COOKIE['id']) {

    if (isset($_COOKIE['id'])) {
        $id = $_COOKIE['id'];
    } else {
        $id = $_SESSION['id'];
    }

    $result = StudentController::get_student($id);
    while ($row = $result->fetch_assoc()) {
        $student = new Student(
            $row['id'],
            $row['name'],
            $row['email'],
            $row['phone'],
            $row['gpa']
        );
    }
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link href="assets/img/favicon.ico" rel="icon" type="image/png">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>

        <title>Dashboard</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
        <meta content="width=device-width" name="viewport"/>


        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>

        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet"/>

        <!--    sweet alert-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>
    </head>
    <body>

    <div class="wrapper">
        <div class="sidebar" data-color="black" data-image="assets/img/sidebar-4.jpg">

            <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href='' class='simple-text'>
                        <img src='assets/img/default-avatar.png' alt='''><br><br>
                        <span><?php echo $student->getName() ?></span> <br>
                        <span id="student_id">&apos; <?php echo $student->getId() ?> &apos;</span>
                    </a>
                </div>

                <ul class="nav">
                    <li>
                        <a href="index.php">
                            <i class="pe-7s-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="registration.php">
                            <i class="pe-7s-note2"></i>
                            <p>Course Registration</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="table.php">
                            <i class="pe-7s-airplay"></i>
                            <p>Semester Table</p>
                        </a>
                    </li>
                    <li>
                        <a href="grade.php">
                            <i class="pe-7s-news-paper"></i>
                            <p>Grades</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="logout.php">
                            <i class="pe-7s-rocket"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#navigation-example-2" data-toggle="collapse"
                                type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">SEMESTER TABLE</a>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <div class="row"></div>
                                    <div class="col-md-4">
                                        <h4 class="title">Semester Table</h4>
                                        <p class="category">Here is a semesters table</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputState">Choose year</label>
                                        <select name="year" id="inputState" class="form-control">
                                            <?php
                                            $result = CourseController::get_years($student->getId());
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option>' . $row["year"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputState">Choose semester number</label>
                                        <select name="semester" id="inputState" class="form-control">
                                            <?php
                                            $result = CourseController::get_semesters($student->getId());
                                            $count = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option>' . $row["number"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input id="button" type="button" class="btn btn-fill btn-info"
                                               style="margin-top: 1.7em" value="GO">
                                    </div>
                                    <br>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>Course ID</th>
                                        <th>Course Name</th>
                                        <th>Instructor Name</th>
                                        <th>Section Number</th>
                                        <th>Room</th>
                                        <th>SAT</th>
                                        <th>SUN</th>
                                        <th>MUN</th>
                                        <th>TUE</th>
                                        <th>WED</th>
                                        <th>THU</th>
                                        <th>FRI</th>
                                        </thead>
                                        <tbody id="table">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <p class="copyright pull-right">
                            &copy; Abdullah Shublaq , made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
    </body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE" type="text/javascript"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>


    </html>
    <?php
} else {
    header("Location: $server/Student_Portal/view/Login/");
}
?>


<script type="text/javascript">
    $(document).ready(function (e) {
        $('#button').click(function (e) {
            e.preventDefault();
            var student = document.getElementById("student_id").textContent;
            $.ajax({
                url: 'get_table.php',
                data: {
                    'year': $('select[name="year"] option:selected').val(),
                    'semester': $('select[name="semester"] option:selected').val(),
                    'student': student
                },
                method: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    $('#table').html('');
                    for (var i = 0; i < data.length; i++) {
                        var start = '<tr><td>' + data[i]["id"] + '</td>' +
                            '<td>' + data[i]["course_name"] + '</td>' +
                            '<td>' + data[i]["instr_name"] + '</td>' +
                            '<td>' + data[i]["Section_no"] + '</td>' +
                            '<td>' + data[i]["room"] + '</td>';

                        var middle = '';

                        if(data[i]["days"].includes('sat')){
                            middle+=('<td>' + data[i]["start_time"] + '-' + data[i]["end_time"] + '</td>');
                        }else{
                            middle+=('<td></td>');
                        }

                        if(data[i]["days"].includes('sun')){
                            middle+=('<td>' + data[i]["start_time"] + '-' + data[i]["end_time"] + '</td>');
                        }else{
                            middle+=('<td></td>');
                        }

                        if(data[i]["days"].includes('mon')){
                            middle+=('<td>' + data[i]["start_time"] + '-' + data[i]["end_time"] + '</td>');
                        }else{
                            middle+=('<td></td>');
                        }

                        if(data[i]["days"].includes('tue')){
                            middle+=('<td>' + data[i]["start_time"] + '-' + data[i]["end_time"] + '</td>');
                        }else{
                            middle+=('<td></td>');
                        }

                        if(data[i]["days"].includes('wed')){
                            middle+=('<td>' + data[i]["start_time"] + '-' + data[i]["end_time"] + '</td>');
                        }else{
                            middle+=('<td></td>');
                        }

                        if(data[i]["days"].includes('thu')){
                            middle+=('<td>' + data[i]["start_time"] + '-' + data[i]["end_time"] + '</td>');
                        }else{
                            middle+=('<td></td>');
                        }

                        if(data[i]["days"].includes('fri')){
                            middle+=('<td>' + data[i]["start_time"] + '-' + data[i]["end_time"] + '</td>');
                        }else{
                            middle+=('<td></td>');
                        }

                        var end = '</tr>';

                        var result = start.concat(middle).concat(end);

                        $('#table').append(result);
                    }
                },
                error: function (data, textStatus) {
                    swal("Failed!", "Some Thing Is Error!", "error");
                }
            });
        });
    });

</script>

