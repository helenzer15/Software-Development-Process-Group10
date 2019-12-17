<?php 
session_start();

include('dblink.php');  
$sql="UPDATE `order` SET `status_pay` = 'False' WHERE `order`.`order_ID` = ".$_GET['order_ID']."";
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

header("location:admin_order.php");
exit();
		}
?>