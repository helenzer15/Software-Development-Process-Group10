<?php 
session_start();
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
$id=$_SESSION['UserID'];
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
<h1>บริการรับพัสดุถึงที่</h1>
<p>ทางเรากำลังส่งพนักงานไปรับพัสดุของท่าน กรุณารอสักครู่	</p>
<br />
<div class="container" style="width:50%; margin: 0 auto;" >
	<?php 
	include('dblink.php');
	$query = "SELECT `order_ID` FROM `order` WHERE `user_ID`='$id' ORDER BY `order`.`date` DESC LIMIT 1"; 
$result = mysqli_query($link, $query); 
$show=mysqli_fetch_array($result);

?>
	<h3 align="center">หมายเลขพัสดุของคุณ</h3>
    <h1 align="center"><?php echo($show['order_ID']);?></h1>
    <h5 align="center">คุณสามรถนำหมายเลขพัสดุเพือติดตามพัสดุได้</h5>

</div>
</body>
</html>