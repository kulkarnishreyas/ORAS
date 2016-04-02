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
	if(document.f1.layoutid.value=="")
	{
		alert("Enter value for Layoutid");
		document.f1.layoutid.focus();
		return false();
	}
	else if(document.f1.area.value=="")
	{
		alert("Enter value for area");
		document.f1.area.focus();
		return false();
	}
	else if(document.f1.map.value=="")
	{
		alert("Enter value for map");
		document.f1.map.focus();
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
	else if(document.f1.facilities.value=="")
	{
		alert("Enter value for facilities");
		document.f1.facilities.focus();
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
<p align="center"> <font face="verdana" size="2" color="#000080"><b><u>New Layout Information</u></b> </p>
<table bgcolor="#CCCCCC" align="center" border="1" width="800"><tr><td><FORM name="f1" action="ulayoutj.jsp" onSubmit="return validate()" >
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
  <td height="35" align="right" class="cols">layoutid&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="layoutid" size="35" value=""><img src="../images/ast.gif"> </td>
  </tr> 
   <tr>
  <td height="35" align="right" class="cols">area&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="area" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
   <tr>
  <td height="35" align="right" class="cols">map&nbsp;&nbsp;</td>
  <td height="35" > <input type="file" name="map" size="35"><img src="../images/ast.gif"> </td>
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
  <td height="35" align="right" class="cols">facilities&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="facilities" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
  </table>
  <br><hr><br><img src="../images/ast.gif"> Mandatory Fields<br> <p align="center">  <input type="submit" name="submit" value="submit"> &nbsp;&nbsp;&nbsp;  <input type="reset" name="reset"></p>  <%
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
