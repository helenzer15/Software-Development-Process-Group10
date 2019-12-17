<?php 
session_start();
include('dblink.php');  
$query = "SELECT * FROM `order` WHERE `order_ID`= ".$_SESSION['strorder_ID'].""; 
$result = mysqli_query($link, $query); 
$row = mysqli_fetch_array($result);
$user=$row['user_ID'];
$tkorder=$row['order_ID'];
$location_user=$row['location'];
$queryzone = "SELECT zone FROM `location` WHERE `name`= '$location_user'"; 
$resultzone = mysqli_query($link, $queryzone); 
$rowzone = mysqli_fetch_array($resultzone);
$location_user=$rowzone['zone'];
if($_POST) {
	$name=$_POST['name'];
	$tel=$_POST['tel'];
	$location=$_POST['location'];
	$subject=$_POST['subject'];
	if(strlen($_POST['name'])==0){
		$err="กรุณาใส่ชื่อด้วยตัวอักษรระหว่าง 1-50 ตัวอักษรเท่านั้น";
		}
	elseif(strlen($_POST['name'])>50){
		$err="กรุณาใส่ชื่อด้วยตัวอักษรระหว่าง 1-50 ตัวอักษรเท่านั้น";
		}
	elseif(!preg_match("/[A-Za-zก-ฮ]+$/",$_POST['name'])){
		$err="กรุณาใส่ชื่อด้วยตัวอักษรระหว่าง 1-50 ตัวอักษรเท่านั้น";
		}
	elseif(strlen($_POST['tel'])<8 or strlen($_POST['tel'])>10){
		$err="กรุณากรอก Telephone ด้วยตัวเลขระหว่าง 8-10 ตัวเลข";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['tel'])){
		$err="กรุณากรอกTelephoneด้วยตัวเลขระหว่าง 8-10 ตัวเลข";
		}
			elseif($_POST['location']==""){
		$err="กรุณาเลือกสถานที่รับพัสดุ";
		}
	elseif(strlen($_POST['subject'])<1 or strlen($_POST['subject'])>100){
		$err="กรุณากรอกข้อมูลในช่องที่อยู่ระหว่าง 1-100 อักษรเท่านั้น";
		}
	else{
		$err="";
		}
	$detail=" ชื่อผู้รับ : $name<br> <dd>เบอร์ติดต่อ : $tel </dd><dd> ที่อยู่ :$location ($subject)</dd>" ;

		$datenow = date("Y-m-d H:i:s");
		$queryzone_recive = "SELECT zone FROM `location` WHERE `name`= '$location'";  	
		$resultzone_recive = mysqli_query($link, $queryzone_recive); 
		$rowzone_recive = mysqli_fetch_array($resultzone_recive);
		$location_reciver=$rowzone['zone'];
		if($location_user == $location_reciver){
			$queryck="SELECT `price` FROM `order_details` WHERE `order_ID` =".$_SESSION['strorder_ID']."";
			$resultck = mysqli_query($link, $queryck); 
			$rowck = mysqli_fetch_array($resultck);
			$price=$rowck['price'];
			$prices = $price+30;
			}
		else{
			$queryck="SELECT `price` FROM `order_details` WHERE `order_ID` =".$_SESSION['strorder_ID']."";
			$resultck = mysqli_query($link, $queryck); 
			$rowck = mysqli_fetch_array($resultck);
			$price=$rowck['price'];
			$prices = $price+35;
			}
		$sql = "UPDATE order_details SET
		price='$prices',name='$name',recipient='$detail',date='$datenow' WHERE order_ID = ".$_SESSION['strorder_ID']."";
		if(!mysqli_query($link, $sql)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
		if($err != "") {
			echo"<script language=\"JavaScript\">";
			echo "alert('$err')";
			echo"</script>";
			mysqli_close($link);
		}
		else{
			header('location:employee_check_recive.php');
			mysqli_close($link);
			exit;
		}
		
		
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
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
<body>

<div id="head" >
	<h1><img src="img/KMITL_Logo.png"></h1>	
</div>
<div id="content" style="width:50%; margin: 0 auto;">
    <h3>รายชื่อลูกค้า</h3>
	<?php 
		$sqluser="SELECT * FROM `customer` WHERE `user_ID` = '".$row['user_ID']."'";
		$objQueryuser = mysqli_query($link,$sqluser);
		$objResultuser = mysqli_fetch_array($objQueryuser);  
		echo "คุณ " .$objResultuser["fist_name"] . " ".$objResultuser["last_name"]." ";
		echo "เบอร์โทรติดต่อ " .$row["phone"] ;
		mysqli_close($link);
    ?>
    <br>
</div>
<div id="content" style="height:auto;width:50%; margin: 0 auto;">
	<form method='post'>
	<h3>ข้อมูลลูกค้าปลายทาง</h3>
    <div class="row" >
        <div class="col-25">
        <label for="name">ชื่อ</label>
        </div>
        <div class="col-75">
        <input type="text" id="name" name="name" placeholder="ชื่อผู้รับ" > 
        </div>
    </div>
	<div class="row">
        <div class="col-25">
          <label for="tel">เบอร์โทร</label>
        </div>
        <div class="col-75">
          <input type="text" id="tel" name="tel" placeholder="เบอร์โทติดต่อ"> 
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
                <option value="ตึกCCA">ตึก CCA</option>
                <option value="ตึกECC">ตึก ECC</option>
                <option value="ตึกHM">ตึก HM</option>
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
        <div class="col-25">
          <a href="employee_takeorder_edit.php">Back</a>
        </div>
        <div class="col-75">
          <input type="submit" value="Next">
        </div>
    </div>
</form>
</div>
</body>
</html>