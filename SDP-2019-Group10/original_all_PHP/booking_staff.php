
<?php
//1. เชื่อมต่อ database: 
include('dblink.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

//2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM tkorder where status ='0'" or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($link, $query); 
$num = mysqli_num_rows($result);
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
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
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>

<body onload="init();">
<?php include('menu_staff.php'); ?>
<div id="content">
<?php 
echo "<table  id='customers' width='100%'>";
//หัวข้อตาราง
echo "<tr align='center' bgcolor='#CCCCCC'><th>รหัสรอรับสินค้า</th><th>รหัสลูกค้า</th><th>ชื่อ</th><th>เบอร์ติดต่อ</th><th>จังหวัด</th><th>รายละเอียกเพิ่มเติม</th><th>ดำเนินการ</th></tr>";
while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td>" .$row["tkorder_ID"] .  "</td> "; 
  echo "<td>" .$row["cust_ID"] .  "</td> ";  
  echo "<td>" .$row["name"] .  "</td> ";
  echo "<td>" .$row["tel"] .  "</td> ";
  echo "<td>" .$row["city"] .  "</td> ";
  echo "<td>" .$row["detail"] .  "</td> ";
  //ลบข้อมูล
  echo "<td><a href='working.php?tkorder_ID=".$row["tkorder_ID"]."'>รับของ</a></td> ";
  echo "</tr>";
}
echo "</table>";
//5. close connection
mysqli_close($link);
?>
</div>
</body>
</html>