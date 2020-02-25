<?php
use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require("connection.php");
?>
<?php
	require("links.php");
?>
<head>
		<link href="https://fonts.googleapis.com/css?family=Cute+Font&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
			<style>
				.bck{
					background: linear-gradient(to bottom, #666699 0%, #ffffff 100%);
				}
				.font1{
					font-family: 'Cute Font', cursive;
				}
				.font2{
					font-family: 'Anton', sans-serif;
				}
			</style>
</head>
<body class="bck">
<div class="w3-container">
			<center><h1 class="w3-card-4 w3-wide w3-white w3-text-indigo font2">ONLINE RESOURCE TRACKING SYSTEM</h1></center>
			<a href="index.php" class="w3-btn w3-round w3-white w3-xlarge w3-right">Menu</a>
			<a href="pool_track.php" class="w3-btn w3-round w3-white w3-xlarge w3-left">Back</a>
		</div>
		</br></br>
<form action="add_pool.php" class="w3-padding w3-margin w3-border w3-border-white" method="post">
<center><h2 class="w3-indigo w3-xxlarge font1 w3-wide">Enter new Request</h2></center><br><br>
<input type="text" class="w3-input w3-border w3-border-green"  name="skill" placeholder="Enter Skill set"><br><br>
<input type="text" class="w3-input w3-border w3-border-green"  name="resc_no" placeholder="Enter no. of resources"><br><br>
<input type="submit" class="w3-btn w3-border w3-large w3-border-green w3-green"  name="sub" value="Send" align="center"><br><br>
</form>
<?php
include ("resource1.php");
if (isset ($_POST['sub']))
{ 
	$res_no=$_POST['resc_no'];
	$skill=$_POST['skill'];
	$date= date('Y/m/d');
	$sql="INSERT INTO `requests`(`proj_name`,`skill_set`, `no_resc`, `Status`,`requestor`,`req_date`,`fwd_partner_date`) VALUES ('$skill','$res_no','Forwarded to partner','Project Manager','$date','$date')";
	$result=mysqli_query($mysqli,$sql);
	if (empty ($result)) 
	{
		echo "<h2 class='w3-text-red'>Record not Inserted</h2>";
	}
	else
	{
		echo "<h2 class='w3-text-green'>Record Inserted</h2>";
		echo'<br/><form action="req_resc.php" class="w3-border-green" method="POST">
						<input type="email" placeholder="TO:-" name="to_mail" class="w3-input w3-border"/><br/>
						<input type="email" class="w3-input w3-border" name="from_mail" placeholder="FROM:-"/><br/>
						<input type="password" class="w3-input w3-border" name="pass" placeholder="Enter your password"/><br/>
						<input type="text" class="w3-input w3-border" name="sub" placeholder="Subject:"/><br/>
						<input type="textarea" class="w3-input w3-border" name="txt" placeholder="Compose email:"/>
						<br/><input class="w3-btn w3-green" type="submit" name="Send" value="Send">
					</form>';
	}
}
	if(isset($_POST['Send']))
	{
				$fr_m= $_POST['from_mail'];
				$to_m= $_POST['to_mail'];
				$sub= $_POST['sub'];
				$tx= $_POST['txt'];
				$ps= $_POST['pass'];
				require 'php_mailer/src/Exception.php';
				require 'php_mailer/src/PHPMailer.php';
				require 'php_mailer/src/SMTP.php';
				require_once("php_mailer\src\PHPMailer.php");
				$mail= new PHPMailer();
				$mail->isSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = '465';
				$mail->isHTML();
				$mail->Username = "$fr_m";
				$mail->Password = "$ps";
				$mail->SetFrom('no-reply@gmail.com');
				$mail->Subject = "$sub";
				$mail->Body = "$tx";
				$mail->AddAddress("$to_m");
				$mail->Send();
	
	}
?>
</body>