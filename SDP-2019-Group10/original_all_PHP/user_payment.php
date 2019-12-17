<?php
session_start();
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
$user = $_SESSION['UserID'];
include "dblink.php";
		$sql1 = "SELECT * FROM `customer` WHERE `user_ID`= $user";
		$result1 = mysqli_query($link, $sql1);
		$objResult1 = mysqli_fetch_array($result1);
		$ems=$objResult1['email'];
		$ckpass=$objResult1['password'];
if($_POST) {
	$login = $_POST['email'];
	$password = md5($_POST['pass']);
	$bank = $_POST['bank'];
	$baht = $_POST['baht'];
    $satang = $_POST['satang'];
	$date = $_POST['date'];
	$hour = $_POST['Hour'];
    $minus = $_POST['minus'];
	$payslip = $_POST['payslip'];
	$ordercode = $_POST['ordercode'];
	$amount = "$baht.$satang บาท";
	$datetext="$date  $hour:$minus ";
	$err="";
	

	if($_POST['email']!=$ems){
		$err="".$ems."อีเมลไม่ถูกต้อง";
		}
	elseif($_POST['email']==$ems and $password != $ckpass){
		$err="รหัสผิด";
		}
	elseif(strlen($_POST['ordercode'])!=6){
		$err="กรุณากรอก หมายเลขพัสดุด้วยตัวเลขระหว่าง 1-6 ตัวเลข";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['ordercode'])){
		$err="กรุณากรอกหมายเลขพัสดุด้วยตัวเลขระหว่าง 1-6 ตัวเลข";
	}
	elseif(strlen($_POST['payslip'])!=15){
		$err="กรุณากรอกหมายเลขใบสลีปด้วยตัวเลขจำนวน 15 หลักเท่านั้น";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['payslip'])){
		$err="กรุณากรอกหมายเลขใบสลีปด้วยตัวเลขจำนวน 15 หลักเท่านั้น";
	}
	elseif(strlen($_POST['baht'])<1 or strlen($_POST['baht'])>32000){
		$err="กรุณากรอกหมายเลขในช่องเงินบาทตั้งแต่ 1 - 32000 เท่านั้น";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['baht'])){
		$err="กรุณากรอกหมายเลขในช่องเงินบาทตั้งแต่ 1 - 32000 เท่านั้น";
	}
	elseif(strlen($_POST['satang'])<1 or strlen($_POST['satang'])>99){
		$err="กรุณากรอกหมายเลขในช่องเงินสตางค์ตั้งแต่ 1 - 99 เท่านั้น";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['satang'])){
		$err="กรุณากรอกหมายเลขในช่องเงินบาทตั้งแต่ 1 - 99 เท่านั้น";
	}
	elseif(strlen($_POST['Hour'])<0 or strlen($_POST['Hour'])>23){
		$err="กรุณากรอก ชั่วโมง ตั้งแต่ 0 - 23 เท่านั้น";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['Hour'])){
		$err="กรุณากรอก ชั่วโมง ตั้งแต่ 0 - 23 เท่านั้น";
	}
	elseif(strlen($_POST['minus'])<0 or strlen($_POST['minus'])>59){
		$err="กรุณากรอก นาที ตั้งแต่ 0 - 59 เท่านั้น";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['minus'])){
		$err="กรุณากรอก นาที ตั้งแต่ 0 - 59 เท่านั้น";
	}
	

		$sql2 = "SELECT * FROM `order` WHERE `order_ID`=$ordercode and `user_ID`=$user";
		$result2 = mysqli_query($link, $sql2);
		$row = mysqli_num_rows($result2);
		if($row<=0){
			$err="หมายเลขออรเดอร์ไม่ถูกต้อง";
		}
		else{
			$sql = "INSERT INTO payment VALUES(
				'', '$ordercode','$user' ,'$bank', '$payslip', '$amount', '$datetext','No')";
			if(!mysqli_query($link, $sql)) {
				$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
			}
		}

	 if($err != "") {
		echo "<script>alert('$err');</script>";
		mysqli_close($link);
		
	 }
	  else{
		header('location:user_payment_update.php?order_ID='.$ordercode.'');
		mysqli_close($link);
		exit();
	 }
	 
	
}

?>
<!DOCTYPE HTML>
<html>

    <head>
      <meta charset="UTF-8">
          <?php include('css_form.php'); ?>
	</head>
	<body>
    <?php include('user_menu.php'); ?>
  <h1>แจ้งการชำระเงิน</h1>
<p>กรุณาใส่ข้อมูลให้ครบสมบูรณ์ เพื่อป้องกันข้อผิดพลาดในการตรวจสอบ</p>
<div class="container" style="height:auto;width:50%; margin: 0 auto;">
  <form method='post'>
  <div class="row" >
    <div class="col-25">
      <label for="email">อีเมล</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="email" placeholder="อีเมล" >
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pass">รหัสผ่าน</label>
    </div>
    <div class="col-75">
      <input type="password" id="pass" name="pass" placeholder="รหัสผ่าน">
    </div>

  </div>
  <div class="row">
    <div class="col-25">
      <label for="ordercode">หมายเลขพัสดุ</label>
    </div>
    <div class="col-75">
      <input type="text" id="ordercode" name="ordercode" placeholder="หมายเลขพัสดุ">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="bank">โอนผ่านธนาคาร</label>
    </div>
    <div class="col-75">
	  <select name="bank" id="bank">
  			<option value="KMITL Wallet">KMITL Wallet</option>
       </select>  
    </div>
  </div>
  <div class="row">
  	<div class="col-25">
     	 <label for="payslip">หมายเลขสลีปโอนเงิน</label>
    </div>
     <div class="col-75">
	  	<input type="text" id="payslip" name="payslip" placeholder="หมายเลขสลิปโอนเงิน">
    </div>
  </div>
  <div class="row">
  	<div class="col-25">
     	 <label for="monney">จำนวนเงิน</label>
    </div>
    <div class="col-25">
	  	<input type="number" id="baht" name="baht" min="0" placeholder="จำนวนเงิน(บาท)">
    </div>
    <div class="col-25">
	  	<input type="number" id="satang" name="satang" min="0" max="99" placeholder="สตางค์">
    </div>
    <div class="col-25">
	  	<p>&nbsp;&nbsp;บาท - สตางค์</p>
    </div>
  </div>
   <div class="row">
  	<div class="col-25">
     	 <label for="phone">วันที่ในใบสลีป</label>
    </div>
    <div class="col-25">
	  	<input type="date" id="date" name="date"  placeholder="วว/ดด/ปปปป">
    </div>
    <div class="col-25">
	  	<input type="number" id="Hour" name="Hour" min="0" max="23" placeholder="ชัวโมง">
    </div>
    <div class="col-25">
	  		<input type="number" id="minus" name="minus" min="0" max="59" placeholder="นาที">
    </div>
  </div>
 
  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
</div>
    	</body>
</html>