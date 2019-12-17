<?php
session_start();
	if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
	include "dblink.php";

$check_order =$_SESSION['UserID'];
$sql = "SELECT * FROM `order` WHERE `user_ID`='$check_order' AND`status_reccive`='False'";
$result = mysqli_query($link, $sql);


if(mysqli_num_rows($result) >= 1){
	$objResult = mysqli_fetch_array($result);
	$Ordercode=$objResult['order_ID'];
	
	header("location:user_show_order.php");
	
	
	
}
		$sql1 = "SELECT * FROM `customer` WHERE `user_ID`= $check_order";
		$result1 = mysqli_query($link, $sql1);
		$objResult1 = mysqli_fetch_array($result1);
		$ems=$objResult1['email'];
		$ckpass=$objResult1['password'];
	
if($_POST) {
	$login = $_POST['email'];
	$password = md5($_POST['pass']);
	$location = $_POST['location'];
	$phone = $_POST['phone'];
	$subjext = $_POST['subject'];
	$err = "";
	include "dblink.php";

	
	

	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$err="กรุณากรอกข้อมูลอีเมล์ให้ถูกรูปแบบ";
		}
	elseif($_POST['email']!=$ems){
		$err="".$ems."อีเมลไม่ถูกต้อง";
		}
	elseif($_POST['email']==$ems and $password!=$ckpass){
		$err="รหัสผิด";
		}
		
	elseif(strlen($_POST['phone'])<8 or strlen($_POST['phone'])>10){
		$err="".strlen($phone)."กรุณากรอก Telephone ด้วยตัวเลขระหว่าง 8-10 ตัวเลข";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['phone'])){
		$err="กรุณากรอกTelephoneด้วยตัวเลขระหว่าง 8-10 ตัวเลข";
		}
	elseif($_POST['location']==""){
		$err="กรุณาเลือกสถานที่รับพัสดุ";
		}
	elseif(strlen($_POST['subject'])<1 or strlen($_POST['subject'])>100){
		$err="กรุณากรอกข้อมูลในช่องที่อยู่ระหว่าง 1-100 อักษรเท่านั้น";
		}
	
    if($err == "") {
		$objResult = mysqli_fetch_array($result);
		$userid=$objResult["user_ID"];
		$num=0;
		while ($num <= 0){
			$Ordercode = mt_rand(100000, 999999);
			$queryck = "SELECT * FROM `order` WHERE `order_ID`='$Ordercode'" ;
			if(mysqli_num_rows(mysqli_query($link, $queryck)) > 0) {
				$data = mysqli_fetch_array(mysqli_query($link, $queryck));
				$num=0;
				}
			else{
				$num=1;
			}
			}
			
		;
		
		$date=date("Y-m-d H:i:s");
		
		$sql="INSERT INTO `order`(`order_ID`, `user_ID`, `phone`, `location`, `subjext`, `status_reccive`, `status_send`, `status_pay`, `date`) VALUES ($Ordercode,'$check_order','$phone','$location','$subjext','False','False','False','$date')";
		if(!mysqli_query($link, $sql)) {
			$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
	 }
	 
	 if($err != "") {
		echo "<script>alert('$err');</script>";
		
		mysqli_close($link);
	 }
	 else{
	 $_SESSION['order_ID']= $Ordercode;
 	header('location:user_show_order.php');
	mysqli_close($link);
	exit;
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

  <h1>บริการรับพัสดุถึงที่</h1>
<p>กรอกข้อมูลตำแหน่งนัดรับพัสดุของคุณให้ครบสมบูรณ์ เพือบริการที่รวดเร็ว และ สะดวก</p>


</div>
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
      <label for="phone">เบอร์ติดต่อ</label>
    </div>
    <div class="col-75">
      <input type="text" id="phone" name="phone" placeholder="เบอร์โทรติดต่อ">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="country">สถานทีนัดรับสินค้า </label>
    </div>
    <div class="col-75">
	  <select name="location" id="location">
      		<option value="" selected>กรุณาเลือกสถานที่รับพัสดุ</option>
  			<option value="คณะเทคโนโลยีการเกษตร">คณะเทคโนโลยีการเกษตร</option>
            <option value="คณะเทคโนโลยีสารสนเทศ">คณะเทคโนโลยีสารสนเทศ</option>
            <option value="คณะครุศาสตร์อุสาหกรรม">คณะครุศาสตร์อุสาหกรรม</option>
            <option value="คณะวิทยาศาสตร์">คณะวิทยาศาสตร์</option>
            <option value="คณะสถาปัตยกรรมศาสตร์">คณะสถาปัตยกรรมศาสตร์</option>
            <option value="ตึก CCA">ตึก CCA</option>
            <option value="ตึก ECC">ตึก ECC</option>
            <option value="ตึก HM">ตึก HM</option>
            <option value="ลานพระบรมราชานุสาวรีย์ราชการที่ ๕">ลานพระบรมราชานุสาวรีย์ราชการที่ ๕</option>
            <option value="วิยาลัยนาโน">วิยาลัยนาโน</option>
            <option value="สถานีรถไฟพระจอมเกล้า">สถานีรถไฟพระจอมเกล้า</option>
            <option value="สถานีรถไฟหัวตะเข้">สถานีรถไฟหัวตะเข้</option>
            <option value="สนามกีฬาสถาบัน">สนามกีฬาสถาบัน</option>
            <option value="สำนักงานวิจัยและบริการคอมพิวเตอร์">สำนักงานวิจัยและบริการคอมพิวเตอร์</option>
            <option value="สำนักงานหอสมุดกลาง">สำนักงานหอสมุดกลาง</option>
            <option value="สำนักงานอธิการบดี">สำนักงานอธิการบดี</option>
            <option value="หอประชุม ศ.ประสม รังสิโรจน">หอประชุม ศ.ประสม รังสิโรจน</option>
            <option value="หอพักนักศึกษา">หอพักนักศึกษา</option>
            <option value="อาคารเจ้าคุณทหาร">อาคารเจ้าคุณทหาร</option>
            <option value="อาคารเรียนรวมสมเด็จพระเทพฯ">อาคารเรียนรวมสมเด็จพระเทพฯ</option>
       </select>  
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="subject">รายละเอียดอื่น </label>
    </div>
    <div class="col-75">
      <textarea id="subject" name="subject" placeholder="รายละเอียดเพิ่มเติม" style="height:100px"></textarea>
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>

</div>

    	</body>
</html>