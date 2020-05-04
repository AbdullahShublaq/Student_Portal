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

    $set_gpa = StudentController::set_gpa($id);
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
    <html lang='en'>
    <head>
        <meta charset='utf-8'/>
        <link rel='icon' type='image/png' href='assets/img/favicon.ico'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>

        <title>Dashboard</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
        <meta name='viewport' content='width=device-width'/>


        <!-- Bootstrap core CSS     -->
        <link href='assets/css/bootstrap.min.css' rel='stylesheet'/>

        <!-- Animation library for notifications   -->
        <link href='assets/css/animate.min.css' rel='stylesheet'/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href='assets/css/light-bootstrap-dashboard.css?v=1.4.0' rel='stylesheet'/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href='assets/css/demo.css' rel='stylesheet'/>

        <!--        sweet alert-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!--     Fonts and icons     -->
        <link href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' rel='stylesheet'>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href='assets/css/pe-icon-7-stroke.css' rel='stylesheet'/>

        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>

    </head>
    <body>

    <div class='wrapper'>
        <div class='sidebar' data-color='black' data-image='assets/img/sidebar-4.jpg'>

            <!--   you can change the color of the sidebar using: data-color='blue | azure | green | orange | red | purple' -->


            <div class='sidebar-wrapper'>
                <div class='logo'>
                    <a href='' class='simple-text'>
                        <img src='assets/img/default-avatar.png' alt='''><br><br>
                        <span><?php echo $student->getName() ?></span> <br>
                        <span>&apos; <?php echo $student->getId() ?> &apos;</span>
                    </a>
                </div>

                <ul class='nav'>
                    <li class='active'>
                        <a href='index.php'>
                            <i class='pe-7s-user'></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href='registration.php'>
                            <i class='pe-7s-note2'></i>
                            <p>Course Registration</p>
                        </a>
                    </li>
                    <li>
                        <a href='table.php'>
                            <i class='pe-7s-airplay'></i>
                            <p>Semester Table</p>
                        </a>
                    </li>
                    <li>
                        <a href='grade.php'>
                            <i class='pe-7s-news-paper'></i>
                            <p>Grades</p>
                        </a>
                    </li>
                    <li class='active-pro'>
                        <a href='logout.php'>
                            <i class='pe-7s-rocket'></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class='main-panel'>
            <nav class='navbar navbar-default navbar-fixed'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <button type='button' class='navbar-toggle' data-toggle='collapse' data-target=''
                                #navigation-example-2
                        '>
                        <span class='sr-only'>Toggle navigation</span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        </button>
                        <a class='navbar-brand' href='' #'>User Profile</a>
                    </div>
                </div>
            </nav>


            <div class='content'>
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-md-8'>
                            <div class='card'>
                                <div class='header'>
                                    <h4 class='title'>Edit Profile</h4>
                                </div>
                                <div class='content'>
                                    <form>
                                        <div class='row'>
                                            <div class='col-md-4'>
                                                <div class='form-group'>
                                                    <label>Student ID</label>
                                                    <input name="student_id" type='text' class='form-control' disabled
                                                           placeholder='Company' value='<?php echo $student->getId() ?>'>
                                                </div>
                                            </div>

                                            <div class='col-md-8'>
                                                <div class='form-group'>
                                                    <label>Full Name</label>
                                                    <input type='text' class='form-control' disabled
                                                           placeholder='Company'
                                                           value='<?php echo $student->getName() ?>'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label>Email address</label>
                                                    <input name='student_email' type='email' class='form-control'
                                                           placeholder='Email'
                                                           value='<?php echo $student->getEmail() ?>'>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label>Phone</label>
                                                    <input name='student_phone' type='text' class='form-control'
                                                           placeholder='phone'
                                                           value='<?php echo $student->getPhone() ?>'>
                                                </div>
                                            </div>
                                        </div>
                                        <button id='submit-btn' type='button' class='btn btn-info btn-fill pull-right'>
                                            Update Profile
                                        </button>
                                        <div class='clearfix'></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class='card card-user'>
                                <div class='image'>
                                    <img src='assets/img/full-screen-image-3.jpg'
                                         alt='' ...'/>
                                </div>
                                <div class='content'>
                                    <div class='author'>
                                        <a href='' #'>
                                        <img class='avatar border-gray' src='assets/img/default-avatar.png' alt='''>

                                        <h4 class='title'><?php echo $student->getName() ?><br/>
                                            <small><?php echo $student->getId() ?></small>
                                        </h4>
                                        <br>
                                        <h4 class='title'>GPA :
                                            <small><?php echo $student->getGpa()?></small>
                                        </h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <footer class='footer'>
                <div class='container-fluid'>
                    <nav class='pull-left'>
                        <p class='copyright pull-right'>
                            &copy; Abdullah Shublaq , made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>

        </div>
    </div>


    </body>

    <!--   Core JS Files   -->
    <script src='assets/js/jquery.3.2.1.min.js' type='text/javascript'></script>
    <script src='assets/js/bootstrap.min.js' type='text/javascript'></script>

    <!--  Charts Plugin -->
    <script src='assets/js/chartist.min.js'></script>

    <!--  Notifications Plugin    -->
    <script src='assets/js/bootstrap-notify.js'></script>

    <!--  Google Maps Plugin    -->
    <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src='assets/js/light-bootstrap-dashboard.js?v=1.4.0'></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src='assets/js/demo.js'></script>

    </html>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#submit-btn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'user_action.php',
                    data: {
                        'student_phone': $('input[name="student_phone"]').val(),
                        'student_email': $('input[name="student_email"]').val(),
                        'student_id': $('input[name="student_id"]').val()
                    },
                    method: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        if (data['status']) {
                            swal("Success!", "Update Complete!", "success");
                        } else {
                            swal("Failed!", "Update Failed!", "error");
                        }
                    },
                    error: function (data, textStatus) {
                        $swal("Failed!", "Some Thing Is Wrong!", "error");
                    }
                });
            });
        });
    </script>

    <?php
} else {
    header("Location: $server/Student_Portal/view/Login/");
}
?>


