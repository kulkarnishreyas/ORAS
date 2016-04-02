<?php
session_start();
(mysql_connect('localhost', 'root', '') and mysql_select_db('resultmanagement')) or die('Error connecting to database');
$wrongUsernameOrPassword = false;
if (!isset($_POST['submit']))
    ;
else {
    $username = $_POST['loginusername'];
    $password = $_POST['loginpassword'];
    $type = $_POST['type'];
    if (!empty($username) and !empty($password)) {
        if ($type == 'Student') {
            $sql = "SELECT `usn`, `name`, `password` FROM `student` WHERE `usn`='" . mysql_real_escape_string($username) . "' and `password`='" . mysql_real_escape_string($password) . "'";
            $str = 'usn';
        } else {
            $sql = "SELECT `ssn`, `name`, `password` FROM `teacher` WHERE `ssn`='" . mysql_real_escape_string($username) . "' and `password`='" . mysql_real_escape_string($password) . "'";
            $str = 'ssn';
        }

        if ($query = mysql_query($sql)) {

            if (mysql_num_rows($query) == 1) {
                $_SESSION['username'] = mysql_result($query, 0, $str);
                $_SESSION['password'] = mysql_result($query, 0, 'password');
                $_SESSION['name'] = mysql_result($query, 0, 'name');
                $_SESSION['type'] = $_POST['type'];

                if ($type == 'Staff') {
                    $sql = "SELECT `hodssn` from `department` WHERE `hodssn`='$username'";
                    if (mysql_num_rows(($query = mysql_query($sql))) == 1) {

                        header('Location:' . 'faculty/profileHOD.php');
                    } else {
                        header('Location:' . 'faculty/profileTeacher.php');
                    }
                } else if ($type == 'Student') {
                    header('Location:' . 'student/profileStudent.php');
                } else {
                    if ($username == 'coe') {
                        header('Location:' . 'coe/profileCOE.php');
                    } else if ($username == 'admin') {
                        header('Location:' . 'admin/profileAdmin.php');
                        ;
                    }
                }
            } else {

                $wrongUsernameOrPassword = true;
                //echo "<div align=\"center\" class=\"alert alert-danger fade in\">Wrong Username or password</div>";
            }
        }
    }
}
?>
<html>
    <head>
        <title>Online Result Analysis System</title>

    </head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <script type="text/javascript" src="jquery-1.11.3.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Load jQuery and the validate plugin -->

    <script src="jquery.validate.min.js"></script>
    <script>
        $(function() {
            $("#loginform").validate({

                // Specify the validation rules
                rules: {
                    loginusername: "required",
                    loginpassword: {
                        required:true,
                        minlength:8
                    },
                    type: "required",
                },
                // Specify the validation error messages
                messages: {
                    loginusername: "<div style=\"color: red; font-size: 12\">Please enter your Username</div>",
                    loginpassword: {
                        minlength: "<div style=\"color: red; font-size: 12\">Password must be 8 letters long.</div>",
                        required: "<div style=\"color: red; font-size: 12\">This field is required.</div>",
                    },
                    type: "<div style=\"color: red; font-size: 12\">This field is compulsory</div>",
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
                 

        });
    </script>
    <body class="container" style="background-color: #010b27">
        <div class="col-md-12">
            <div class="col-md-4"></div>
            <div align="center" class="well col-md-4" style="opacity: 0.8; background-color: #e7e7e7; border-radius:5%" id="panel" onmouseover="opacity_1();" onmouseout="opacity_0();">

                <h1 style="color: #424bd6;font-weight: 400;font-size: 32">
                    <br>Welcome to <abbr title="Online Result Analysis System" style="cursor: default">ORAS</abbr>
                    <hr>
                </h1>

                <h4>
                    <p><br><div class="glyphicon glyphicon-lock" style="color: green"></div> Login to your account</p>
                </h4>

                <form role="" action="" method="POST" id="loginform">
                    
                    <input class="form-control" type="text" placeholder="Username" name="loginusername" id="loginusername" style="width: 200px;"></br>
                    
                    <input class="form-control" type="Password" placeholder="Password" name="loginpassword" id="loginpassword" style="width: 200px;"></br>
                    
                    <select class="form-control" name="type" id="type" style="width: 200px;">
                        <option value=""selected>Select</option>
                        <option value="Staff">Staff</option>
                        <option value="Student">Student</option>
                        <option value="Other">Other</option>
                    </select></br>
                    <input type="submit" class="btn btn-primary" name="submit" value="Login" style="width: 200px;"></input>
                </form>
                <?php
                if ($wrongUsernameOrPassword)
                    echo "<div style=\"width: 250px;\" class=\"alert alert-danger fade in\">Wrong username or password.<br><br><p style=\"font-size:10px\">Forgotten Password? Contact Administrator for help</p></div>";
                ?>
                <div class="panel-footer" style="font-size: 10">
                    SDM College of Engineering & Tech, Dhawalgiri, Dharwad<br> 5800-07
                </div>

            </div>
            <div class="col-md-4"></div>
        </div>
    </body>
    <script>
        function opacity_1()  {
            document.getElementById("panel").style.opacity="1";
        }
        function opacity_0()    {
            document.getElementById("panel").style.opacity="0.8";
        }
    </script>
</html>