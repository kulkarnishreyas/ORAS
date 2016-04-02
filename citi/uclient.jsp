<%@ page contentType="text/html; charset=iso-8859-1" language="java" import="java.sql.*" errorPage="" %>
<%@include file="header.jsp"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<script language="javascript">
function validate()
{
	else if(document.f1.clientid.value=="")
	{
		alert("Enter value for clientid");
		document.f1.clientid.focus();
		return false();
	}
	if(document.f1.firstname.value=="")
	{
		alert("Enter value for firstname");
		document.f1.firstname.focus();
		return false();
	}
	else if(document.f1.lastname.value=="")
	{
		alert("Enter value for lastname");
		document.f1.lastname.focus();
		return false();
	}
	else if(document.f1.address1.value=="")
	{
		alert("Enter value for address1");
		document.f1.address1.focus();
		return false();
	}
	else if(document.f1.address2.value=="")
	{
		alert("Enter value for address2");
		document.f1.address2.focus();
		return false();
	}
	else if(document.f1.city.value=="")
	{
		alert("Enter value for city");
		document.f1.city.focus();
		return false();
	}
	else if(document.f1.state.value=="")
	{
		alert("Enter value for state");
		document.f1.state.focus();
		return false();
	}
	else if(document.f1.pincode.value=="")
	{
		alert("Enter value for pincode");
		document.f1.pincode.focus();
		return false();
	}
	else if(document.f1.contactno.value=="")
	{
		alert("Enter value for contactno");
		document.f1.contactno.focus();
		return false();
	}
	else
	{
		return true;
	}
}
</script>

</head>

<body>
<p align="center"> <font face="verdana" size="2" color="#000080"><b><u>New Client Information</u></b> </p>
<table bgcolor="#CCCCCC" align="center" border="1" width="800"><tr><td><FORM name="f1" action="uclientj.jsp" onSubmit="return validate()" >
<%
 try
{
  Connection c;
  Statement s;
  ResultSet rs;
  Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
  c=DriverManager.getConnection("jdbc:odbc:info");
  s=c.createStatement();
%>
<table>
  <tr>
  <td height="35" align="right" class="cols">clientid&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="clientid" size="35" value=""><img src="../images/ast.gif"> </td>
  </tr> 
   <tr>
  <td height="35" align="right" class="cols">firstname&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="firstname" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
  <tr>
  <td height="35" align="right" class="cols">lastname&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="lastname" size="35"><img src="../images/ast.gif"> </td>
  </tr> 

   <tr>
  <td height="35" align="right" class="cols">address1&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="address1" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
   <tr>
  <td height="35" align="right" class="cols">address2&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="address2" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
  <tr>
  <td height="35" align="right" class="cols">city&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="city" size="35"><img src="../images/ast.gif"> </td>
  </tr> 

   <tr>
  <td height="35" align="right" class="cols">state&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="state" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
   <tr>
  <td height="35" align="right" class="cols">pincode&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="pincode" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
  <tr>
  <td height="35" align="right" class="cols">contactno&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="contactno" size="35"><img src="../images/ast.gif"> </td>
  </tr> 

  </table>
  <br><hr><br><img src="../images/ast.gif"> Mandatory Fields<br> <p align="center">  <input type="submit" name="submit" value="submit" >  &nbsp;&nbsp;&nbsp;  <input type="reset" name="reset"></p>  <%
  s.close();

 }
 catch(Exception e)
 {
  out.write(""+e);
 }
 %>
</form></table>

</body>
</html>
