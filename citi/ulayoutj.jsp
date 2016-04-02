<%@ page contentType="text/html; charset=iso-8859-1" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="java.io.*"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<%
	String layoutid=request.getParameter("layoutid");
	String area=request.getParameter("area");
	String map=request.getParameter("map");
	String city=request.getParameter("city");
	String state=request.getParameter("state");
	String facilities=request.getParameter("facilities");
	 try
 {
  Connection c;
  Statement s;
  ResultSet rs;
  PreparedStatement psmt=null;
  Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
  c=DriverManager.getConnection("jdbc:odbc:info");
  s=c.createStatement();
String sql="insert into layout(layoutid,area,map,city,state,facilities) values(?,?,?,?,?,?)";
psmt=c.prepareStatement(sql);

psmt.setString(1,layoutid);
psmt.setString(2,area);
File image=new File("C:/Tomcat 5.5/webapps/ROOT/citi/images/"+map);
FileInputStream  fis=new FileInputStream(image);
  
  psmt.setBinaryStream(3, (InputStream)fis, (int)(image.length()));
psmt.setString(4,city);
psmt.setString(5,state);
psmt.setString(6,facilities);

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
