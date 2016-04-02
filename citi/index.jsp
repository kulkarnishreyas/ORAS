<HTML>
<HEAD><title> Welcome</title>
 <meta http-equiv="pragma" content="no-cache">
     <meta http-equiv="cache-control" content="no-cache">
     <meta http-equiv="expires" content="0">
     <meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
    <meta http-equiv="description" content="">
    <script language="javascript">
		   			function validate(objForm){

		   				if(objForm.userid.value.length==0){
		   					alert("Please enter  the User ID!");
		   					objForm.userid.focus();
		   					return false;
		   				}

		   				if(objForm.password.value.length==0){
		   					alert("Please enter Password!");
		   					objForm.password.focus();
		   					return false;
		   				}


		   				return true;
		   			}
		             </script>

</HEAD>
<body bgcolor="#123456" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" alink="#333333" vlink="#333333">
<!-- Java Script to Disable back button-->
<script language="JavaScript">
<!--
javascript:window.history.forward(1);
//-->
</script>
<br><br><br><br>
<table align ="center" width="750" bgcolor="#ffffff" border="1" BORDERCOLOR="#c6c6c6" cellpadding="0"

cellspacing="0">


     <tr><td height="40" bgcolor="#abcdef"><p align="center"><font face="Monotype Corsiva" size="6+" color="#000000"> Welcome</font></p></td></tr>

     <tr> <td>
     <table align ="center" width="750" bgcolor="#ffffff" border="0" BORDERCOLOR="#c6c6c6" cellpadding="0" cellspacing="0">
	<tr><td><img src="login.jpg"></td>
	<td>
	<font face="Verdana, Helvetica, sans-serif" size="2" color="#0000FF"><b> Please Enter Your User Name and Password</b></font></p>
	 <form method="post" action="login.jsp" onSubmit="return validate(this)">
	 <font face="Verdana, Helvetica, sans-serif" size="2" color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name:</FONT>
                 <input type=text name="userid" size="20"><br>
	 <font face="Verdana, Helvetica, sans-serif" size="2" color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password:</font>&nbsp;&nbsp;&nbsp;<input type=password name="password" size="20"><br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit value="OK" name="submit"><input type=reset value="CLEAR" name="reset">
	 	</form>
</td><tr>
</table>
</td></tr>

 <tr><td><img src="../images/bottom.jpg"></td></tr>
<tr height=29> <td background="../images/bg.gif"><p align="center"><font face="Monotype corsiva" size="4" color="#ffffff"><b></b></FONT></p></td></tr>
</table>
<script type="text/javascript">
		var  name = document.getElementById("userid");
		name.focus();
	</script>
		<script type="text/javascript">

		function btnContactAdmin(){
			win=open('contactAdmin.htm','ContactAdmin',
		'height=400,width=550,scrollbars=yes,status=yes',false);

		}



	</script>

</BODY>
</HTML>