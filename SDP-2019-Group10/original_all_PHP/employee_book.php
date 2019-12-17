<?php 
session_start();
$emp=$_SESSION['empID'];
include('dblink.php');  
$sql="UPDATE `order` SET `emp_ID` = '$emp' WHERE `order`.`order_ID` = ".$_GET['tkorder_ID']."";
		$err='';
		if(!mysqli_query($link, $sql)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
		
		if($err != "") {
			echo"<script language=\"JavaScript\">";
			echo "alert('$err')";
			echo"</script>";
			mysqli_close($link);
			exit;
		}
		else{
unset($_SESSION['empID']);
header("location:employee_booking.php");
exit();
		}
?>