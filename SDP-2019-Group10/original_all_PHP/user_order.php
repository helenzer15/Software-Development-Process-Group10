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
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;
}

.button{
	background-color: #4CAF50;
	color: white;
	padding: 12px 20px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	float: right;
	width: 100%;
}


</style>
</head>
<body>

<?php 
include('user_menu.php');?>
<h1>ประวัติการใช้บริการ</h1>
<p>ท่านสามารถนำหมายเลขพัสดุไปตรวจได้ที่หน้าติดตามพัสดุ</p>
<br />
<div id="content" style="height:auto;width:50%; margin: 0 auto;">
<?php
include('dblink.php');
$query = "SELECT * FROM `order` WHERE `user_ID`=".$_SESSION['UserID']." ORDER BY `order`.`date` DESC"; 
$result = mysqli_query($link, $query); 
$num = mysqli_num_rows($result);
if($num > 0){
echo "<table  id='customers' >";
echo "<tr  bgcolor='#CCCCCC'><th>รหัสพัสดุ</th><th>ข้อมูลที่อยู่ปลายทาง</th><th>สถานะโอนเงิน</th><th>ชื่อผู้รับพัสดุ</th></tr>";

	while($row = mysqli_fetch_array($result)) { 
	echo "<tr>";
	$orderID=$row["order_ID"];
	$querydetail = "SELECT recipient,name FROM `order_details` WHERE order_ID='$orderID'" ;
	$resultdetail = mysqli_query($link, $querydetail); 
	$detail=mysqli_fetch_array($resultdetail);
	
	echo "<td > รหัสพัสดุ : " .$row["order_ID"] . "</td> "; 
	echo "<td width='60%'>".$detail["recipient"]."</td> ";
	
	if($row["status_pay"] == 'True'){
		echo "<td align='center'><img src='img/pay_s.png 'width='100 px'></td> "; 
	}
	else{
		echo "<td align='center'><img src='img/pay_w.png'width='100 px'></td> "; 
	}
	
	echo "<td align='center'>".$detail["name"]."</td> "; 
	echo "<tr>";

	}
}
?>


</div>
</body>
</html>