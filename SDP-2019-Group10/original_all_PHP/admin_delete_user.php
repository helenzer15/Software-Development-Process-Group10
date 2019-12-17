<?php 
include('dblink.php');  

$sql="DELETE FROM `customer` WHERE `user_ID`='".$_GET['user_ID']."'";
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

header("location:admin_user.php");
exit();
		}
?>