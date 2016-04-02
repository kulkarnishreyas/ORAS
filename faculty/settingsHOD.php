<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password']))	{
	session_destroy(); header('Location:index.php');
}
$username=$_SESSION['username'];
$name="";
$date="";
$address="";
$email="";
$phno="";
$currentpassword="";
$newpassword="";
$name=$_SESSION['name'];
$fetchBdateSql="select bdate, address, email, phno from teacher where ssn='$username'";
mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die("Error fetching data");
if($dateResult= mysql_query($fetchBdateSql))    {
    $dateRow=  mysql_fetch_assoc($dateResult);
    $date=$dateRow['bdate'];
    $address=trim($dateRow['address']);
    $email=$dateRow['email'];
    $phno=$dateRow['phno'];
$getimageSQL="select imgpath from student where usn='$username'";
if(!$result=  mysql_query($getimageSQL))    {
    die();
}
$imgRow=  mysql_fetch_assoc($result);
$imgpath="../".$imgRow['imgpath'];

    
}
 else {
     die("Error");
}
if(isset($_POST['password_change']))   {
    if(isset($_POST['currentpassword']))    {
        $currentpassword=$_POST['currentpassword'];
    }
    if(isset($_POST['newpassword']))    {
        $newpassword=$_POST['newpassword'];
    }
    if($currentpassword!=$_SESSION['password']) {
        echo "<div class=\"alert alert-danger\" align=\"center\">You seem to have typed in a wrong password. Lets try again...</div>";
    }else   {
        $passwordSql="UPDATE `teacher` SET `password`='$newpassword' where `ssn`='$username'";
        if(mysql_query($passwordSql))   {
            echo "<div class=\"alert alert-success\" align=\"center\">Password changed Successfully</div>";
            $_SESSION['password']=$newpassword;
        }else   {
            echo "<div class=\"alert alert-danger\" align=\"center\">Error while updating password</div>";
        }
    }
}
if(isset($_POST['edit_details'])){
    $file=$_FILES['uploadPic']['tmp_name'];
    
    copy($file, "../images/".$username.".jpg");
    $inputFileName = "images/".$username.".jpg";
    if(isset($_POST['name']))   {
        $name=$_POST['name'];
    }
    if(isset($_POST['bdate']))   {
        $date=$_POST['bdate'];
    }
    if(isset($_POST['phno']))   {
        $phno=$_POST['phno'];
    }
    if(isset($_POST['email']))   {
        $email=$_POST['email'];
    }
    if(isset($_POST['address']))   {
        $address=trim($_POST['address']);
    }
    $updateDetailsSql="UPDATE `teacher` SET `name`='$name', `bdate`='$date', `phno`='$phno', imgpath='$inputFileName', `email`='$email', `address`='$address' where `usn`='$username'";
    if(mysql_query($updateDetailsSql)) {
        $_SESSION['name']=$name;
        echo "<div class=\"alert alert-success\" align=\"center\">Details updated Successfully</div>";
    }
 else {
        echo "<div class=\"alert alert-danger\" align=\"center\">Details couldn't be updated successfully</div>";
    }
}




?>


<div style="text-align: centre; color: #0; padding-top:0px; font-size: 25px;padding-left:0px">
<?
		$username=$_SESSION['username'];
                if($_SESSION['type']!='Staff')  {
                    session_destroy();
                    header('Location: index.php');
                }
