<?php
session_start();
if (!isset($_SESSION['username']))
{
   $_SESSION['referrer'] = $_SERVER['REQUEST_URI'];
   header('Location: ./login.php');
   exit;
}
if (isset($_SESSION['expires_by']))
{
   $expires_by = intval($_SESSION['expires_by']);
   if (time() < $expires_by)
   {
      $_SESSION['expires_by'] = time() + intval($_SESSION['expires_timeout']);
   }
   else
   {
      unset($_SESSION['username']);
      unset($_SESSION['expires_by']);
      unset($_SESSION['expires_timeout']);
      $_SESSION['referrer'] = $_SERVER['REQUEST_URI'];
      header('Location: ./login.php');
      exit;
   }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'logoutform')
{
   unset($_SESSION['username']);
   unset($_SESSION['fullname']);
   header('Location: ./login.php');
   exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Protected Page</title>
<meta name="generator" content="WYSIWYG Web Builder 17 Trial Version - https://www.wysiwygwebbuilder.com">
<style type="text/css">
div#container
{
   width: 800px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 11px;
   line-height: 1.1875;
   margin: 0;
   text-align: center;
}
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
input:focus, textarea:focus, select:focus
{
   outline: none;
}
a.linkstyle
{
   color: #006BF5;
   text-decoration: underline;
}
a.linkstyle:visited
{
   color: #006BF5;
   text-decoration: underline;
}
a.linkstyle:active
{
   color: #006BF5;
   text-decoration: underline;
}
a.linkstyle:hover
{
   color: #0000FF;
   text-decoration: underline;
}
#master_shape5
{
   border-width: 0;
   vertical-align: top;
}
#master_shape5
{
   filter: drop-shadow(8px 10px 3px rgba(0,0,0,0.30));
}
#master_shape2
{
   border-width: 0;
   vertical-align: top;
}
#master_shape2
{
   filter: drop-shadow(8px 10px 3px rgba(0,0,0,0.30));
}
#wb_master_text2 
{
   background-color: transparent;
   background-image: none;
   border: 0px solid transparent;
   border-radius: 0px;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_master_text2 div
{
   text-align: center;
}
#master_shape3
{
   border-width: 0;
   vertical-align: top;
}
#master_shape3
{
   filter: drop-shadow(8px 8px 3px rgba(0,0,0,0.30));
}
#master_shape1
{
   border-width: 0;
   vertical-align: top;
}
#master_shape1
{
   filter: drop-shadow(8px 8px 3px rgba(0,0,0,0.30));
}
#master_shape4
{
   border-width: 0;
   vertical-align: top;
}
#master_shape4
{
   filter: drop-shadow(8px 10px 3px rgba(0,0,0,0.30));
}
#wb_master_text1 
{
   background-color: transparent;
   background-image: none;
   border: 0px solid transparent;
   border-radius: 0px;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_master_text1 div
{
   text-align: left;
}
#wb_master_text3 
{
   background-color: transparent;
   background-image: none;
   border: 0px solid transparent;
   border-radius: 0px;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_master_text3 div
{
   text-align: left;
}
#wb_Text2 
{
   background-color: transparent;
   background-image: none;
   border: 0px solid transparent;
   border-radius: 0px;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text2 div
{
   text-align: center;
}
#wb_Text3 
{
   background-color: transparent;
   background-image: none;
   border: 0px solid transparent;
   border-radius: 0px;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text3 div
{
   text-align: center;
}
#Logout2
{
   background-color: #EFF6FF;
   background-image: none;
   border: 1px solid #BFDBFF;
   border-radius: 0px;
   color: #006BF5;
   font-family: Verdana;
   font-weight: normal;
   font-size: 13px;
   font-style: normal;
   text-align: center;
   text-decoration: none;
   width: 96px;
   height: 25px;
   padding: 0;
}
</style>
</head>
<body>
hoi test tekst
</body>
</html>