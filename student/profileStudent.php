<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password']))	{
	session_destroy(); header('Location:../index.php');
}
mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die("Error connecting to database");
$username=$_SESSION['username'];
$sem=0;
$sql= "select max(sem) from perceives where student_usn='$username'";
if($query_run=mysql_query($sql))
{
        $sem=mysql_result($query_run, 0, 'max(sem)');
}else	{die('error');}
$getimageSQL="select imgpath from student where usn='$username'";
if(!$result=  mysql_query($getimageSQL))    {
    die();
}
$imgRow=  mysql_fetch_assoc($result);
$imgpath="../".$imgRow['imgpath'];
?>


<div style="text-align: centre; color: #0; padding-top:0px; font-size: 25px;padding-left:0px">
<?php
		$username=$_SESSION['username'];
		if($username[0].$username[1].$username[2]!="2SD")	{session_destroy(); header('Location:index.php');}	
		//echo 'Welcome '.$_SESSION['username'];
?>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">
    <script type="text/javascript" src="../jquery-1.11.3.js"></script>
    <script src="../bootstrap.min.js"></script>
    <title></title>

    <!-- Bootstrap core CSS -->
    <!--<link href="bootstrap.min.css" rel="stylesheet">-->
    <link href="../bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../dashboard.css" rel="stylesheet">

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
              <li><a style="font-size: 20px;cursor: default;"><?php echo "Hi ".$_SESSION['name'];?></a></li>
              <li><a href="profileStudent.php" style="font-size: 20;"><div class="glyphicon glyphicon-home"></div>Dashboard</a></li>
              <li><a href="settingsStudent.php" style="font-size: 20;"><div class="glyphicon glyphicon-cog"></div>Settings</a></li>
               <li><a href="logout.php" style="font-size: 20;">Logout</a></li>
            <li><a href="#" style="font-size: 20;">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>
      
    
        <div style="background-color: #333333" class="col-sm-3 col-md-2 sidebar" style="top:0;">
          <ul class="nav nav-sidebar">
              <li>
                 <img id="profile" class="img-rounded" src="<?php if($imgpath=='')  {echo "../images/default.png";} else   {echo $imgpath;}?>" style="border-radius: 200px;width:100%;height: auto; " onmouseover="display();" onmouseout="dontdisplay();" onclick="location.href='settingsStudent.php'">
              </li>
              <li class="active" style="font-size: 20;"><a href="profileStudent.php">Profile<span class="sr-only">(current)</span></a></li>
              <li style="font-size: 20;"><a href="" data-toggle="modal" data-target="#myModal">Generate Provisional Marks Sheet</a></li>

            <li style="font-size: 20;"><a href="">Student Status Analysis</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><br>Events</h1><br>
         
          

          <h2 class="sub-header">This Semester's Courses</h2>
          <div id="updateComplete">
              <?php
//include "Screen.php";
              //session_start();
             
                  $semSql="select max(sem) as `semester` from `perceives` where `student_usn`='$username'";
                  $semresult=  mysql_fetch_assoc(mysql_query($semSql));
                  $sem = $semresult['semester'];
                  if($sem!=8)   {
                      $sem++;
                  }
                  $ssn = $_SESSION['username'];

                  $year = getdate();
                  $thisyear = $year['year'];
                  if ($ssn[0] . $ssn[1] . $ssn[2] == "2SD") {
                      $sql = "select `department_deptid` from `student` where `usn`='$ssn'";
                  } else {
                      $sql = "select `department_deptid` from `teacher` where `ssn`='$ssn'";
                  }
                  if ($query = mysql_query($sql))
                      ;else
                      echo 'error1';
                  $deptid = mysql_result($query, 0, 'department_deptid');
                  //echo $deptid."deptid";
                  $sql = "SELECT distinct s.`deptid`, s.`course`, c.`name`, s.`year`, c.`credits` FROM `semplan` s, `course` c WHERE s.`sem`='$sem' and s.`deptid`='$deptid' and `year`='$thisyear' and s.`course`=c.`course_id`";
                  if ($query_run = mysql_query($sql)) {
                      $query_num_rows = mysql_num_rows($query_run);
                      $array = array($query_num_rows);
                      $array1 = array($query_num_rows);
                      $array2 = array($query_num_rows);
                      $array3 = array($query_num_rows);
                      $array4 = array($query_num_rows);
                      //$_SESSION['norows']=$query_num_rows;
                      for ($i = 0; $i < $query_num_rows; $i++) {
                          $array[$i] = mysql_result($query_run, $i, 'deptid');
                          $array1[$i] = mysql_result($query_run, $i, 'course');
                          $array2[$i] = mysql_result($query_run, $i, 'name');
                          $array3[$i] = mysql_result($query_run, $i, 'year');
                          $array4[$i] = mysql_result($query_run, $i, 'credits');
                      }
                  }else
                      die('error');
              
              ?>
                  <table class="table">
                      <tr style="background-color: lightgrey">
                          <th>Department Id</th>
                          <th>Course Code</th>
                          <th>Course Name</th>
                          <th>Year</th>
                          <th>Credits</th>
                      </tr>
                      <?php
                      for ($i = 0, $j = 1; $i < $query_num_rows; $i++, $j++) {
                          echo '
			<tr>
			<td>' . $array[$i] . '</td>
			<td>' . $array1[$i] . '</td>
			<td>' . $array2[$i] . '</td>
			<td>' . $array3[$i] . '</td>
			<td>' . $array4[$i] . '</td>
			</tr>';
                      }
                      //print_r($_SESSION);
                      ?>
                  </table>
          </div>
          <div class="table-responsive">
             <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header" style="background-color: #658efb">
                      <button type="button" class="close" data-dismiss="modal" style="color: white">&times;</button>
                      <h4 class="modal-title" align="center" style="color: white" >Generate Provisional Marks Card</h4>
                  </div>
                  <div class="modal-body">
                      <p style="font-size: 18px;">&nbsp;&nbsp;Please Specify Semester:</p>
                      <form target="blank" action="pdfGenerated.php" method="POST" id="select_sem">
                          <label style="font-size: 14">Semester</label>
                          <select id="semester" name="semester" class="form-control" style="width: 200px;">
                              <?php
                                for($i=$sem;$i>2;$i--)	{
                                    echo "<option value='$i'>".$i."</option>";
                                }
                              ?>
                          </select>
                          <br>
                          
                          <input type="submit" <?php if($sem<=1) echo "disabled";?> class="btn-success form-control" name="select" value="Generate Provisional Mark" style="width: 250px; cursor: default">
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>
                  </div>
              </div>   
          </div>
        </div>
          </div>
        </div>
      
<script>
    function display()  {
        
        document.getElementById("profile").style.opacity="0.5";
    }
        function dontdisplay()  {
        
        document.getElementById("profile").style.opacity="1";
    }
</script>
</body></html>
