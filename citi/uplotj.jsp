<%@ page contentType="text/html; charset=iso-8859-1" language="java" import="java.sql.*" errorPage="" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<%
	int plotid=Integer.parseInt(request.getParameter("plotid"));
	String layoutid=request.getParameter("layoutid");
	int size=Integer.parseInt(request.getParameter("size"));
	int price=Integer.parseInt(request.getParameter("price"));
	String availability=request.getParameter("availability");
	 try
 {
  Connection c;
  Statement s;
  ResultSet rs;
  PreparedStatement psmt=null;
  Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
  c=DriverManager.getConnection("jdbc:odbc:info");
  s=c.createStatement();
String sql="insert into plot(plotid,layoutid,size,price,availability) values(?,?,?,?,?)";
psmt=c.prepareStatement(sql);

psmt.setInt(1,plotid);
psmt.setString(2,layoutid);
psmt.setInt(3,size);
psmt.setInt(4,price);
psmt.setString(5,availability);

  int cs = psmt.executeUpdate();
  s.close();

 }
 catch(Exception e)
 {
  out.write(""+e);
 }
%>


</body>
</html>
