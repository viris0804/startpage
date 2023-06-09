<?php
   session_start();
   error_reporting(0);
   define('ADMIN_PASS', '21232f297a57a5a743894a0e4a801fc3');
   $session_timeout = 600;
   $database = './usersdb.php';
   $admin_password = isset($_COOKIE['admin_password']) ? $_COOKIE['admin_password'] : '';
   if (empty($admin_password))
   {
      if (isset($_POST['admin_password']))
      {
         $admin_password = md5($_POST['admin_password']);
         if ($admin_password == ADMIN_PASS)
         {
            setcookie('admin_password', $admin_password, time() + $session_timeout);
         }
      }
   }
   else
   if ($admin_password == ADMIN_PASS)
   {
      setcookie('admin_password', $admin_password, time() + $session_timeout);
   }
   if (!file_exists($database))
   {
      echo 'User database not found!';
      exit;
   }
   $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
   $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
   $index = 0;
   $userindex = -1;
   $items = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
   foreach($items as $line)
   {
      list($username) = explode('|', trim($line));
      if ($id == $username)
      {
         $userindex = $index;
      }
      $index++;
   }
   if (!empty($action))
   {
      if ($action == 'delete')
      {
         if ($userindex == -1)
         {
            echo 'User not found!';
            exit;
         }
         $file = fopen($database, 'w');
         $index = 0;
         foreach($items as $line)
         {
            if ($index != $userindex)
            {
               fwrite($file, $line);
               fwrite($file, "\r\n");
            }
            $index++;
         }
         fclose($file);
         header('Location: '.basename(__FILE__));
         exit;
      }
      else
      if ($action == 'update')
      {
         $file = fopen($database, 'w');
         $index = 0;
         foreach($items as $line)
         {
            if ($index == $userindex)
            {
               $values = explode('|', trim($line));
               $values[0] = $_POST['username'];
               if (!empty($_POST['password']))
               {
                  $values[1] = md5($_POST['password']);
               }
               $values[2] = $_POST['email'];
               $values[3] = $_POST['fullname'];
               $values[4] = $_POST['active'];
               $line = '';
               for ($i=0; $i < count($values); $i++)
               {
                  if ($i != 0)
                     $line .= '|';
                  $line .= $values[$i];
               }
            }
            fwrite($file, $line);
            fwrite($file, "\r\n");
            $index++;
         }
         fclose($file);
         header('Location: '.basename(__FILE__));
         exit;
      }
      else
      if ($action == 'create')
      {
         for ($i=0; $i < $index; $i++)
         {
            if ($usernames[$i] == $_POST['username'])
            {
               echo 'User already exists!';
               exit;
            }
         }
         $file = fopen($database, 'a');
         fwrite($file, $_POST['username']);
         fwrite($file, '|');
         fwrite($file, md5($_POST['password']));
         fwrite($file, '|');
         fwrite($file, $_POST['email']);
         fwrite($file, '|');
         fwrite($file, $_POST['fullname']);
         fwrite($file, '|');
         fwrite($file, $_POST['active']);
         fwrite($file, '|NA');
         fwrite($file, "\r\n");
         fclose($file);
         header('Location: '.basename(__FILE__));
         exit;
      }
      else
      if ($action == 'logout')
      {
         session_unset();
         session_destroy();
         setcookie('admin_password', '', time() - 3600);
         header('Location: '.basename(__FILE__));
         exit;
      }
   }
