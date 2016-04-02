

<%@ page errorPage="ExceptionHandler.jsp" %>
<%@ page language="java"%>
<%@ page import="java.sql.*"%>
<html>
   <head> </head>
<body>


        <% 
             	
             	Connection con=null;
                Statement statement=null;
			    ResultSet resultset=null;
               
               
		try {   
                
                String userid=request.getParameter("userid");
  		   	    String password=request.getParameter("password");
			    session.setAttribute("userid",userid);
			    Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
			    con=DriverManager.getConnection("jdbc:odbc:info");
			    statement=con.createStatement();
			    String qry=("select * from users where userid='"+userid+"' and password='"+password+"'"); 
       		    resultset = statement.executeQuery(qry);
	
                if(resultset.next())
                  
            	{
	         		  %>  <jsp:forward page="home.jsp" /> <%
		        }
		            
	            else
               {
        	
                    response.sendRedirect("index.jsp"); 
        	   }
    	    }
	  	catch(Exception e)
         	{
		     out.println(e);
		     
	     	}
          /*  finally
            {  statement.close();
               con.close();
	           resultset.close();
	           
            }*/
      %>

</BODY>
</HTML>
