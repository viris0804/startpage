<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'loginform')
{
   $success_page = 'content/index.html';
   $error_page = './error_page.html';
   $database = './usersdb.php';
   $crypt_pass = md5($_POST['password']);
   $found = false;
   $db_fullname = '';
   $db_username = '';
   $session_timeout = 600;
   if (filesize($database) > 0)
   {
      $items = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      foreach ($items as $line)
      {
         list($username, $password, $email, $name, $active) = explode('|', trim($line));
         if ($username == $_POST['username'] && $active != "0" && $password == $crypt_pass)
         {
            $found = true;
            $db_fullname = $name;
            $db_username = $username;
            break;
         }
      }
   }
   if ($found == false)
   {
      header('Location: '.$error_page);
      exit;
   }
   else
   {
      $_SESSION['username'] = $db_username;
      $_SESSION['fullname'] = $db_fullname;
      $_SESSION['expires_by'] = time() + $session_timeout;
      $_SESSION['expires_timeout'] = $session_timeout;
      $rememberme = isset($_POST['rememberme']) ? true : false;
      if ($rememberme)
      {
         setcookie('username', $db_username, time() + 3600*24*30);
         setcookie('password', $_POST['password'], time() + 3600*24*30);
      }
      header('Location: '.$success_page);
      exit;
   }
}
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Login</title>
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
#Login1
{
   background-color: #EFF6FF;
   border-color:#BFDBFF;
   border-width:1px;
   border-style: solid;
   border-radius: 0px;
   color: #006BF5;
   border-spacing: 4px;
   font-family: Verdana;
   font-weight: normal;
   font-size: 11px;
   font-style: normal;
   text-align: left;
   width: 253px;
   height: 135px;
}
#Login1 td
{
   padding: 0;
}
#Login1 .header
{
   background-color: #BFDBFF;
   color: #006BF5;
   height: 13px;
   padding: 4px 4px 4px 4px;
   text-align: center;
}
#Login1 .label
{
   height: 20px;
   width:103px;
}
#Login1 .row
{
   height: 20px;
   text-align: left;
}
#Login1 .input
{
   background-color: #FFFFFF;
   border-color: #BFDBFF;
   border-width: 1px;
   border-style: solid;
   border-radius: 2px;
   color: #006BF5;
   font-family: Verdana;
   font-weight: normal;
   font-size: 11px;
   font-style: normal;
   width: 100px;
   height: 18px;
   padding: 1px 1px 1px 1px;
}
#Login1 .button
{
   background-color: #FFFFFF;
   border-color: #BFDBFF;
   border-width: 1px;
   border-style: solid;
   border-radius: 3px;
   color: #006BF5;
   font-family: Verdana;
   font-weight: normal;
   font-size: 11px;
   font-style: normal;
   width: 70px;
   height: 20px;
   -webkit-appearance: none;
}
#wb_Text1 
{
   background-color: transparent;
   background-image: none;
   border: 0px solid transparent;
   border-radius: 0px;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text1 div
{
   text-align: center;
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
<span style="color:#282828;font-family:Tahoma;font-size:11px;">Copyright � 2013 by &quot;Pablo Software Solutions&quot;&nbsp;&nbsp; &#0183;&nbsp;&nbsp; All Rights reserved&nbsp; &#0183;&nbsp;&nbsp; <a href="http://www.wysiwygwebbuilder.com" class="linkstyle">http://www.wysiwygwebbuilder.com</a></span><span style="color:#000000;font-family:Arial;font-size:13px;"><br></span></div>
<div id="wb_master_shape3" style="position:absolute;left:1px;top:25px;width:790px;height:103px;z-index:4;">
<img src="images/img0003.png" id="master_shape3" alt="" width="790" height="103" style="width:790px;height:103px;"></div>
<div id="wb_master_shape1" style="position:absolute;left:258px;top:202px;width:505px;height:73px;z-index:5;">
<img src="images/img0004.png" id="master_shape1" alt="" width="505" height="73" style="width:505px;height:73px;"></div>
<div id="wb_master_shape4" style="position:absolute;left:28px;top:52px;width:452px;height:124px;z-index:6;">
<img src="images/img0005.png" id="master_shape4" alt="" width="452" height="124" style="width:452px;height:124px;"></div>
<div id="wb_master_text1" style="position:absolute;left:46px;top:78px;width:427px;height:65px;z-index:7;">
<span style="color:#FFFFFF;font-family:Tahoma;font-size:35px;"><strong>WYSIWYG Web Builder</strong></span><span style="color:#FFCC00;font-family:Tahoma;font-size:37px;"><strong><br></strong></span><span style="color:#006BF5;font-family:Tahoma;font-size:19px;"><strong>http://www.wysiwygwebbuilder.com</strong></span></div>
<div id="wb_master_text3" style="position:absolute;left:51px;top:225px;width:176px;height:270px;z-index:8;">
<span style="color:#000000;font-family:Tahoma;font-size:15px;"><strong><a href="./index.html" class="linkstyle">Home<br></a><br><a href="./getting_started.html" class="linkstyle">Getting Started</a><br><br><a href="./administrator.html" class="linkstyle">User Administrator</a><br><br><a href="./login.php" class="linkstyle">Login</a><br><br><a href="./signup.php" class="linkstyle">Sign up</a><br><br><a href="./change_password.php" class="linkstyle">Change Password</a><br><br><a href="./forgot_password.php" class="linkstyle">Password Recovery</a><br><br><a href="./test.php" class="linkstyle">Test</a></strong></span></div>
</div>
<a href="https://www.wysiwygwebbuilder.com" target="_blank"><img src="images/builtwithwwb17.png" alt="WYSIWYG Web Builder" style="position:absolute;left:85px;top:698px;margin: 0;border-width:0;z-index:250" width="88" height="31"></a>
<div id="wb_Login1" style="position:absolute;left:382px;top:408px;width:253px;height:135px;z-index:11;">
<form name="loginform" method="post" action="<?php echo basename(__FILE__); ?>" id="loginform">
<input type="hidden" name="form_name" value="loginform">
<table id="Login1">
<tr>
   <td class="header" colspan="2">Log In</td>
</tr>
<tr>
   <td class="label"><label for="username">User Name:</label></td>
   <td class="row"><input class="input" name="username" type="text" id="username" value="<?php echo $username; ?>"></td>
</tr>
<tr>
   <td class="label"><label for="password">Password:</label></td>
   <td class="row"><input class="input" name="password" type="password" id="password" value="<?php echo $password; ?>"></td>
</tr>
<tr>
   <td>&nbsp;</td><td class="row"><input id="rememberme" type="checkbox" name="rememberme"><label for="rememberme">Remember me</label></td>
</tr>
<tr>
   <td style="text-align:right;vertical-align:bottom" colspan="2"><input class="button" type="submit" name="login" value="Log In" id="login"></td>
</tr>
</table>
</form>
</div>
<div id="wb_Text1" style="position:absolute;left:268px;top:221px;width:484px;height:33px;text-align:center;z-index:12;">
<span style="color:#006BF5;font-family:Tahoma;font-size:27px;"><strong>Login</strong></span></div>
<div id="wb_Text2" style="position:absolute;left:259px;top:295px;width:520px;height:80px;text-align:center;z-index:13;">
<span style="color:#000000;font-family:Arial;font-size:13px;">The <strong>Login</strong> object provides a standard form to login to the protected pages.<br><br><strong><br>Important: This page must have the File Extension 'php'!</strong><br>You can change the file extension of a page in the Page Properties.</span></div>
</div>
</body>
</html>