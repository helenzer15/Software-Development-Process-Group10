<?php   
session_start();
include('dblink.php');  
$sql="UPDATE `order` SET `status_reccive` = 'True' WHERE `order`.`order_ID` = ".$_SESSION['strorder_ID']."";
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
unset($_SESSION['strorder_ID']);
header("location:employee_booking.php");
exit();
		}
?>