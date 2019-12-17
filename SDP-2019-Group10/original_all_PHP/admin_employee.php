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
<?php

if($_POST) {
	include "dblink.php";
		$login = $_POST['email'];
		$password =  MD5($_POST["pass"]);
		$fname =  $_POST['firstname'];
		$lname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$subjext = $_POST['subject'];
		$num=0;
		while ($num <= 0){
			$empcode = mt_rand(100000, 999999);
			$queryck = "SELECT * FROM `employee` WHERE `emp_ID`='$empcode'" ;
			if(mysqli_num_rows(mysqli_query($link, $queryck)) > 0) {
				$data = mysqli_fetch_array(mysqli_query($link, $queryck));
				$num=0;
				}
			else{
				$num=1;
			}
		}
	$err = "";
	
	$sql = "SELECT email FROM customer WHERE email = '$login'";
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);  
		if($login == $row[0]) {
			$err = "ล็อกอิน: $login ซ้ำซ้อนกับผู้ที่ลงทะเบียนแล้ว กรุณาแก้ไขใหม";
		}

	}
	 if($err == "") {
		$sql = "INSERT INTO customer VALUES(
					'$empcode', '$login', '$password', '$fname', '$lname', '$phone','$subjext','EMPLOYEE')";
		
		if(!mysqli_query($link, $sql)) {
			$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
		$sql1 = "INSERT INTO employee VALUES(
					'$empcode', '$empcode', '$fname', '$phone', 'employee',14000,0)";
		
		if(!mysqli_query($link, $sql1)) {
			$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
		
	 }
	 if($err != "") {
		echo "alert('$err');";
		mysqli_close($link);

	 }
	

mysqli_close($link);

}
?>
</head>

<body>
<div >
  <?php include('admin_menu.php'); ?>
</div>
<br />

<br />	
<div width ='100%'>
<table width="100%" border="1" border-collapse: collapse;	>
  <tr>
    <th scope="col" width="30%" valign="top">
    <form id="form1" name="form1" method="post" action="">
    <table width="100%" bgcolor=" #f2f2f2">
  <tr>
    <th height="40" colspan="2" scope="col"  align="center" bgcolor="4CAF50" style=" color:#FFF" border="1"border-collapse: collapse;>เพิ่มลูกค้ารายใหม่</th>
    </tr>
  <tr>
    <td height="40" align="left" scope="row" valign="top">อีเมล</td>
    <td height="40"  valign="top"><input id="email" name="email" type="text" style="width:90% ;height:100%"/></td>
  </tr>
  <tr>
    <td width="20%" height="40" align="left" valign="top" >      รหัสผ่าน</td>
    <td width="80%" height="40" valign="top"><input id="pass" name="pass" type="password" style="width:90%; height:100%" /></td>
  </tr>
  <tr>
    <td width="20%" height="40" align="left" valign="top"rowspan='2' >ชื่อ นามสกุล</td>
    <td  width="80%" height="40"valign="top">
	<input id="firstname" name="firstname" type="text" style="width:90%;height:100%"/></td>
  </tr>
  <tr>
   <td width="80%" height="40"valign="top">
	<input id="lastname" name="lastname" type="text" style="width:90%;height:100%"/>
    </td>
  </tr>
  <tr>
    <th width="20%" height="40" align="left" valign="top">เบอร์โทร</th>
    <td width="80%" height="40"valign="top"><input id="phone" name="phone" type="text" style="width:90%;height:100%"/></td>
  </tr>
  <tr>
    <th width="20%" height="40" align="left" valign="top">ที่อยู่</th>
    <td width="80%" height="100"valign="top"><input id="subject" name="subject" type="text" style="width:90%;height:100%"/></td>
  </tr>
  <tr>
    <th height="40" colspan="2" align='right'><input name="Submit" type="submit" class="button" id="Submit" value="Submit" /></th>
    </tr>
    
</table>
</form>

    
    </th>
    <th scope="col" width="70%" valign="top">
    	<table width="100%"  border="1" id="customers">
  <tr>
  <th colspan="6">รายชื่อลูกค้าทั้งหมด</th>
  </tr>
  <tr>
    <th width="10%" height="20 px" scope="col">User_ID</th>
    <th width="25%" scope="col">Email</th>
    <th scope="col">รายละเอียดลูกค้า</th>
    <th width="10%" scope="col">รหัสพนักงาน</th>
    <th width="10%" scope="col">แก้ไข</th>
    <th width="10%" scope="col">ลบ</th>
  </tr>
  
  	<?php 
include('dblink.php');
$query = "SELECT * FROM `customer` WHERE `status`='EMPLOYEE'" ;
$result = mysqli_query($link, $query); 
while($row = mysqli_fetch_array($result)){
	$userID=$row["user_ID"];
	$emailID=$row["email"];	
	$fnameID=$row["fist_name"];
	$lnameID=$row["last_name"];
	$phonID=$row["telephon"];
	$address=$row["address"];
	$subject="Name: $fnameID $lnameID </br> Phone number : $phonID </br> Address : $address";
?>	<tr>
    <td width="10%" scope="row"><?php echo($userID);?></td>
    <td width="25%"><?php echo($emailID);?></td>
    <td  align="left"><?php echo($subject);?></td>
    <td width="10%">
    <?php 
	$queryck = "SELECT * FROM `employee` WHERE `user_ID`='$userID'" ;
	
	if(mysqli_num_rows(mysqli_query($link, $queryck)) > 0) {
		$data = mysqli_fetch_array(mysqli_query($link, $queryck));
		echo($data['emp_ID']);
		}
	else{
	?>
    <button class='button' onclick="<?php echo("location.href='admin_code_employee.php?user_ID=$userID'");?> ">เพิ่ม</button><?php }?>
    </td>
    <td width="10%">
    <button class='button' onclick="<?php echo("location.href='admin_edit_employee.php?user_ID=$userID'");?> ">แก้ไข</button>
	</td>
    <td width="10%">
    <button class='button' onclick="<?php echo("location.href='admin_delete_employee.php?user_ID=$userID'");?> ">ลบ</button>
  </td>
  </tr>
<?php } ?>

</table> 

    </th>
  </tr>
</table>

</div>
</body>

</html>
