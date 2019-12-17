
<?php

session_start();
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
$usercode=$_SESSION['UserID'];
include('dblink.php');


$usercode=$_SESSION['UserID'];
include('dblink.php');
$queryck = "SELECT * FROM `employee` WHERE `user_ID`='$usercode'" ;
$resultck = mysqli_query($link, $queryck); 
$objResultck = mysqli_fetch_array($resultck);  
$emp_ID=$objResultck["emp_ID"];
$Salary=$objResultck["Salary"];
$bonus=$objResultck["bonus"];

$Salary=$objResultck["Salary"];
$query = "SELECT * FROM `order` WHERE `emp_ID` ='$emp_ID'";
$result = mysqli_query($link, $query); 
$numbook = mysqli_num_rows($result);

$query = "SELECT * FROM `order` WHERE `emp_ID` ='$emp_ID' AND `status_send`='True'";
$result = mysqli_query($link, $query); 
$numsend = mysqli_num_rows($result);
$querysum = "SELECT SUM(`vote`)
FROM vote
WHERE `user_ID`=$usercode";
$resultsum = mysqli_query($link, $querysum); 
$sumvote = mysqli_fetch_array($resultsum);
$votetotal = $sumvote["SUM(`vote`)"];




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
<div id="content" style="height:auto;width:25%; margin: 0 auto;">
<table  id='customers' width='100%'>
<tr>
<td  bgcolor='#4CAF50' style=" color: white;">ออเดอร์ที่ได้ทำการจอง</td>
<td colspan='2' align="center"  bgcolor='#4CAF50' style=" color: white;"><?php echo($numbook);?></td>

</tr>
</table>
</div>
<br>
<div id="content" style="height:auto;width:50%; margin: 0 auto;">
<table  id='customers' width='100%'>
<tr align='center' bgcolor='#CCCCCC'>
<th width="70%">รายการยอดที่ทำได้</th>
<th width="10%">จำนวน</th>
<th>คิดเป็นเงิน</th>
</tr>

<tr>

<td>ออเดอร์ที่ทำการส่งสำเร็จ(คิดรายการละ 25 บาท)</td>
<td align="center"><?php echo($numsend);?></td>
<td align="right"><?php echo($numsend*25);?> บาท</td>
</tr>
<tr>
<td>ยอดการให้คะแนนลูกค้า(คิดรายการละ 3 บาท)</td>
<td align="center"><?php echo($votetotal);?></td>
<td align="right"><?php echo($votetotal*3);?> บาท</td>
</tr>
<tr>
<td colspan="2">เงินเดือนที่จะได้รับ</td>
<td align="right"><?php echo($Salary);?> บาท</td>
</tr>
<tr>
<td colspan="2">โบนัสเดือนนี้ที่จะได้รับ</td>
<td align="right"><?php echo($bonus);?> บาท</td>
</tr>
<tr>
<td colspan="2" align="center" bgcolor='#4CAF50' style=" color: white;">รวมเป็นเงิน</td>
<td align="right"><?php echo($bonus+($numsend*15)+($votetotal*3)+($Salary));?> บาท</td>
</tr>

</table>
</div>
</body>
</html>