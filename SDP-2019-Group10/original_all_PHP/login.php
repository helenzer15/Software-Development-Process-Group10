<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
<meta charset="utf-8">
<title>Data Store</title>
<style>
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

body {
margin-top: 20px;

}
img {
height: 100%px;
}
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
  width: 100%;
  border-radius: 4px;
  cursor: pointer;
  float: center;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 5px;

}
label {
	float: left;
   padding: 12px 12px 12px 0;
  display: inline-block;
}
.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}
.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

</style>
</head>

<body>
<div id="header-container">
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
        <br />
        <div style="width:100% ;margin: 0 auto;">
        <div class="container" style="height:auto;width:25%; margin: 0 auto;">
            <form method="post" action="check_login.php" style="height:50%;width:100%;">
            <hr width="90%">	
            <h2 align="center">Login</h2>
            <hr width="90%">
                <div class="row" >
                <div class="col-25">
                  <label for="email">อีเมล</label>
                </div>
                <div class="col-75">
                  <input type="text" id="txtUsername" name="txtUsername" placeholder="Your email..">
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="pass">รหัสผ่าน</label>
                </div>
                <div class="col-75">
                  <input type="password" id="txtPassword" name="txtPassword" placeholder="Your password..">
                </div>
                
                <input type="submit" value="Login"></button>
            </form>
		</div>
        </div>
</body>
</html>
