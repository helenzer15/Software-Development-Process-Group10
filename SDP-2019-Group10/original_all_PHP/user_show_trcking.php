<?php 
session_start();
include('dblink.php');
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
if($_GET) {
	$order= $_GET['order_id'];
	$sql="SELECT * FROM `order` WHERE `order_ID` = '$order'";
	$objQuery = mysqli_query($link,$sql);
	$objResult = mysqli_fetch_array($objQuery);

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php include('css_form.php'); ?>

</head>


<body>
	<?php include('user_menu.php'); ?>
    <br />
   	<div class="container" style="height:auto;width:50%; margin: 0 auto;">
        <div class="row">
            <div class="col-50">
    			<?php
                	if($objResult['status_reccive']=="True" and $objResult['status_pay']=="False" and $objResult['status_send']=="False"){
						echo("<img src='img/Step2.png' height='50%' width='100%'>");
					}
						
					
					
                	elseif($objResult['status_reccive']=="True" and $objResult['status_pay']=="True"and $objResult['status_send']=="False"){
						echo("<img src='img/Step3.png' height='50%' width='100%'>");
						$send = 1;
					}
					
					
                	elseif($objResult['status_reccive']=="True" and $objResult['status_pay']=="True" and $objResult['status_send']=="True"){
						echo("<img src='img/Step4.png' height='50%' width='100%'>");
						$send = 1;
					}
					
					else{
						echo("<img src='img/Step1.png' height='50%' width='100%'>");
					}
				?>
            </div>
            <div class="col-50">
    			<?php
                echo("หมายเลขพัสดุ  :   ".$objResult['order_ID']);
				echo("</br>");
				$sqluser="SELECT * FROM `customer` WHERE `user_ID` = '".$objResult['user_ID']."'";
				$objQueryuser = mysqli_query($link,$sqluser);
				$objResultuser = mysqli_fetch_array($objQueryuser);
				echo("ชื่อผู้ส่ง  :   ".$objResultuser['fist_name']." ".$objResultuser['last_name']);
				echo("</br>");
				echo("เบอร์ติดต่อ  :  ".$objResult['phone']);
				echo("</br>");
				if($send = 1){
				$sqluserO="SELECT * FROM `order_details` WHERE `order_ID` = '".$objResult['order_ID']."'";
				$objQueryuserO = mysqli_query($link,$sqluserO);
				$objResultuserO = mysqli_fetch_array($objQueryuserO);
				echo("".$objResultuserO['recipient']);
				echo("ค่าส่งพัสดุ  :".$objResultuserO['price']);
				echo("</br>");
				}
				
				?>
            </div>
      </div>
</div>  

</body>
</html>