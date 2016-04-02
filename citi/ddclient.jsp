<%@ page contentType="text/html; charset=iso-8859-1" language="java" import="java.sql.*" errorPage="" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<p align="center" class="tophead"> View delete Information [Delete] Information </p> <table align ="center"  bgcolor="#ffffff" border="1" BORDERCOLOR="#E6E6FA" cellpadding="0" cellspacing="0"><%
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
<form name="f1" action="ddclient.jsp">
<input type="hidden" name="action" value="action">
<%
rs=s.executeQuery("select distinct(clientid) from client");
%>
<font face="verdana" size="2" color="#000080"><b><i>Select the clientid &nbsp;&nbsp; </i></b></font> <select name="clientid" size="1" onChange="form.submit()">
<option value="-2" >Select </option>
<option value="-1" >All </option>
<%
while(rs.next())
{%>
<option><%=rs.getInt("clientid")%></option>
<%
}
%>
</select>
</form>
<%
}
else
{
int clientid=request.getParameter("clientid");
rs=s.executeQuery("select distinct(clientid) from client");
%>
<form name="f1" action="ddclient.jsp">
<input type="hidden" name="action" value="action">
<font face="verdana" size="2" color="#000080"> <b><i> Select the clientid </b></i></font> <select name="clientid" size="1" onChange="form.submit()">
<%if(clientid.equals("-2")) { %> <option value="-2" selected>Select</option> <% } else  { %> <option value="-2" >Select </option> <% }
if(clientid.equals("-1")) { %> <option value="-1" selected>All</option> <% } else  { %> <option value="-1" >All </option> <% }
while(rs.next())
{
int mclientid=rs.getInt("clientid");
if(mclientid.equals(clientid))
{
%>
  <option selected><%=mclientid%></option>
<%
}
else
{
%> <option><%=mclientid%></option>
 <%
}
}
%>
 <tr><td> <table align ="center"  bgcolor="#ffffff" border="1" BORDERCOLOR="#E6E6FA" cellpadding="0" cellspacing="0">
<%
if(clientid.equals("-1"))
rs=s.executeQuery("select * from client");
else
rs=s.executeQuery("select * from client where clientid='"+clientid+"'");
%>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>clientid</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>firstname</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>lastname</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>address1</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="150"> <font face="Verdana" size="2" color="#FFFFFF"><b>address2</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>city</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>state</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="90"> <font face="Verdana" size="2" color="#FFFFFF"><b>pincode</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>contactno</b></font></td>
<TD align="center" height="25" bgcolor="#4169E1"><font face="Verdana" size="2" color="#FFFFFF">&nbsp;<b>Delete</b>&nbsp;</font></td>
</tr>
<%
while(rs.next())
{
%>
<tr>
<%
 int ff=rs.getInt("clientid");
%>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=ff%></td><td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("firstname")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("lastname")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("address1")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("address2")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("city")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("state")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getInt("pincode")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getInt("contactno")%></td>
<td class="colss"><img src="image.jsp?imgid=<%=ff%>" width="200" height="200"> </td>

<td align="center"><a href="dplot.jsp?clientid=<%=ff%>" onClick="javascript:return confirm('Do you want to delete?')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/delete.gif" border="0" width="18" height="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></td>
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
