<%@ page contentType="text/html; charset=iso-8859-1" language="java" import="java.sql.*" errorPage="" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<p align="center" class="tophead"> View layout Information [Delete] Information </p> <table align ="center"  bgcolor="#ffffff" border="1" BORDERCOLOR="#E6E6FA" cellpadding="0" cellspacing="0"><%
 try
 {
  Connection c;
  Statement s;
  ResultSet rs;
  Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
  c=DriverManager.getConnection("jdbc:odbc:info");
  s=c.createStatement();
if(request.getParameter("action")==null || request.getParameter("action").equals(""))
{
%>
<form name="f1" action="ddlayout.jsp">
<input type="hidden" name="action" value="action">
<%
rs=s.executeQuery("select distinct(layoutid) from layout");
%>
<font face="verdana" size="2" color="#000080"><b><i>Select the layoutid &nbsp;&nbsp; </i></b></font> <select name="layoutid" size="1" onChange="form.submit()">
<option value="-2" >Select </option>
<option value="-1" >All </option>
<%
while(rs.next())
{%>
<option><%=rs.getString("layoutid")%></option>
<%
}
%>
</select>
</form>
<%
}
else
{
String layoutid=request.getParameter("layoutid");
rs=s.executeQuery("select distinct(layoutid) from layout");
%>
<form name="f1" action="ddlayout.jsp">
<input type="hidden" name="action" value="action">
<font face="verdana" size="2" color="#000080"> <b><i> Select the layoutid </b></i></font> <select name="layoutid" size="1" onChange="form.submit()">
<%if(layoutid.equals("-2")) { %> <option value="-2" selected>Select</option> <% } else  { %> <option value="-2" >Select </option> <% }
if(layoutid.equals("-1")) { %> <option value="-1" selected>All</option> <% } else  { %> <option value="-1" >All </option> <% }
while(rs.next())
{
String mlayoutid=rs.getString("layoutid");
if(mlayoutid.equals(layoutid))
{
%>
  <option selected><%=mlayoutid%></option>
<%
}
else
{
%> <option><%=mlayoutid%></option>
 <%
}
}
%>
 <tr><td> <table align ="center"  bgcolor="#ffffff" border="1" BORDERCOLOR="#E6E6FA" cellpadding="0" cellspacing="0">
<%
if(layoutid.equals("-1"))
rs=s.executeQuery("select * from layout");
else
rs=s.executeQuery("select * from layout where layoutid='"+layoutid+"'");
%>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>layoutid</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>area</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>map</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>city</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="150"> <font face="Verdana" size="2" color="#FFFFFF"><b>state</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>facilities</b></font></td>
<TD align="center" height="25" bgcolor="#4169E1"><font face="Verdana" size="2" color="#FFFFFF">&nbsp;<b>Delete</b>&nbsp;</font></td>
</tr>
<%
while(rs.next())
{
%>
<tr>
<%
 String ff=rs.getString("layoutid");
%>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=ff%></td><td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("area")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("map")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("city")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("state")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("facilities")%></td>

<td class="colss"><img src="image.jsp?imgid=<%=ff%>" width="200" height="200"> </td>

<td align="center"><a href="dlayout.jsp?layoutid=<%=ff%>" onClick="javascript:return confirm('Do you want to delete?')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/delete.gif" border="0" width="18" height="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></td>
</tr>
<%
}%>
</table>
</table>
<%
s.close();
c.close();
}

}
catch(Exception e)
{
out.write(""+e);
}
%>

</body>
</html>
