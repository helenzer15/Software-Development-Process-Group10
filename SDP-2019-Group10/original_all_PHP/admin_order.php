    
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
    <style>
    #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }
    
    #customers tr:nth-child(even){background-color: #f2f2f2;}
    
    #customers tr:hover {background-color: #ddd;}
    
    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: center;
      background-color: #4CAF50;
      color: white;
    }
    .button{
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        width: 100%;
    }
    </style>
    <?php

session_start();
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
	

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
        $sql = "SELECT email FROM customer WHERE email = '$login'";
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);  
            if($login == $row[0]) {
                $err = "ล็อกอิน: $login ซ้ำซ้อนกับผู้ที่ลงทะเบียนแล้ว กรุณาแก้ไขใหม";
            }
    
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
            echo "alert('$err');";
            mysqli_close($link);
    
         }
        
    
    mysqli_close($link);
    
    }
    ?>
    </head>
    
    <body>
    <div >
      <?php include('admin_menu.php'); ?>
    </div>
    <br />
    
    <br />	
    <div width ='100%'>
    <table width="100%" border="1" border-collapse: collapse;	>
      <tr>
        <th scope="col" width="70%" valign="top">
            <table width="1%"  border="1" id="customers">
      <tr>
      <th colspan="9">ออเดอร์ทั้งหมด</th>
      </tr>
      <tr>
        <th width="5%" height="20" scope="col">รหัสพัสดุ</th>
        <th width="5%" scope="col">รหัสลูก</th>
        <th width="5%" scope="col">รหัสพนักงาน</th>
        <th width="10%" scope="col">สถานะโอนเงิน</th>
        <th width="10%" scope="col">สถานะส่งของ</th>
        <th width="40%" scope="col">payment</th>
        <th width="5%" scope="col">ค่าบริการ</th>
        <th width="10%" scope="col">ยกเลิก</th>
        <th width="10%" scope="col">ยืนยัน</th>
      </tr>
      
        <?php 
    include('dblink.php');
    $query = "SELECT * FROM `order` ORDER BY `order`.`status_pay` DESC" ;
    $result = mysqli_query($link, $query); 
    while($row = mysqli_fetch_array($result)){
        $userID=$row["user_ID"];
        $orderID=$row["order_ID"];
        $empID=$row["emp_ID"];
        $send=$row["status_send"];
		$send=$row["status_pay"];
    
    ?><tr>
        <td width="5%" scope="row"><?php echo($orderID);?></td>
        <td width="5%"><?php echo($userID);?></td>
        <td width="5%"><?php echo($empID);?></td>
     	
        <td width="10%"><?php 
		if($row["status_pay"] == 'True'){
		echo "<img src='img/pay_s.png 'width='100 px'> "; 
		}
		else{
		echo "<img src='img/pay_w.png'width='100 px'>"; 
		}?></td>
        <td width="10%"><?php if($row["status_send"] == 'True'){
		echo "<img src='img/box_s.png 'width='100 px'>"; 
		}
		else{
		echo "<img src='img/box_w.png'width='100 px'>"; 
		}?> </td>
        <td width="40%" align="left"><?php
        $query3 = "SELECT * FROM `payment` WHERE `order_ID`='$orderID'" ;
        $result3 = mysqli_query($link, $query3);
        if(mysqli_num_rows($result3) > 0) {
                    $row3= mysqli_fetch_array($result3);
                    echo("รหัสการโอน : ".$row3['payslip']."</br>วันที่และเวลาการโอน : ".$row3['date_transfer']."</br>
                    จากธนาคาร : ".$row3['bank']."</br>จำนวน".$row3['amount']);
                    }
        
    ?></td>
        <td width="5%" align="left"><?php $query2 = "SELECT * FROM `order_details` WHERE `order_ID`='$orderID'" ;
    $result2 = mysqli_query($link, $query2);
    $row2= mysqli_fetch_array($result2);
    $price=$row2['price'];
    echo ($price); ?></td>
        <td width="10%"> <button class='button' onclick="<?php echo("location.href='admin_cancel.php?order_ID=$orderID'");?> ">cancel</button></td>
        
        <td width="10%">
          <button class='button' onclick="<?php echo("location.href='admin_confirm.php?order_ID=$orderID'");?> ">confirm</button>
        </td>
      </tr>
    <?php } ?>
    </table> 
    
        </th>
      </tr>
    </table>
    
    </div>
    </body>
    
    </html>
