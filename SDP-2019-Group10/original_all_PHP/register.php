
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
session_start();
$showtext="";
if($_POST) {
		$login = $_POST['email'];
		$password =  MD5($_POST["pass"]);
		$fname =  $_POST['firstname'];
		$lname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$subjext = $_POST['subject'];
	$err = "";
	include "dblink.php";
	$sql = "SELECT email, password FROM customer WHERE email = '$login'";
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);  
		if($login == $row[0]) {
			$err = "ล็อกอิน: $login ซ้ำซ้อนกับผู้ที่ลงทะเบียนแล้ว กรุณาแก้ไขใหม";
		}

	}
	if(strlen($_POST['email'])<1){
		$err="กรุณากรอกอีเมล์";
		}
	elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$err="กรุณากรอกข้อมูลอีเมล์ให้ถูกรูปแบบ";
		}
	elseif(strlen($_POST["pass"])<8 or strlen($_POST["pass"])>16){
		$err="กรุณากรอก Password ระหว่าง 8-16 ตัวอักษร";
		}
	elseif(strlen($_POST['firstname'])==0){
		$err="กรุณาใส่ชื่อด้วยตัวอักษรระหว่าง 1-50 ตัวอักษรเท่านั้น";
		}
	elseif(strlen($_POST['firstname'])>50){
		$err="กรุณาใส่ชื่อด้วยตัวอักษรระหว่าง 1-50 ตัวอักษรเท่านั้น";
		}
	elseif(!preg_match("/[A-Za-zก-ฮ]+$/",$_POST['firstname'])){
		$err="กรุณาใส่ชื่อด้วยตัวอักษรระหว่าง 1-50 ตัวอักษรเท่านั้น";
		}
	elseif(strlen($_POST['lastname'])==0){
		$err="กรุณาใส่นามสกุลด้วยตัวอักษรระหว่าง 1-50 ตัวอักษรเท่านั้น";
		}
	elseif(strlen($_POST['lastname'])>50){
		$err="กรุณาใส่นามสกุลด้วยตัวอักษรระหว่าง 1-50 ตัวอักษรเท่านั้น";
		}

	elseif(!preg_match("/[A-za-zก-ฮ]+$/",$_POST['lastname'])){
		$err="กรุณาใส่นามสกุลด้วยตัวอักษรระหว่าง 1-50 ตัวอักษรเท่านั้น";
		}
	elseif(strlen($_POST['phone'])<8 or strlen($_POST['phone'])>10){
		$err="".strlen($phone)."กรุณากรอก Telephone ด้วยตัวเลขระหว่าง 8-10 ตัวเลข";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['phone'])){
		$err="กรุณากรอกTelephoneด้วยตัวเลขระหว่าง 8-10 ตัวเลข";
		}
	elseif(strlen($_POST['subject'])<1 or strlen($_POST['subject'])>100){
		$err="กรุณากรอกข้อมูลในช่องที่อยู่ระหว่าง 1-100 อักษรเท่านั้น";
		}
	else{
		$err="";
		}
	
	if($err == "") {
		$sql = "INSERT INTO customer VALUES(
					'', '$login', '$password', '$fname', '$lname', '$phone','$subjext','user')";
		
		if(!mysqli_query($link, $sql)) {
			$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
		$showtext="ลงทะเบียนสำเร็จ";
	 }
	 if($err != "") {
		echo "<script>
		alert('$err');
		
        </script>";
		mysqli_close($link);

	 }

}
?>

<style>
.alert {
  padding: 20px;
  background-color: #4CAF50;
  color: white;
}
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}
input[type=password], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
body {margin: 0;}
ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}
ul.topnav li {float: left;}
ul.topnav li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
ul.topnav li a:hover:not(.active) {background-color: #111;}
ul.topnav li a.active {background-color: #4CAF50;}
ul.topnav li.right {float: right;}

@media screen and (max-width: 600px) {
  ul.topnav li.right, 
  ul.topnav li {float: none;}
}
</style>
</head>
<body>
<div id="header-container"><br>
            <h1><img src="img/KMITL_Logo.png"></h1>	
        </div>
        <nav>
            <ul class="topnav">
              <li><a href="index.php">หน้าแรก</a></li>
              <li><a href="">บริการของเรา</a></li>
              <li><a href="">ค่าบริการ</a></li>
              <li><a href="#about">เกี่ยวกับเรา</a></li>
              <li><a href="#about">ติดต่อเรา</a></li>
              <li style="float:right"><a href="register.php">สมัครสมาชิค</a></li>
              <li style="float:right"><a href="login.php">เข้าสู่ระบบ</a></li>
            </ul>
        </nav>
<?php if($showtext!=""){
	?>
    <br>
	<div class="container" style="height:auto;width:50%; margin: 0 auto;">
		<h1 align="center">ลงทะเบียนสำเร็จ</h1>
        <h1 align="center">ระบบทำการบันทึกข้อมูลของท่านเรียบร้อยแล้ว</h1>
        <h1 align="center">กรุณาเข้าสู่ระบบเพื่อใช้บริการของเรา</h1>
</div>	
	<?php
	}
	else{
		?><br>

<div class="container" style="height:auto;width:50%; margin: 0 auto;">
  <form method='post'>
  	<label for="email">อีเมล	</label>
    <input type="text" id="email" name="email" placeholder="Your email..">

    <label for="pass">รหัสผ่าน</label>
    <input type="password" id="pass" name="pass" placeholder="Your password..">
    
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

 	<label for="tel">Telephone</label>
    <input type="text" id="phone" name="phone" placeholder="Your Phone..">


    <label for="adress">Address</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" id="submit" value="Submit">
  </form>
 
</div>
 <?php } ?>

</body>
</html>