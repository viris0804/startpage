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
<div id="container">
<div id="wb_MasterPage1" style="position:absolute;left:0px;top:0px;width:799px;height:834px;z-index:9;">
<div id="wb_master_shape5" style="position:absolute;left:1px;top:151px;width:790px;height:640px;z-index:0;">
<img src="images/img0001.png" id="master_shape5" alt="" width="790" height="640" style="width:790px;height:640px;"></div>
<div id="wb_master_shape2" style="position:absolute;left:28px;top:202px;width:198px;height:556px;z-index:1;">
<img src="images/img0002.png" id="master_shape2" alt="" width="198" height="556" style="width:198px;height:556px;"></div>
<a href="https://www.wysiwygwebbuilder.com" target="_blank"><img src="images/builtwithwwb17.png" alt="WYSIWYG Web Builder" style="position:absolute;left:85px;top:698px;margin: 0;border-width:0;z-index:250" width="88" height="31"></a>
<div id="wb_master_text2" style="position:absolute;left:0px;top:805px;width:793px;height:29px;text-align:center;z-index:3;">
<span style="color:#282828;font-family:Tahoma;font-size:11px;">Copyright © 2013 by &quot;Pablo Software Solutions&quot;&nbsp;&nbsp; &#0183;&nbsp;&nbsp; All Rights reserved&nbsp; &#0183;&nbsp;&nbsp; <a href="http://www.wysiwygwebbuilder.com" class="linkstyle">http://www.wysiwygwebbuilder.com</a></span><span style="color:#000000;font-family:Arial;font-size:13px;"><br></span></div>
<div id="wb_master_shape3" style="position:absolute;left:1px;top:25px;width:790px;height:103px;z-index:4;">
<img src="images/img0003.png" id="master_shape3" alt="" width="790" height="103" style="width:790px;height:103px;"></div>
<div id="wb_master_shape1" style="position:absolute;left:258px;top:202px;width:505px;height:73px;z-index:5;">
<img src="images/img0004.png" id="master_shape1" alt="" width="505" height="73" style="width:505px;height:73px;"></div>
<div id="wb_master_shape4" style="position:absolute;left:28px;top:52px;width:452px;height:124px;z-index:6;">
<img src="images/img0005.png" id="master_shape4" alt="" width="452" height="124" style="width:452px;height:124px;"></div>
<div id="wb_master_text1" style="position:absolute;left:46px;top:78px;width:427px;height:65px;z-index:7;">
<span style="color:#FFFFFF;font-family:Tahoma;font-size:35px;"><strong>WYSIWYG Web Builder</strong></span><span style="color:#FFCC00;font-family:Tahoma;font-size:37px;"><strong><br></strong></span><span style="color:#006BF5;font-family:Tahoma;font-size:19px;"><strong>http://www.wysiwygwebbuilder.com</strong></span></div>
<div id="wb_master_text3" style="position:absolute;left:51px;top:225px;width:176px;height:270px;z-index:8;">
<span style="color:#000000;font-family:Tahoma;font-size:15px;"><strong><a href="./index.html" class="linkstyle">Home<br></a><br><a href="./getting_started.html" class="linkstyle">Getting Started</a><br><br><a href="./administrator.html" class="linkstyle">User Administrator</a><br><br><a href="./login.php" class="linkstyle">Login</a><br><br><a href="./signup.php" class="linkstyle">Sign up</a><br><br><a href="./change_password.php" class="linkstyle">Change Password</a><br><br><a href="./forgot_password.php" class="linkstyle">Password Recovery</a><br><br><a href="./protected_page.php" class="linkstyle">Protected Page</a></strong></span></div>
</div>
<a href="https://www.wysiwygwebbuilder.com" target="_blank"><img src="images/builtwithwwb17.png" alt="WYSIWYG Web Builder" style="position:absolute;left:85px;top:698px;margin: 0;border-width:0;z-index:250" width="88" height="31"></a>

<div id="wb_Text2" style="position:absolute;left:267px;top:221px;width:489px;height:33px;text-align:center;z-index:12;">
<span style="color:#006BF5;font-family:Tahoma;font-size:27px;"><strong>This is a Protected Page!</strong></span></div>
<div id="wb_Text3" style="position:absolute;left:259px;top:297px;width:520px;height:128px;text-align:center;z-index:13;">
<span style="color:#000000;font-family:Arial;font-size:13px;">To protect any page from your website, simply drag &amp; drop the '<strong>Protected Page</strong>' object to the page. If the user is not logged in he will be redirected to the '<a href="./login.php">Login Page</a>'.<br><br>To logout click the 'Logout' button...<br><br><strong><br>Important: This page must have the File Extension 'php'!</strong><br>You can change the file extesion of a page in the Page Properties.</span></div>
<div id="wb_Logout2" style="position:absolute;left:448px;top:524px;width:94px;height:23px;text-align:center;z-index:14;">
<form name="logoutform" method="post" action="<?php echo basename(__FILE__); ?>" id="logoutform">
<input type="hidden" name="form_name" value="logoutform">
<button type="submit" name="logout" value="Logout" id="Logout2">Logout</button>
</form>
</div>
</div>
</body>
</html>