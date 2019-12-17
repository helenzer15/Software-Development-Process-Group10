<?php 
session_start();
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
   <?php include('css_form.php'); ?>
</head>

<body bgcolor="#f2f2f2">
<div >
   			
      <?php include('admin_menu.php'); ?>
</div>
<br />
<div style="width:100%" align="center">

<table width="100%" border="0">
  <tr>
    <th width="25%" scope="col"><img src="img/MENU.png" alt="" width="100%" height="AUTO%" /></th>
    <th width="50%" scope="col"><img src="img/zone.png" width="100%" height="AUTO" />
    <br/>
     <div class="container" style="height:auto;width:50%; margin: 0 auto;">
  
    <form method='post'>
  <div class="row">
    <div class="col-75">
      <input type="text" id="order_id" name="order_id" placeholder="ติดตามพัสดุ">
    </div>
    <div class="col-25">
        <input type="submit" value="Submit">
    </div>
  </div>
    </th>
    <th width="25%" scope="col"><img src="img/MENU.png" alt="" width="100%" height="AUTO%" /></th>
  </tr>
</table>

</div>
<br/>
 
  </form>
  </div>  

</body>
</html>
