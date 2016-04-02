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
	if(document.f1.clientid.value=="")
	{
		alert("Enter value for clientid");
		document.f1.clientid.focus();
		return false();
	}
	else if(document.f1.plotid.value=="")
	{
		alert("Enter value for plotid");
		document.f1.plotid.focus();
		return false();
	}
	else if(document.f1.layoutid.value=="")
	{
		alert("Enter value for layoutid");
		document.f1.layoutid.focus();
		return false();
	}
	else if(document.f1.amtpaid.value=="")
	{
		alert("Enter value for amtpaid");
		document.f1.amtpaid.focus();
		return false();
	}
	else if(document.f1.paiddt.value=="")
	{
		alert("Enter value for paiddt");
		document.f1.paiddt.focus();
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
<p align="center"> <font face="verdana" size="2" color="#000080"><b><u>New Transaction Information</u></b> </p>
<table bgcolor="#CCCCCC" align="center" border="1" width="800"><tr><td><FORM name="f1" action="utransactionj.jsp" onSubmit="return validate()" >
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
  <td height="35" align="right" class="cols">plotid&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="plotid" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
   <tr>
  <td height="35" align="right" class="cols">layoutid&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="layoutid" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
   <tr>
  <td height="35" align="right" class="cols">amtpaid&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="amtpaid" size="35"><img src="../images/ast.gif"> </td>
  </tr> 
   <tr>
  <td height="35" align="right" class="cols">paiddt&nbsp;&nbsp;</td>
  <td height="35" > <input type="text" name="paiddt" size="35"><img src="../images/ast.gif"> </td>
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
