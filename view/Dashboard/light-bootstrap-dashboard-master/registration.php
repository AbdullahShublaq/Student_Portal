<?php

include_once('../../../controller/StudentController.php');
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
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

        <title>Dashboard</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
        <meta name="viewport" content="width=device-width"/>


        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>

        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet"/>
        <link rel="stylesheet" href="../../../style/registration.css">

        <!--    sweet alert-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>

        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>

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
                    <li class="active">
                        <a href="registration.php">
                            <i class="pe-7s-note2"></i>
                            <p>Course Registration</p>
                        </a>
                    </li>
                    <li>
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
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">COURSE REGISTRATION</a>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <form method="POST" action="">
                                        <div class="col-md-6">
                                            <h4 class="title">Courses</h4>
                                            <p class="category">Here is a courses for register</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputState">Choose semester number</label>
                                            <select id="inputState" class="form-control" name="semester">
                                                <option selected>1</option>
                                                <option>2</option>
                                            </select>
                                            <button id="btn-submit" type="button" class="btn btn-fill btn-info">GO
                                            </button>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                                <br><br>
                                <div class="content table-responsive table-full-width">
                                    <table id="course_table" class="table table-hover table-striped">
                                        <thead>
                                        <th>Course ID</th>
                                        <th>Course Name</th>
                                        <th></th>
                                        </thead>
                                        <tbody id="course_table_body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-plain">
                                <div class="header">
                                    <h4 class="title">Course Sections</h4>
                                    <p class="category">Here is a sections of celected course</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover">
                                        <thead>
                                        <th>Section Number</th>
                                        <th>Instructore Name</th>
                                        <th>days</th>
                                        <th>times</th>
                                        <th></th>
                                        </thead>
                                        <tbody id="section_table_body">

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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

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
        $('#btn-submit').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: 'get_courses.php',
                data: {
                    'semester': $('select[name="semester"] option:selected').val()
                },
                method: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    $('#course_table_body').html('');
                    for (var i = 0; i < data.length; i++) {
                        $('#course_table_body').append
                        ('<tr><td>' + data[i]["id"] + '</td>' +
                            '<td>' + data[i]["name"] + '</td>' +
                            '<td onclick="show(' + data[i]["id"] + ')"><a><i class="pe-7s-right-arrow"></i></a></td>' +
                            '</tr>');
                    }
                },
                error: function (data, textStatus) {
                    swal("Failed!", "Some Thing Is Error!(click)", "error");
                }
            });
        });
    });

    function show(course_id) {
        $.ajax({
            url: 'get_section.php',
            data: {
                'course_id': course_id
            },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('#section_table_body').html('');
                for (var i = 0; i < data.length; i++) {
                    $('#section_table_body').append('<tr id="' + data[i]['id'] + '">' +
                        '<td>' + data[i]['Section_no'] + '</td>' +
                        '<td>' + data[i]['name'] + '</td>' +
                        '<td>' + data[i]['days'] + '</td>' +
                        '<td>' + data[i]['start_time'] + '-' + data[i]['end_time'] + '</td></tr>');

                    var semester_course_id = data[i]['id'];
                    // alert(semester_course_id);
                    check(semester_course_id, course_id);

                }
            },
            error: function (data, textStatus) {
                swal("Failed!", "Some Thing Is Error!(show)", "error");
            }
        });
    }

    function check(semester_course_id, course_id) {

        $.ajax({
            url: 'check_section.php',
            data: {
                'section_id': semester_course_id
            },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                // alert(semester_course_id);
                if (data) {
                    $('#' + semester_course_id)
                        .append('<td onclick = "remove_course(' + semester_course_id + ',' + course_id + ',' + true + ')"><a><i class="pe-7s-trash"></i></a></td>');
                    // alert(semester_course_id);
                } else {
                    $('#' + semester_course_id)
                        .append('<td onclick = "add_course(' + semester_course_id + ',' + course_id + ')"><a><i class="pe-7s-plus"></i></a></td>');
                    // alert(semester_course_id);
                }
            },
            error: function (data, textStatus) {
                swal("Failed!", "Some Thing Is Error!(check1)", "error");
            }
        });
    }

    function remove_course(semester_course_id, course_id, showC) {
        // alert(semester_course_id);
        var student_id = document.getElementById("student_id").textContent;
        $.ajax({
            url: 'remove_course.php',
            data: {
                'semester_course_id': semester_course_id,
                'student_id': student_id
            },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                if (data === true) {
                    swal("Success!", "Remove Complete!", "success");
                    if (showC) {
                        show(course_id);
                    }
                } else {
                    swal("Failed!", "Remove Failed!", "error");
                }
            },
            error: function (data, textStatus) {
                swal("Failed!", "Some Thing Is Error! (remove)", "error");
            }
        });
    }

    function add_course(semester_course_id, course_id) {
        var student_id = document.getElementById("student_id").textContent;
        $.ajax({
            url: 'check_conflict.php',
            data: {
                'semester_course_id': semester_course_id,
                'student_id': student_id
            },
            method: 'POST',
            dataType: 'JSON',
            beforeSend: function(){
                // Show image container
                alert("beforeSend");
            },
            success: function (data) {
                // alert(data['status'] + "add");
                if (!data['status']) {
                    check_course_found(course_id, student_id, semester_course_id);
                    // swal("Success!", data['message'], "success");
                } else {
                    swal("Failed!", data['message'], "error");
                }
            },
            error: function (data, textStatus) {
                swal("Failed!", "Some Thing Is Error1! (add)", "error");
            },
            complete:function(data){
                // Hide image container
                alert("complete");
            }
        });
    }

    function check_course_found(course_id, student_id, semester_course_id) {
        $.ajax({
            url: 'check_course_found.php',
            data: {
                'course_id': course_id,
                'student_id': student_id
            },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                // alert(data['status'] + "check");
                if (data['status']) {
                    remove_course(data['message'], "", false);
                    conf_add(semester_course_id);
                    show(course_id);
                } else {
                    conf_add(semester_course_id);
                    show(course_id);
                }
            },
            error: function (data, textStatus) {
                swal("Failed!", "Some Thing Is Error!(check2)", "error");
            }
        });
    }

    function conf_add(semester_course_id) {
        var student_id = document.getElementById("student_id").textContent;
        $.ajax({
            url: 'add_course.php',
            data: {
                'semester_course_id': semester_course_id,
                'student_id': student_id
            },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                // alert(data + "conf_add");
                if (data === true) {
                    // check_course_found(semester_course_id);
                    swal("Success!", "Add Complete", "success");
                } else {
                    swal("Failed!", "Add Failed", "error");
                }
            },
            error: function (data, textStatus) {
                swal("Failed!", "Some Thing Is Error (conf_add)!", "error");
            }
        });
    }

</script>