?>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">
    <script type="text/javascript" src="jquery-1.11.3.js"></script>
    <script src="bootstrap.min.js"></script>
    <title></title>

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
  </head>

  <body>
      
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Online Result Analysis System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <li><a href="profileHOD.php" style="font-size: 20;"><div class="glyphicon glyphicon-home"></div>Dashboard</a></li>
              <li><a href="settingsHOD.php" style="font-size: 20;"><div class="glyphicon glyphicon-cog"></div>Settings</a></li>
            <li><a href="logout.php" style="font-size: 20;">Logout</a></li>
            <li><a href="#" style="font-size: 20;">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>
      
    <div class="container-fluid">
      <div class="row">
        <div style="background-color: #e5e5e5" class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar"><li></li></ul>
          <ul class="nav nav-sidebar">
              <li class="active" style="font-size: 20;"><a href="profileStudent.php">Profile<span class="sr-only">(current)</span></a></li>
              <li style="font-size: 20;"><a href="">Generate Provisional Marks Sheet</a></li>

            <li style="font-size: 20;"><a href="">Student Status Analysis</a></li>
            <li style="font-size: 20;"><a href="">View Semester Plan</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Settings</h1>
          <div id="body">
              Edit Details:
              <div align="right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Account Settings</button></div>
          </div>
          <form action="" method="POST" id="settings_validate">
              <input type="file" class="btn btn-info" name="uploadPic" id="uploadPic" style="display:none" >
              <img id="profile" class="img-rounded" src="<?php if($imgpath=='')  {echo "../images/default.png";} else   {echo $imgpath;}?>" style="width:15%;height: auto; " onmouseover="display();" onmouseout="dontdisplay();" onclick="showProfilePic();"><br>
              <label style="font-size: 14px;">*Name: </label>
              <input class="form-control" type="text" name="name" id="name" style="width: 200px;" value='<?php
                if(isset($_SESSION['name']))    {
                    echo $_SESSION['name'];
                }
              ?>'>
              <label style="font-size: 14px;">Date of Birth:</label>
              <input class="form-control" type="date" name="bdate" id="bdate" style="width: 200px;" value=<?php
                if(isset($date))    {
                    echo $date;
                }  else {
                    echo date('d-m-Y');
                }
              ?>>
              <label style="font-size: 14px;">Address:</label>
              <textarea class="form-control" name="address" id="address" style="width: 300px;">
              <?php
                if(isset($address)) {
                    echo trim($address);
                }
              ?>
              </textarea>
              <label style="font-size: 14px;">Phone:</label>
              <input type="text" class="form-control" name="phno" id="phno" style="width: 200px;" value=<?php
                if(isset($phno)) {
                    echo $phno;
                }
              ?>><br>
              <label style="font-size: 14px;">Email-id:</label>
              <input class="form-control" type="type" name="email" id="email" style="width: 200px;" value=<?php
                if(isset($email)) {
                    echo $email;
                }
              ?>>
              <br>
              <input type="submit" class="btn-success form-control"name="edit_details" id="edit_details" value="Update Details" style="width: 200px;">
          </form>
          
          
          <h2 class="sub-header"></h2>
          <div id="updateComplete"></div>
          <div class="table-responsive">
              <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header" style="background-color: green">
                      <button type="button" class="close" data-dismiss="modal" style="color: white">&times;</button>
                      <h4 class="modal-title" align="center" style="color: white" >Account Settings</h4>
                  </div>
                  <div class="modal-body">
                      <p style="font-size: 18px;"><div class="glyphicon glyphicon-pencil"></div>&nbsp;&nbsp;Change Password:</p>
                      <form action="" method="POST" id="passwordmodal">
                          <label style="font-size: 14">Current Password</label>
                          <input type="password" name="currentpassword" id="currentpassword" class="form-control" style="width: 200px">
                          <br>
                          <label style="font-size: 14">New Password</label>
                          <input type="password" name="newpassword" id="newpassword" class="form-control" style="width: 200px">
                          <br>
                          <label style="font-size: 14">Confirm Password</label>
                          <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" style="width: 200px"><br>
                          <br>
                          <input type="submit" class="btn-success form-control" name="password_change" style="width: 180px;">
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </div>   
          </div>
        </div>
      </div>
    </div>
    
    <!-- Bootstrap core Java Script
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  
        
      
   
   
</body>
<script src="jquery.validate.min.js"></script>
  <script>
    $(function() {
                    $("#passwordmodal").validate({
                        
                        // Specify the validation rules
                        rules: {
                            currentpassword: {
                                required: true,
                                minlength: 8
                            },
                            newpassword: {
                                required: true,
                                minlength:8, 
                                notEqual: "#currentpassword"
                            },
                            confirmpassword: {
                                required: true,
                                minlength:8,
                                equalTo: "#newpassword"
                            }
                            
                        },
                        // Specify the validation error messages
                        messages: {
                            currentpassword: {
                                required: "<div style=\"color: red; font-size: 12\">This field is mandatory.</div>",
                                minlength: "<div style=\"color: red; font-size: 12\">Password must be at least 8 characters long</div>"                                
                            },
                            newpassword: {
                                required: "<div style=\"color: red; font-size: 12\">This field is mandatory.</div>",
                                minlength: "<div style=\"color: red; font-size: 12\">Password must be at least 8 characters long</div>",                                
                                notEqual: "<div style=\"color: red; font-size: 12\">Password must differ from current one.</div>"
                            },
                            confirmpassword: {
                                required: "<div style=\"color: red; font-size: 12\">This field is mandatory.</div>",
                                minlength: "<div style=\"color: red; font-size: 12\">Password must be at least 8 characters long</div>",                                
                                equalTo: "<div style=\"color: red; font-size: 12\">Passwords dont match!</div>"
                            }
                        },

                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                    
                    $("#settings_validate").validate({

                        // Specify the validation rules
                        rules: {
                            name: "required",
                            phno: {
                                minlength:10,
                                number: true
                            },
                            email: "email"
                        },
                        // Specify the validation error messages
                        messages: {
                            name: "<div style=\"color: red; font-size: 12\">This field is mandatory!</div>",
                            phno: {
                                minlength: "<div style=\"color: red; font-size: 12\">Please enter a 10-digit phone number.</div>",
                                number: "<div style=\"color: red; font-size: 12\">Please enter a valid phone number</div>",
                            },
                            email: "<div style=\"color: red; font-size: 12\">Please type in a valid email address</div><br>",
                        },

                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                 

                });
    </script>
</html>
