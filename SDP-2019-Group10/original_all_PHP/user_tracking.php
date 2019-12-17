<?php 
session_start();
include('dblink.php');
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
else{
	$usercode=$_SESSION['UserID'];
	}
if($_POST) {
	$order= $_POST['order_id'];
	$sql="SELECT * FROM `order` WHERE `order_ID` = '$order' and `user_ID`=$usercode";
	$objQuery = mysqli_query($link,$sql);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult){
		echo"<script language=\"JavaScript\">";
		echo"alert('ไม่พบข้อมูล')";
		echo"</script>";
		}
	else{
	header("location:user_show_trcking.php?order_id=".$objResult['order_ID']."");
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
   <?php include('css_form.php'); ?>

</head>

<body>

    <?php include('user_menu.php'); ?>
  <div><h1>กรอกหมายเลขพัสดุของคุณเพื่อค้นหาพัสดุ</h1>
  <p>กรอกเลขพัสดุ เคเอ็มไอทีเอล เอ็กซ์เพรส (KMITL Express) ของคุณ ติดตามสถานะพัสดุล่าสุดในระบบ สะดวก รวดเร็ว เพียงปุ่มเดียว</p></div>
  <br /><br />
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
  </form>
  </div>  
   
</body>
</html>