
<?php

session_start();
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
$usercode=$_SESSION['UserID'];
include('dblink.php');
$queryck = "SELECT emp_ID FROM `employee` WHERE `user_ID`='$usercode'" ;
$resultck = mysqli_query($link, $queryck); 
$objResultck = mysqli_fetch_array($resultck);  
$emp_ID=$objResultck["emp_ID"];

$query = "SELECT * FROM `order` WHERE (`emp_ID`='0' or `emp_ID`='$emp_ID') and `status_reccive`='False' ORDER BY `order`.`date` ASC" ;
 
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
<div id="content" style="height:auto;width:80%; margin: 0 auto;">
<?php 
if ($num>0){
echo "<table  id='customers' width='100%'>";
//หัวข้อตาราง
echo "<tr align='center' bgcolor='#CCCCCC'><th>รหัสรอรับพัสดุ</th><th>รหัสลูกค้า</th><th>ชื่อ</th><th>เบอร์ติดต่อ</th><th>จังหวัด</th><th>รายละเอียกเพิ่มเติม</th><th>สถานะ</th>
<th colspan='3'>ดำเนินการ</th></tr>";
while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td>" .$row["order_ID"] .  "</td> "; 
  echo "<td>" .$row["user_ID"] .  "</td> ";
  $sqluser="SELECT * FROM `customer` WHERE `user_ID` = '".$row['user_ID']."'";
  $objQueryuser = mysqli_query($link,$sqluser);
  $objResultuser = mysqli_fetch_array($objQueryuser);  
  echo "<td>" .$objResultuser["fist_name"]." ".$objResultuser["last_name"].  "</td> ";
  echo "<td>" .$row["phone"] .  "</td> ";
  echo "<td>" .$row["location"] .  "</td> ";
  echo "<td>" .$row["subjext"] .  "</td> ";
  if($row["emp_ID"]!=0){
  echo "<td><img src='img/book.png' width='100 px'></td> ";
  }
  else{
  echo "<td><img src='img/Free.png' width='100 px'></td> ";
  }
  $orderID=$row["order_ID"];
  echo "<td>  <button class='button' onclick=\"location.href='employee_takeorder.php?tkorder_ID=$orderID	'\" >รับพัสดุ</button></td> ";

  $_SESSION['empID']=$emp_ID;
  echo "<td><button class='button' onclick=\"location.href='employee_book.php?tkorder_ID=$orderID	'\" >ทำการจอง</button></td> ";
  
   echo "<td><button class='button' onclick=\"location.href='employee_cancel.php?tkorder_ID=$orderID	'\" >ยกเลิกจอง</button></td> ";
   
  echo "</tr>";
}
echo "</table>";
}
else{
	  echo"<h1 align='center'>ขณะนี้ยังไม่มีรายการไปรับของจากลูกค้า</h1>"; 
	}
mysqli_close($link);
?>
</div>
</body>
</html>