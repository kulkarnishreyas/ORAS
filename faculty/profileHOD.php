<?php 
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password']))	{
	session_destroy(); header('Location:index.php');
}
else
	{
	$username=$_SESSION['username'];
	$password=$_SESSION['password'];
	$name=$_SESSION['name'];
	if($_SESSION['username']=='admin' or $_SESSION['username']=='coe' or $username[0].$username[1].$username[2]=="2SD")	{session_destroy(); header('Location:index.php');}	
	$date1=getDate();
		$date1='%'.$date1['year'].'%';
	if(mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement')) {
		//echo "welcome ".$username.'<br>'."$password".'<br>';
		$query = "select c.name, c.course_id, c.credits, h.dateundertaken from handles h, course c where teacher_ssn='$username' and dateundertaken like '$date1' and c.course_id=h.course_course_id";
		if($query_run=mysql_query($query)) {
			$query_num_rows=mysql_num_rows($query_run);
			$array=array($query_num_rows);
			$array1=array($query_num_rows);
			$array2=array($query_num_rows);
			$array3=array($query_num_rows);
			for($i=0;$i<$query_num_rows;$i++) {
				$array[$i]=mysql_result($query_run, $i, 'c.course_id');
				$array1[$i]=mysql_result($query_run, $i, 'c.name');
				$array2[$i]=mysql_result($query_run, $i, 'c.credits');
				$array3[$i]=mysql_result($query_run, $i, 'h.dateundertaken');
			}
		}
	} else {
		die();
	}	
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
    <script type="text/javascript" src="../jquery-1.11.3.js"></script>
    <script src="../bootstrap.min.js"></script>
    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap.min.css" rel="stylesheet">

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
              <li class="active" style="font-size: 20;"><a href="profileHOD.php">Profile<span class="sr-only">(current)</span></a></li>
              <li style="font-size: 20;"><a href="">Approve CAT/ CAM Marks</a></li>
              
            <li style="font-size: 20;"><a href="">Semester Schema Generation</a></li>
            <li style="font-size: 20;"><a href=""> Check Particular Student Performance View</a></li>
            <li style="font-size: 20;"><a href=""> Upload CAT/ CAM Marks</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <p style="font-size: 36"><?php echo "Welcome ".$_SESSION['name'];?></p>
         
          
          <hr>
          <p style="font-size: 32">Events</p>
          <hr>
          <div id="updateComplete"></div>
          <div class="table-responsive">
              <br><br>
              <p style="font-size: 20">Courses Handled</p>
              <table class="table" style="width: auto;">
		<tr bgcolor=#FFFFFF>
		<th>Sl.NO</th>
		<th>Course Code</th> 
		<th><div align="center">Course</div> </th>
		<th>Date Undertaken</th>
		<th>Credits</th>
		</tr>
	<?php
	for($i=0, $j=1;$i<$query_num_rows; $i++, $j++) {
		echo "
			<tr>
			<td>".$j."</td>
			<td>".$array[$i]."</td> 
			<td><div align=\"center\">".$array1[$i]."</div></td>
			<td>".$array3[$i]."</td>
			<td>".$array2[$i]."</td>
			</tr>";
	}
?>
</table>
          </div>
        </div>
      </div>
    </div>
    <button class="btn-default" >Nameless</button>
    <!-- Bootstrap core Java Script
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  
        
      
   
   
</body>
</html>