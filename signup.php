<?php
$database = './usersdb.php';
$success_page = './login.php';
$error_message = "";
if (!file_exists($database))
{
   die('User database not found!');
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'signupform')
{
   $newusername = $_POST['username'];
   $newemail = $_POST['email'];
   $newpassword = $_POST['password'];
   $confirmpassword = $_POST['confirmpassword'];
   $newfullname = $_POST['fullname'];
   $code = 'NA';
   if ($newpassword != $confirmpassword)
   {
      $error_message = 'Password and Confirm Password are not the same!';
   }
   else
   if (!preg_match("/^[A-Za-z0-9-_!@$]{1,50}$/", $newusername))
   {
      $error_message = 'Username is not valid, please check and try again!';
   }
   else
   if (!preg_match("/^[A-Za-z0-9-_!@$]{1,50}$/", $newpassword))
   {
      $error_message = 'Password is not valid, please check and try again!';
   }
   else
   if (!preg_match("/^[A-Za-z0-9-_!@$.' &]{1,50}$/", $newfullname))
   {
      $error_message = 'Fullname is not valid, please check and try again!';
   }
   else
   if (!preg_match("/^.+@.+\..+$/", $newemail))
   {
      $error_message = 'Email is not a valid email address. Please check and try again.';
   }
   $items = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
   foreach($items as $line)
   {
      list($username, $password, $email, $fullname) = explode('|', trim($line));
      if ($newusername == $username)
      {
         $error_message = 'Username already used. Please select another username.';
         break;
      }
   }
   if (empty($error_message))
   {
      $file = fopen($database, 'a');
      fwrite($file, $newusername);
      fwrite($file, '|');
      fwrite($file, md5($newpassword));
      fwrite($file, '|');
      fwrite($file, $newemail);
      fwrite($file, '|');
      fwrite($file, $newfullname);
      fwrite($file, '|1|');
      fwrite($file, $code);
      fwrite($file, "\r\n");
      fclose($file);
      $subject = 'Your new account';
      $message = 'A new account has been setup.';
      $message .= "\r\nUsername: ";
      $message .= $newusername;
      $message .= "\r\nPassword: ";
      $message .= $newpassword;
      $message .= "\r\n";
      $header  = "From: irisvanbreda@gmail.com"."\r\n";
      $header .= "Reply-To: irisvanbreda@gmail.com"."\r\n";
      $header .= "MIME-Version: 1.0"."\r\n";
      $header .= "Content-Type: text/plain; charset=utf-8"."\r\n";
      $header .= "Content-Transfer-Encoding: 8bit"."\r\n";
      $header .= "X-Mailer: PHP v".phpversion();
      mail($newemail, $subject, $message, $header);
      header('Location: '.$success_page);
      exit;
   }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Signup</title>
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
#Signup1
{
   background-color: #EFF6FF;
   border-color:#BFDBFF;
   border-width:1px;
   border-style: solid;
   border-radius: 0px;
   color: #006BF5;
   font-family: Verdana;
   font-weight: normal;
   font-size: 11px;
   font-style: normal;
   text-align: left;
   border-spacing: 4px;
   width: 345px;
   height: 218px;
}
#Signup1 td
{
   padding: 0;
}
#Signup1 .header
{
   background-color: #BFDBFF;
   color: #006BF5;
   height: 13px;
   padding: 4px 4px 4px 4px;
   text-align: center;
}
#Signup1 .label
{
   height: 20px;
   width:113px;
}
#Signup1 .row
{
   height: 20px;
   text-align: left;
}
#Signup1 .input
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
   width: 100px;
   height: 18px;
   padding: 1px 1px 1px 1px;
}
#Signup1 .button
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
   width: 90px;
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
<span style="color:#000000;font-family:Tahoma;font-size:15px;"><strong><a href="./index.html" class="linkstyle">Home<br></a><br><a href="./getting_started.html" class="linkstyle">Getting Started</a><br><br><a href="./administrator.html" class="linkstyle">User Administrator</a><br><br><a href="./login.php" class="linkstyle">Login</a><br><br><a href="./signup.php" class="linkstyle">Sign up</a><br><br><a href="./change_password.php" class="linkstyle">Change Password</a><br><br><a href="./forgot_password.php" class="linkstyle">Password Recovery</a><br><br><a href="./protected_page.php" class="linkstyle">Protected Page</a></strong></span></div>
</div>
<a href="https://www.wysiwygwebbuilder.com" target="_blank"><img src="images/builtwithwwb17.png" alt="WYSIWYG Web Builder" style="position:absolute;left:85px;top:698px;margin: 0;border-width:0;z-index:250" width="88" height="31"></a>
<div id="wb_Signup1" style="position:absolute;left:337px;top:465px;width:345px;height:218px;z-index:11;">
<form name="signupform" method="post" action="<?php echo basename(__FILE__); ?>" id="signupform">
<input type="hidden" name="form_name" value="signupform">
<table id="Signup1">
<tr>
   <td class="header" colspan="2">Sign up for a new account</td>
</tr>
<tr>
   <td class="label"><label for="fullname">Full Name:</label></td>
   <td class="row"><input class="input" name="fullname" type="text" id="fullname"></td>
</tr>
<tr>
   <td class="label"><label for="username">User Name:</label></td>
   <td class="row"><input class="input" name="username" type="text" id="username"></td>
</tr>
<tr>
   <td class="label"><label for="password">Password:</label></td>
   <td class="row"><input class="input" name="password" type="password" id="password"></td>
</tr>
<tr>
   <td class="label"><label for="confirmpassword">Confirm Password:</label></td>
   <td class="row"><input class="input" name="confirmpassword" type="password" id="confirmpassword"></td>
</tr>
<tr>
   <td class="label"><label for="email">E-mail:</label></td>
   <td class="row"><input class="input" name="email" type="text" id="email"></td>
</tr>
<tr>
   <td colspan="2"><?php echo $error_message; ?></td>
</tr>
<tr>
   <td style="text-align:right;vertical-align:bottom" colspan="2"><input class="button" type="submit" name="signup" value="Create User" id="signup"></td>
</tr>
</table>
</form>
</div>
<div id="wb_Text1" style="position:absolute;left:266px;top:221px;width:487px;height:33px;text-align:center;z-index:12;">
<span style="color:#006BF5;font-family:Tahoma;font-size:27px;"><strong>Signup for a new account</strong></span></div>
<div id="wb_Text3" style="position:absolute;left:250px;top:297px;width:520px;height:142px;text-align:center;z-index:13;">
<span style="color:#000000;font-family:Arial;font-size:13px;">The <strong>Signup</strong> object allows users to signup for a new user account.<br>The new account will be created immediately after thye user has completed the form.<br>An email message will be send to the specified email address with the login details.<strong><br></strong></span><span style="color:#000000;font-family:Arial;font-size:11px;"><br></span><span style="color:#000000;font-family:Arial;font-size:13px;">Note that anyone can create an account, so use this object only for public pages.<br><br><strong><br>Important: This page must have the File Extension 'php'!</strong><br>You can change the file extesion of a page in the Page Properties.</span></div>
</div>
</body>
</html>