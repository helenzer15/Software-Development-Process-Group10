<?php 
session_start();
$_SESSION["strorder_ID"]= $_GET["tkorder_ID"];
include('dblink.php');  
$query = "SELECT * FROM `tkorder` WHERE `tkorder_ID`= ".$_SESSION["strorder_ID"]; 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($link, $query); 
$row = mysqli_fetch_array($result);
$cust_ID=$row['cust_ID'];
$tkorder_ID=$row['tkorder_ID'];
if($_POST) {
	$size = $_POST['size'];
	$wight = $_POST['wight'];
	$qly =  $_POST['qly'];
	$name = $_POST['name'];
	$tel = $_POST['tel'];
	$city =  $_POST['city'];
	$subject =  $_POST['subject'];
	$sumsize=$size+$wight;
	$address = "ชื่อผู้รับ :[$name] เบอร์ติดต่อ : [$tel] ที่อยู่ : [$city $subject]";
	if( $sumsize >= 170 ){
		//XL
		 if ($city == $row['city']){
			 $price = 290*$qly;
			 }
		 else{
			 $price = 330*$qly;
			 }
	}else if( $sumsize >= 135 && $sumsize < 170 ){
		//L
		 if ($city == $row['city']){
			 $price = 185*$qly;
			 }
		 else{
			 $price = 205*$qly;
			 }
	}else if( $sumsize >= 100 && $sumsize < 135 ){
		//M
		 if ($city == $row['city']){
			 $price = 100*$qly;
			 }
		 else{
			 $price = 115*$qly;
			 }
	}else if( $sumsize >= 65 && $sumsize < 100 ){
		//S
		if ($city == $row['city']){
			 $price = 65*$qly;
			 }
		 else{
			 $price = 80*$qly;
			 }
	}else{
		//Free
		 if ($city == $row['city']){
			 $price = 30*$qly;
			 }
		 else{
			 $price = 45*$qly;
			 }
	}

	$sqlsave = "INSERT INTO `order` VALUES(
							'', '$cust_ID', '$tkorder_ID','False','False','$address','$price')";
	$sqlup= "UPDATE `tkorder` SET `status`=1 WHERE `tkorder_ID`= $tkorder_ID"	;					
	if(!mysqli_query($link, $sqlsave)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
	}
	if(!mysqli_query($link, $sqlup)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
	}
	header("Location:#?tkorder_ID=".$row["tkorder_ID"]."");
}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<?php include('css_form.php'); ?>
<style>
a:link, a:visited {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: left;
}

a:hover, a:active {
  background-color: #45a049;
}
</style>
</head>
<body>

<div id="head" style="height:50%;width:50%; margin: 0 auto;">
<h1><img src="img/KMITL_Logo.png"></h1>	
</div>
<div id="content" style="height:50%;width:50%; margin: 0 auto;">
<h3>รายชื่อลูกค้า<h3>
<?php 
echo "<table  id='customers' width='100%'>";
//หัวข้อตาราง
echo "<tr align='center' bgcolor='#CCCCCC'><th>ชื่อ</th><th>เบอร์ติดต่อ</th><th>จังหวัด</th><th>รายละเอียกเพิ่มเติม</th></tr>";
  echo "<tr>";
  echo "<td>" .$row["name"] .  "</td> ";
  echo "<td>" .$row["tel"] .  "</td> ";
  echo "<td>" .$row["city"] .  "</td> ";
  echo "<td>" .$row["detail"] .  "</td> ";
  //ลบข้อมูล
  echo "</tr>";

echo "</table>";
//5. close connection
mysqli_close($link);
?>
<br>

</div>

<div class="container" style="height:50%;width:50%; margin: 0 auto;">
  <form method='post'>
  <h3>ข้อมูลพัสดุ<h3>
  <div class="row" >
    <div class="col-25">
      <label for="size">ขนาด</label>
    </div>
    <div class="col-75">
      <input type="number" id="size" name="size" placeholder="Cm." > 
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="wight">น้ำหนัก</label>
    </div>
    <div class="col-75">
      <input type="number" id="wight" name="wight" placeholder="Kg."> 
    </div>

  </div>
  <div class="row">
    <div class="col-25">
      <label for="qly">จำนวน</label>
    </div>
    <div class="col-75">
      <input type="number" id="qly" name="qly" placeholder="Unit">
    </div>
  </div>
   
   <h3>ข้อมูลลูกค้าปลายทาง<h3>
     <div class="row" >
    <div class="col-25">
      <label for="name">ชื่อ</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="Cm." > 
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="tel">เบอร์โทร</label>
    </div>
    <div class="col-75">
      <input type="text" id="tel" name="tel" placeholder="Kg."> 
    </div>

  </div>
  <div class="row">
    <div class="col-25">
      <label for="city">จังหวัด</label>
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
    <div class="col-25">
      <a href="booking_staff.php">Back</a>
   </div>
   	<div class="col-75">
      <input type="submit" value="Next">
    </div>
  </div>
 </form>
</div>
</body>
</html>