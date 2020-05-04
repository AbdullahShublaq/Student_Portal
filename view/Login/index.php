<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 09/05/2019
 * Time: 04:51 م
 */

$server = "http://localhost:63342";

include_once("../../controller/StudentController.php");
//error_reporting(E_ERROR | E_PARSE);

    if(isset($_COOKIE["id"])){
        header("Location: $server/Student_Portal/view/Dashboard/light-bootstrap-dashboard-master/index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../style/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body id="login">
<div class="container col-md-4 col-sm-2 col-md-4">

    <div><i class="fas fa-user-graduate"></i><br>Student Portal</div>

    <form action="" method="post">
        <div class="input-group flex-nowrap">
            <div class="input-group-prepend">
					<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i>
					</span>
            </div>
            <input type="text" name="std_id" class="form-control" placeholder="Student ID">
        </div>
        <div class="input-group flex-nowrap">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" name="std_psw" class="form-control" placeholder="Password">
        </div>
        <div class="input-group flex-nowrap">
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="remember_me" type="checkbox"
                       id="inlineCheckbox1" value="option1">
                <label class="form-check-label" for="inlineCheckbox1">remember me</label>
            </div>
        </div>
        <div id="err_msg">
        </div>
        <button id="sub_btn" type="submit" class="btn btn-lg btn-dark">
            <i class="fas fa-sign-in-alt"></i> Login
        </button>
</div>
</form>
</body>
</html>

<?php
//echo md5("abdsh");
$fault_alert = '<div class="col-12" style="text-align: center"><div class="alert alert-danger">id or password are wrong</div></div>';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['std_id']) && isset($_POST['std_psw'])) {

        $id = $_POST['std_id'];
        $password = $_POST['std_psw'];


        $result = StudentController::verify_password($id, $password);

//        print_r($result);

        if ($result->num_rows > 0) {

//            print_r($result);

            $row = $result->fetch_assoc();

            session_start();
            $_SESSION["id"] = $row["id"];
            $_SESSION["logged_in"] = true;

            if (isset($_POST['remember_me'])) {
                setcookie("id", $_SESSION["id"], time() + (86400 * 30), "/");
            }

            header("Location: $server/Student_Portal/view/Dashboard/light-bootstrap-dashboard-master/index.php");
        } else {
            echo $fault_alert;
        }
    } else {
        echo $fault_alert;
    }
}

?>

<!--<script type="text/javascript">-->
<!--    $(document).ready(function (e) {-->
<!--        $('#sub_btn').click(function (e) {-->
<!--            e.preventDefault();-->
<!--            $.ajax({-->
<!--                url: 'loginAction.php',-->
<!--                data: {-->
<!--                    'std_id': $('input[name="std_id"]').val(),-->
<!--                    'std_psw': $('input[name="std_psw"]').val()-->
<!--                },-->
<!--                method: "POST",-->
<!--                dataType: 'JSON',-->
<!--                success(data) {-->
<!--                    if (data) {-->
<!--                        $('input[name="std_id"]').val('');-->
<!--                        $('input[name="std_psw"]').val('');-->
<!--                        window.location.replace('profile.php');-->
<!--                    } else {-->
<!--                        $('#err_msg').html('');-->
<!--                        $('#err_msg')-->
<!--                            .append('<div class="col-12 alert_msg" style="text-align: center"><div class="alert alert-danger">id or password are wrong</div></div>');-->
<!--                    }-->
<!--                },-->
<!--                error(data, textStatus) {-->
<!--                    $('#err_msg').html('');-->
<!--                    $('#err_msg')-->
<!--                        .append('<div class="col-12 alert_msg" style="text-align: center"><div class="alert alert-danger">Some thing is error</div></div>');-->
<!---->
<!--                }-->
<!--            });-->
<!--        });-->
<!--    });-->
<!--</script>-->
