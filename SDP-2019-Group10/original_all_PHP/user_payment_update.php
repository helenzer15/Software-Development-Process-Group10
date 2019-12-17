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
<style>

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 150px;
}
</style>
</head>
<body>

<?php 
include('user_menu.php');
?>
<div class="container" style="" >
<div style="width:50%;margin:0 auto">
	<h1 align="center">เราจัดเก็บข้อมูลการโอนเงินของท่านแล้ว<br>
				 		และจะทำการตรวจสอบในลำดับต่อไป<br>
						ขอบคุณค่ะ</h1>
</div>
</div>
</body>
</html>