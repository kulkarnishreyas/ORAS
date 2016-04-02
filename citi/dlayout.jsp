<%@ page contentType="text/html; charset=iso-8859-1" language="java" import="java.sql.*" errorPage="" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<%
 try
 {
  Connection c;
  PreparedStatement ps;
   Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
  c=DriverManager.getConnection("jdbc:odbc:info");
String layoutid=request.getParameter("layoutid");
  ps=c.prepareStatement("delete from layout  where layoutid=?");
ps.setString(1,layoutid);
ps.executeUpdate();
ps.close();
c.close();
%>
<jsp:forward page="ddlayout.jsp">
<jsp:param name="msg" value="Record has been deleted successfully!!!"/>
</jsp:forward>

<%
}
 catch(Exception e)
 {
 out.write(""+e);
}
%>

</body>
</html>