?>
<!doctype html>
<html>
<head>
<meta charset="iso-8859-1">
<title>User Administrator</title>
<style type="text/css">
* 
{
   box-sizing: border-box;
}
body
{
   background-color: #FFFFFF;
   margin: 6px;
   font-size: 11px;
   font-family: Verdana;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: #000000;
}
th
{
   font-size: 11px;
   font-family: Verdana;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #BFDBFF;
   color: #006BF5;
   text-align: left;
}
td
{
   font-size: 11px;
   font-family: Verdana;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: #000000;
}
input, select
{
   font-size: 11px;
   font-family: Verdana;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   color: #000000;
   border:1px #000000 solid;
}
.clickable
{
   cursor: pointer;
}
.container
{
   max-width: 768px;
   margin: 0 auto 0 auto;
   padding: 15px;
   text-align: left;
   width: 100%;
}
td, th 
{
   padding: 0;
}
.table 
{
   background-color: transparent;
   border: 2px solid #BFDBFF;
   border-collapse: collapse;
   border-spacing: 0;
   max-width: 100%;
   width: 100%;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
{
   padding: 2px;
   line-height: 1.4285;
   vertical-align: top;
   border-top: 1px solid #BFDBFF;
}
.table > thead > tr > th 
{
   vertical-align: bottom;
   border-bottom: 2px solid #BFDBFF;
}
.table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > th, .table > caption + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > td, .table > thead:first-child > tr:first-child > td 
{
   border-top: 0;
}
th
{
   background-color: #BFDBFF;
   color: #006BF5;
   font-weight: normal;
}
.form-control 
{
   display: block;
   width: 100%;
   margin-bottom: 15px;
   padding: 6px 12px;
   font-family: Verdana;
   font-size: 11px;
   line-height: 1.4285;
   color: #555555;
   background-color: #FFFFFF;
   background-image: none;
   border: 1px solid #CCCCCC;
   border-radius: 0px;
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075);
   -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
   transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form-control:focus 
{
   border-color: #66AFE9;
   outline: 0;
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
}
label
{
   display: block;
   padding: 6px 0px;
   text-align: left;
}
.btn
{
   display: inline-block;
   padding: 6px 12px;
   margin-bottom: 0px;
   font-family: Verdana;
   font-weight: normal;
   font-size: 11px;
   text-align: center;
   text-decoration: none;
   white-space: nowrap;
   vertical-align: middle;
   cursor: pointer;
   -webkit-user-select: none;
   user-select: none;
   background-color: #337AB7;
   border: 1px solid #2E6DA4;
   border-radius: 0px;
   color: #FFFFFF;
}
#header
{
   margin-bottom: 6px;
}
#filter
{
   float: right;
}
#filter input
{
   display: inline-block;
   vertical-align: middle;
   width: 16em;
   padding: 5px 10px;
}
#filter label
{
   display: inline-block;
   max-width: 100%;
   font-size: 11px;
   font-family: Verdana;
}
.filter-hide
{
   display: none !important;
}
#pagination
{
   display: inline-block;
   list-style: none;
   padding: 0;
   border-radius: 0px;
   font-family: Verdana;
   font-weight: normal;
   font-size: 8px;
}
#pagination > li
{
   display: inline;
   font-size: 11px;
}
#pagination > li > a, #pagination > li > span
{
   position: relative;
   float: left;
   padding: 6px 12px 6px 12px;
   text-decoration: none;
   background-color: #FFFFFF;
   border: 1px #BFDBFF solid;
   color: #337AB7;
   margin-left: -1px;
}
#pagination > li:first-child > a, #pagination > li:first-child > span
{
   margin-left: 0;
   border-bottom-left-radius: 0px;
   border-top-left-radius: 0px;
}
#pagination > li:last-child > a, #pagination > li:last-child > span
{
   border-bottom-right-radius: 0px;
   border-top-right-radius: 0px;
}
#pagination > li > a:hover, #pagination > li > span:hover, #pagination > li > a:focus, #pagination > li > span:focus 
{
   background-color: #CCCCCC;
   color: #23527C;
}
#pagination > .active > a, #pagination > .active > span, #pagination > .active > a:hover, #pagination > .active > span:hover, #pagination > .active > a:focus, #pagination > .active > span:focus
{
   z-index: 2;
   background-color: #337AB7;
   border-color: #337AB7;
   color: #FFFFFF;
   cursor: default;
}
#pagination > .disabled > span, #pagination > .disabled > span:hover, #pagination > .disabled > span:focus, #pagination > .disabled > a, #pagination > .disabled > a:hover, #pagination > .disabled > a:focus 
{
   background-color: #FFFFFF;
   color: #777777;
   cursor: not-allowed;
}
.paginate-show
{
   display: table-row;
}
.paginate-hide
{
   display: none;
}
#footer
{
   margin-top: 10px;
   text-align:right;
}
.icon-edit, .icon-delete
{
   display: inline-block;
}
.icon-edit::before
{
   display: inline-block;
   width: 11px;
   height: 11px;
   content: " ";
   background: url('data:image/svg+xml,%3csvg%20style%3d%22fill:%23000000%22%20viewBox%3d%220%200%2032%2032%22%20version%3d%221.1%22%20xmlns%3d%22http://www.w3.org/2000/svg%22%3e%0d%0a%20%20%20%3cpath%20d%3d%22M10%2027%20L11%2026%20L7%2022%20L6%2023%20L6%2025%20L8%2025%20L8%2027Z%20%20M19%2011%20C19%2011%2c%2019%2010%2c%2019%2010%20C19%2010%2c%2019%2010%2c%2018%2011%20L9%2020%20C9%2020%2c%209%2020%2c%209%2021%20C9%2021%2c%209%2021%2c%209%2021%20C9%2021%2c%209%2021%2c%209%2021%20L19%2011%20C19%2011%2c%2019%2011%2c%2019%2011%20Z%20M18%207%20L26%2015%20L11%2030%20L3%2030%20L3%2022Z%20%20M30%209%20C30%2010%2c%2030%2010%2c%2030%2011%20L27%2014%20L19%206%20L22%203%20C23%203%2c%2023%203%2c%2024%203%20C25%203%2c%2025%203%2c%2026%203%20L30%208%20C30%208%2c%2030%209%2c%2030%209%22/%3e%0d%0a%3c/svg%3e%0d%0a') no-repeat center center;
}
.icon-delete::before
{
   display: inline-block;
   width: 11px;
   height: 11px;
   content: " ";
   background: url('data:image/svg+xml,%3csvg%20style%3d%22fill:%23000000%22%20viewBox%3d%220%200%2032%2032%22%20version%3d%221.1%22%20xmlns%3d%22http://www.w3.org/2000/svg%22%3e%0d%0a%20%20%20%3cpath%20d%3d%22M26%2021%20C26%2022%2c%2027%2022%2c%2027%2023%20C27%2023%2c%2026%2023%2c%2026%2024%20L24%2026%20C23%2027%2c%2023%2027%2c%2022%2027%20C22%2027%2c%2021%2027%2c%2021%2026%20L16%2021%20L11%2026%20C10%2027%2c%2010%2027%2c%209%2027%20C9%2027%2c%209%2027%2c%208%2026%20L6%2024%20C5%2023%2c%205%2023%2c%205%2023%20C5%2022%2c%205%2022%2c%206%2021%20L11%2016%20L6%2011%20C5%2011%2c%205%2010%2c%205%2010%20C5%209%2c%205%209%2c%206%208%20L8%206%20C9%206%2c%209%206%2c%209%206%20C10%206%2c%2010%206%2c%2011%206%20L16%2011%20L21%206%20C21%206%2c%2022%206%2c%2022%206%20C23%206%2c%2023%206%2c%2024%206%20L26%208%20C26%209%2c%2027%209%2c%2027%2010%20C27%2010%2c%2026%2011%2c%2026%2011%20L21%2016Z%20%22/%3e%0d%0a%3c/svg%3e%0d%0a') no-repeat center center;
}
</style>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   $('#filter input').on('propertychange input', function(e)
   {
      $('.no-results').remove();
      var $this = $(this);
      var search = $this.val().toLowerCase();
      var $target = $('.table');
      var $rows = $target.find('tbody tr');
      if (search == '') 
      {
         $rows.removeClass('filter-hide');
         buildNav();
         paginate();
      } 
      else 
      {
         $rows.each(function()
         {
            var $this = $(this);
            $this.text().toLowerCase().indexOf(search) === -1 ? $this.addClass('filter-hide') : $this.removeClass('filter-hide');
         })
         buildNav();
         paginate();
         if ($target.find('tbody tr:visible').size() === 0) 
         {
            var col_span = $target.find('tr').first().find('td').size();
            var no_results = $('<tr class="no-results"><td colspan="'+col_span+'"></td></tr>');
            $target.find('tbody').append(no_results);
         }
      }
   });
   $('.table').each(function()
   {
      var currentPage = 0;
      var numPerPage = 10;
      var $table = $(this);
      var numRows = $table.find('tbody tr').length;
      var numPages = Math.ceil(numRows / numPerPage);
      var $pagination = $('#pagination');
      paginate = function()
      {
         $pagination.find('li').eq(currentPage+1).addClass('active').siblings().removeClass('active');
         var $prev = $pagination.find('li:first-child');
         var $next = $pagination.find('li:last-child');
         if (currentPage == 0)
         {
            $prev.addClass('disabled');
         }
         else
         {
            $prev.removeClass('disabled');
         }
         if (currentPage == (numPages-1))
         {
            $next.addClass('disabled');
         }
         else
         {
            $next.removeClass('disabled');
         }
         $table.find('tbody tr').not('.filter-hide').removeClass('paginate-show').addClass('paginate-hide').slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).removeClass('paginate-hide').addClass('paginate-show');;
      };
      buildNav = function()
      {
         numRows = $table.find('tbody tr').not('.filter-hide').length;
         numPages = Math.ceil(numRows / numPerPage);
         $pagination.find('li').not($pagination.find('li:first-child')).not($pagination.find('li:last-child')).remove();
         for (var page = 0; page < numPages; page++)
         {
            var item = '<a>' + (page + 1) + '</a>';
            $('<li></li>').html(item)
            .bind('click', {newPage: page}, function(event)
            {
               currentPage = event.data['newPage'];
               paginate();
            }).appendTo($pagination).addClass('clickable');
         }
         $pagination.find('li').eq(1).appendTo($pagination);
      }
      buildNav();
      $pagination.find('li:nth-child(2)').addClass('active');
      $pagination.find('li:first-child').click(function()
      {
         if (currentPage > 0)
         {
            currentPage--;
         }
         paginate();
      });
      $pagination.find('li:last-child').click(function()
      {
         if (currentPage < (numPages-1))
         {
            currentPage++;
         }
         paginate();
      });
      paginate();
   });
});
</script>
</head>
<body>
<?php
   if ($admin_password != ADMIN_PASS)
   {
      echo "<div class=\"container\" style=\"text-align:center\">\n";
      echo "<h2>User Administrator</h2>\n";
      echo "<form method=\"post\" action=\"" .basename(__FILE__) . "\">\n";
      echo "<input class=\"form-control\" type=\"password\" name=\"admin_password\" size=\"20\" />\n";
      echo "<input class=\"btn\" type=\"submit\" value=\"Login\" name=\"submit\" />\n";
      echo "</form>\n";
      echo "</div>\n";
   }
   else
   {
      if (!empty($action))
      {
         if (($action == 'edit') || ($action == 'new'))
         {
            if ($userindex != -1)
            {
               $values = explode('|', trim($items[$userindex]));
               $username_value = $values[0];
               $email_value = $values[2];
               $fullname_value = $values[3];
               $active_value = $values[4];
            }
            else
            {
               $username_value = "";
               $fullname_value = "";
               $email_value = "";
               $active_value = "0";
            }
            echo "<div class=\"container\">\n";
            echo "<form action=\"" . basename(__FILE__) . "\" method=\"post\">\n";
            if ($action == 'new')
            {
               echo "<input name=\"action\" type=\"hidden\" value=\"create\">\n";
            }
            else
            {
               echo "<input name=\"action\" type=\"hidden\" value=\"update\">\n";
            }
            echo "<input type=\"hidden\" name=\"id\" value=\"". $id . "\">\n";
            echo "<label for=\"username\">Username</label>\n";
            echo "<input class=\"form-control\" id=\"username\" name=\"username\" size=\"50\" type=\"text\" value=\"" . $username_value . "\">\n";
            echo "<label for=\"password\">Password</label>\n";
            echo "<input class=\"form-control\" id=\"password\" name=\"password\" size=\"50\" type=\"password\" value=\"\">\n";
            echo "<label for=\"fullname\">Fullname</label>\n";
            echo "<input class=\"form-control\" id=\"fullname\" name=\"fullname\" size=\"50\" type=\"text\" value=\"" . $fullname_value . "\">\n";
            echo "<label for=\"email\">Email</label>\n";
            echo "<input class=\"form-control\" id=\"email\" name=\"email\" size=\"50\" type=\"text\" value=\"" . $email_value . "\">\n";
            echo "<label for=\"active\">Status</label>\n";
            echo "<select class=\"form-control\" name=\"active\" size=\"1\"><option " . ($active_value == "0" ? "selected " : "") . "value=\"0\">inactive</option><option " . ($active_value != "0" ? "selected " : "") . "value=\"1\">active</option></select>\n";
            echo "<input class=\"btn\" type=\"submit\" name=\"cmdSubmit\" value=\"Save\">";
            echo "&nbsp;&nbsp;";
            echo "<input class=\"btn\" name=\"cmdBack\" type=\"button\" value=\"Cancel\" onclick=\"location.href='" . basename(__FILE__) . "'\">\n";
            echo "</form>\n";
            echo "</div>\n";
         }
      }
      else
      {
         echo "<div id=\"header\"><a class=\"btn\" href=\"" . basename(__FILE__) . "?action=new\">New User</a>&nbsp;&nbsp;<a class=\"btn\" href=\"" . basename(__FILE__) . "?action=logout\">Logout</a>\n";
         echo "<div id=\"filter\">\n";
         echo "<label>Search: </label> <input class=\"form-control\" placeholder=\"\" type=\"search\">\n";
         echo "</div>\n</div>\n";
         echo "<table class=\"table table-striped table-hover\">\n";
         echo "<thead><tr><th>Username</th><th>Fullname</th><th>Email</th><th>Status</th><th>Action</th></tr></thead>\n";
         echo "<tbody>\n";
         foreach($items as $line)
         {
            list($username, $password, $email, $fullname, $active) = explode('|', trim($line));
            echo "<tr>\n";
            echo "<td>" . $username . "</td>\n";
            echo "<td>" . $fullname . "</td>\n";
            echo "<td>" . $email . "</td>\n";
            echo "<td>" . ($active == "0" ? "inactive" : "active") . "</td>\n";
            echo "<td>\n";
            echo "   <a href=\"" . basename(__FILE__) . "?action=edit&id=" . $username . "\" title=\"Edit\"><i class=\"icon-edit\"></i></a>&nbsp;\n";
            echo "   <a href=\"" . basename(__FILE__) . "?action=delete&id=" . $username . "\" title=\"Delete\" onclick=\"return confirm('Are you sure?')\"><i class=\"icon-delete\"></i></a>\n";
            echo "</td>\n";
            echo "</tr>\n";
         }
         echo "</tbody>\n";
         echo "</table>\n";
         echo "<div id=\"footer\">\n";
         echo "<ul id=\"pagination\">\n";
         echo "<li class=\"disabled\"><a href=\"#\">&laquo; Prev</a></li>\n";
         echo "<li class=\"disabled\"><a href=\"#\">Next &raquo;</a></li>\n";
         echo "</ul>\n";
         echo "</div>\n";
      }
   }
?>
</body>
</html>
