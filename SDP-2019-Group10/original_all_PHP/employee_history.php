
<?php

session_start();
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
$usercode=$_SESSION['UserID'];
include('dblink.php');
$queryck = "SELECT * FROM `employee` WHERE `user_ID`='$usercode'" ;
$resultck = mysqli_query($link, $queryck); 
$objResultck = mysqli_fetch_array($resultck);  
$emp_ID=$objResultck["emp_ID"];

$emp_name=$objResultck["name"];
$emp_tel=$objResultck["tel"];
$emp_status=$objResultck["status"];
		
$query = "SELECT * FROM `order` WHERE `status_reccive`='True' and `emp_ID`='$emp_ID' ORDER BY `order`.`date` DESC"  ;
$result = mysqli_query($link, $query); 
$num = mysqli_num_rows($result);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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

<body onload="init();">


<?php include('menu_staff.php'); ?> 
<br>	
<div id="content" style="height:auto;width:70%; margin: 0 auto;">
<?php 
if ($num>0){

echo "<table  id='customers' >";
echo "<tr  bgcolor='#CCCCCC'><th rowspan='2'>รหัสรอรับสินค้า</th><th colspan='3'>สถานะ</th></tr>"; 
echo "<tr bgcolor='#CCCCCC'><th>ชำระเงิน</th><th>ส่งพัสดุ</th><th>ดำเนินการ</th></tr>";
while($row = mysqli_fetch_array($result)) { 
	echo "<tr>";
	$orderID=$row["order_ID"];
	$querydetail = "SELECT recipient FROM `order_details` WHERE order_ID='$orderID'" ;
	$resultdetail = mysqli_query($link, $querydetail); 
	$detail=mysqli_fetch_array($resultdetail);
	echo "<td> รหัสพัสดุ : " .$row["order_ID"] . "</br>".$detail["recipient"]."</td> "; 

	if($row["status_pay"] == 'True'){
		echo "<td align='center'><img src='img/pay_s.png 'width='100 px'></td> "; 
	}
	else{
		echo "<td align='center'><img src='img/pay_w.png'width='100 px'></td> "; 
	}
	if($row["status_send"] == 'True'){
		echo "<td align='center'><img src='img/box_s.png' width='100 px'></td> ";
		$orderID=$row["order_ID"];
		$queryV = "SELECT vote	 FROM `vote` WHERE order_ID='$orderID'" ;
		$resultV = mysqli_query($link, $queryV); 
		$rowV = mysqli_fetch_array($resultV);
		$score = $rowV["vote"];
		echo "<td align='center'>Rating : ".$rowV["vote"]."</td> "; 
	}
	else{
		echo "<td align='center'><img src='img/box_w.png' width='100 px'></td> "; 
		$orderID=$row["order_ID"];
		echo "<td align='center'>
		<button class='button' onclick=\"location.href='employee_send.php?order=$orderID	'\" >ส่งพัสดุ</button></td> ";
	}
		echo "<tr>";

}
echo "</table>";
}
else{
	  echo"<h1 align='center'>ขณะนี้ยังไม่มีประวัติไปรับของจากลูกค้า</h1>"; 
	}
mysqli_close($link);
?>
</div>
</body>
</html>