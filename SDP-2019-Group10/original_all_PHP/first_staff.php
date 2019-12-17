
<?php

session_start();
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php include('menu_staff.php'); ?>
<div align="center" ><table width="50%" ><h1>ลูกค้าคือพระเจ้า</h1><td align="center" valign="middle"></br><h3>ไม่ไปส่งของไม่ได้เงินเดือนโบนัส</h3></table></div>
</body>
</html>