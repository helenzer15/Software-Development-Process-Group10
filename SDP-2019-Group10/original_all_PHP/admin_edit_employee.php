<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php 
include('dblink.php');  
	$query = "SELECT * FROM `customer` WHERE `user_ID`='".$_GET['user_ID']."'" ;
	$result = mysqli_query($link, $query); 
	$data = mysqli_fetch_array($result);
if($_POST) {
	include('dblink.php');  
		$userid=$_GET['user_ID'];
		$login = $_POST['email'];
		$fname =  $_POST['firstname'];
		$lname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$subjext = $_POST['subject'];
		$status = $_POST['status'];
		$salary = $_POST['salary'];
		$bonus = $_POST['bonus'];
		$err="";
		if($login != $data['email']){
			$sql = "SELECT email, password FROM customer WHERE email = '$login'";
			$result = mysqli_query($link, $sql);
			
			if(mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_array($result);  
				if($login == $row[0]) {
					$err = "ล็อกอิน: $login ซ้ำซ้อนกับผู้ที่ลงทะเบียนแล้ว กรุณาแก้ไขใหม";
					echo"<script language=\"JavaScript\">";
					echo "alert('$err')";
					echo"</script>";
					mysqli_close($link);
					
				}
			}
	
		}
		if($err == "") {
		$sql = "UPDATE `customer` SET `email` = '$login', `fist_name` = '$fname', `last_name` = '$lname', `telephon` = '$phone', `address` =			 '$subjext' WHERE `customer`.`user_ID` = $userid";
		if(!mysqli_query($link, $sql)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
		if($err == "") {
		$sql1 = "UPDATE `employee` SET `name` = '$fname', `tel` = '$phone', `status` = '$status', `Salary` = '$salary', `bonus` = '$bonus' WHERE `employee`.`user_ID` = $userid";
		if(!mysqli_query($link, $sql1)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูลพนักงาน กรุณาลองใหม่";	
		}
		}
		if($err != "") {
			echo"<script language=\"JavaScript\">";
			echo "alert('$err')";
			echo"</script>";
			mysqli_close($link);
			exit;
		}
		else{
			header('location:admin_employee.php');
			mysqli_close($link);
			exit;
		}
		}
}
		
		
?>


<style>
.button{
	background-color: #4CAF50;
	color: white;
	padding: 12px 20px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	float: right;	
	width: 20%;
}
.buttonleft{
	background-color: #4CAF50;
	color: white;
	padding: 12px 20px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	float: left;
	width: 20%;
}
</style>
</head>

<body>
  <?php include('admin_menu.php'); ?>
<br /> 
	

  <div style="width:100%">
 <form id="form1" name="form1" method="post">
<table align="center" width="50%" bgcolor=" #f2f2f2">
  <tr>
    <th height="40" colspan="2" scope="col"  align="center" bgcolor="4CAF50" style=" color:#FFF" border="1"border-collapse: collapse;>แก้ไขข้อมูลลูกค้า</th>
    </tr>
  <tr>
    <td width="20%" height="40" align="left" valign="top" scope="row">อีเมล</td>
    <td height="40"  valign="top"><input id="email" value="<?php echo($data['email']);?>" name="email" type="text" style="width:90% ;height:100%"/></td>
  </tr>
  <tr>
    <td width="20%" height="40" align="left" valign="top"rowspan='2' >ชื่อ นามสกุล</td>
    <td  width="68%" height="40"valign="top">
	<input id="firstname" value="<?php echo($data['fist_name']);?>" name="firstname" type="text" style="width:90%;height:100%"/></td>
  </tr>
  <tr>
   <td width="68%" height="40"valign="top">
	<input id="lastname" value="<?php echo($data['last_name']);?>" name="lastname" type="text" style="width:90%;height:100%"/>
    </td>
  </tr>
  <tr>
    <th width="20%" height="40" align="left" valign="top">เบอร์โทร</th>
    <td width="68%" height="40"valign="top"><input id="phone" value="<?php echo($data['telephon']);?>" name="phone" type="text" style="width:90%;height:100%"/></td>
  </tr>
  <tr>
    <th width="20%" height="40" align="left" valign="top">ที่อยู่</th>
    <td width="68%" height="100"valign="top"><input id="subject" value="<?php echo($data['address']);?>" name="subject" type="text" style="width:90%;height:100%"/></td>
  </tr>
    <tr>
    <?php $queryemp = "SELECT * FROM `employee` WHERE `user_ID`='".$_GET['user_ID']."'" ;
	$resultemp = mysqli_query($link, $queryemp); 
	$dataemp = mysqli_fetch_array($resultemp); 
	?>
    <th width="20%" height="40" align="left" valign="top">ตำแหน่ง</th>
    <td width="68%" height="40"valign="top"><input id="status" value="<?php echo($dataemp['status']);?>" name="status" type="text" style="width:90%;height:100%"/></td>
  </tr>
    <tr>
    <th width="20%" height="40" align="left" valign="top">เงินเดือน</th>
    <td width="68%" height="40"valign="top"><input id="salary" value="<?php echo($dataemp['Salary']);?>" name="salary" type="number" style="width:90%;height:100%"/></td>
  </tr>
    <tr>
    <th width="20%" height="40" align="left" valign="top">โบนัส</th>
    <td width="68%" height="40"valign="top"><input id="bonus" value="<?php echo($dataemp['bonus']);?>" name="bonus" type="number" style="width:90%;height:100%"/></td>
  </tr>
  <tr>
  	<td  colspan="2">
	<button class='buttonleft' onclick="<?php echo("location.href='admin_employee.php'");?> ">BACK</button>
    <input name="Submit" type="submit" class="button" id="Submit" value="UPDATE" />
    </td>
  </tr>
    
</table>
</form>
</div>
</body>
</html>
