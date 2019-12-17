<?php
session_start();
if($_POST) {
	$login = $_POST['email'];
	$password = $_POST['pass'];
	$name =  $_POST['name'];
	$city = $_POST['city'];
	$phone = $_POST['phone'];
	$subjext = $_POST['subject'];
	$err = "";
	include "dblink.php";
	
	//ตรวจสอบว่าว่า login และ code(รหัสประจำตัวซ้ำกับผู้อื่นหรือไม่)
	$sql = "SELECT * FROM customers WHERE email = '$login' OR password = '$password'";
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) < 0) {
			$err = "Email และ Password ไม่ถูกต้อง ";
	}
    if($err == "") {
		$objResult = mysqli_fetch_array($result);
		$userid=$objResult["cust_ID"];
		$sqltk = "INSERT INTO tkorder VALUES(
					'', '$userid', '$name', '$phone', '$city', '$subjext')";
		
		if(!mysqli_query($link, $sqltk)) {
			$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
	 }
	 
	 if($err != "") {
		echo "alert('$err');";
		mysqli_close($link);
		exit;
	 }
	 
	echo "ทำการจองสำเร็จ<br>"; 
	echo "<br> Go to <a href='booking.php'>กลับสู่หน้าหลัก</a>";
		
	mysqli_close($link);
	exit;
}
?>
<!DOCTYPE HTML>
<html>
    <head>
      <meta charset="UTF-8">
          <?php include('css_form.php'); ?>
	</head>
	<body>
    <?php include('menu_user.php'); ?>
    
<h2>บริการรับพัสดุหน้าบ้านฟรี</h2>
<p>กรอกข้อมูลที่อยู่ปัจจุบันของคุณให้ครบสมบูรณ์ เพือบริการที่รวดเร็ว และ สะดวก</p>
<div class="container" style="height:100%;width:100%;">
  <form method='post'>
  <div class="row" >
    <div class="col-25">
      <label for="email">Email</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="email" placeholder="อีเมล" >
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pass">Password</label>
    </div>
    <div class="col-75">
      <input type="password" id="pass" name="pass" placeholder="รหัสผ่าน">
    </div>

  </div>
  <div class="row">
    <div class="col-25">
      <label for="phone">Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="ชื่อ-นามสกุล">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="phone">Telephon</label>
    </div>
    <div class="col-75">
      <input type="text" id="phone" name="phone" placeholder="เบอร์โทรติดต่อ">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="country">Country</label>
    </div>
    <div class="col-75">
      <select id="city" name="city">
      	  <option value="" selected>--------- เลือกจังหวัด ---------</option>
		  <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
          <option value="กระบี่">กระบี่ </option>
          <option value="กาญจนบุรี">กาญจนบุรี </option>
          <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
          <option value="กำแพงเพชร">กำแพงเพชร </option>
          <option value="ขอนแก่น">ขอนแก่น</option>
          <option value="จันทบุรี">จันทบุรี</option>
          <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
          <option value="ชัยนาท">ชัยนาท </option>
          <option value="ชัยภูมิ">ชัยภูมิ </option>
          <option value="ชุมพร">ชุมพร </option>
          <option value="ชลบุรี">ชลบุรี </option>
          <option value="เชียงใหม่">เชียงใหม่ </option>
          <option value="เชียงราย">เชียงราย </option>
          <option value="ตรัง">ตรัง </option>
          <option value="ตราด">ตราด </option>
          <option value="ตาก">ตาก </option>
          <option value="นครนายก">นครนายก </option>
          <option value="นครปฐม">นครปฐม </option>
          <option value="นครพนม">นครพนม </option>
          <option value="นครราชสีมา">นครราชสีมา </option>
          <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
          <option value="นครสวรรค์">นครสวรรค์ </option>
          <option value="นราธิวาส">นราธิวาส </option>
          <option value="น่าน">น่าน </option>
          <option value="นนทบุรี">นนทบุรี </option>
          <option value="บึงกาฬ">บึงกาฬ</option>
          <option value="บุรีรัมย์">บุรีรัมย์</option>
          <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
          <option value="ปทุมธานี">ปทุมธานี </option>
          <option value="ปราจีนบุรี">ปราจีนบุรี </option>
          <option value="ปัตตานี">ปัตตานี </option>
          <option value="พะเยา">พะเยา </option>
          <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
          <option value="พังงา">พังงา </option>
          <option value="พิจิตร">พิจิตร </option>
          <option value="พิษณุโลก">พิษณุโลก </option>
          <option value="เพชรบุรี">เพชรบุรี </option>
          <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
          <option value="แพร่">แพร่ </option>
          <option value="พัทลุง">พัทลุง </option>
          <option value="ภูเก็ต">ภูเก็ต </option>
          <option value="มหาสารคาม">มหาสารคาม </option>
          <option value="มุกดาหาร">มุกดาหาร </option>
          <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
          <option value="ยโสธร">ยโสธร </option>
          <option value="ยะลา">ยะลา </option>
          <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
          <option value="ระนอง">ระนอง </option>
          <option value="ระยอง">ระยอง </option>
          <option value="ราชบุรี">ราชบุรี</option>
          <option value="ลพบุรี">ลพบุรี </option>
          <option value="ลำปาง">ลำปาง </option>
          <option value="ลำพูน">ลำพูน </option>
          <option value="เลย">เลย </option>
          <option value="ศรีสะเกษ">ศรีสะเกษ</option>
          <option value="สกลนคร">สกลนคร</option>
          <option value="สงขลา">สงขลา </option>
          <option value="สมุทรสาคร">สมุทรสาคร </option>
          <option value="สมุทรปราการ">สมุทรปราการ </option>
          <option value="สมุทรสงคราม">สมุทรสงคราม </option>
          <option value="สระแก้ว">สระแก้ว </option>
          <option value="สระบุรี">สระบุรี </option>
          <option value="สิงห์บุรี">สิงห์บุรี </option>
          <option value="สุโขทัย">สุโขทัย </option>
          <option value="สุพรรณบุรี">สุพรรณบุรี </option>
          <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
          <option value="สุรินทร์">สุรินทร์ </option>
          <option value="สตูล">สตูล </option>
          <option value="หนองคาย">หนองคาย </option>
          <option value="หนองบัวลำภู">หนองบัวลำภู </option>
          <option value="อำนาจเจริญ">อำนาจเจริญ </option>
          <option value="อุดรธานี">อุดรธานี </option>
          <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
          <option value="อุทัยธานี">อุทัยธานี </option>
          <option value="อุบลราชธานี">อุบลราชธานี</option>
          <option value="อ่างทอง">อ่างทอง </option>
          <option value="อื่นๆ">อื่นๆ</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="subject">Address</label>
    </div>
    <div class="col-75">
      <textarea id="subject" name="subject" placeholder="ข้อมูลที่อยู่ปัจจุบัน (ตำบล/อำเภอ/ถนน/บ้านเลขที่/ซอย)" style="height:200px"></textarea>
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
</div>
    	</body>
</html>