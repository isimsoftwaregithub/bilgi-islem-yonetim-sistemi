	<?php
ob_start();
include '../log/log.php';
include '../db/mysql_baglan.php';

$uid=$_POST['uemail'];
$where=" AND email='".$uid."'";
if(is_numeric($uid)){
	$where =" AND sicilno='$uid'";
}
$upword=$_POST['upw'];
$sql_login="SELECT sicilno,ad,soyad,email,sifre,yetki_id,ip1 FROM uyeler where 1=1 ".$where;
$result=mysql_query($sql_login,$link);
$row=mysql_fetch_array($result);
if(mysql_num_rows($result)>0)
{	
	if(strcmp($row['sifre'],$upword)==0)
	{
		session_start();
		$_SESSION['sicilno']=$row['sicilno'];
		$_SESSION['uad']=$row['ad'];
		$_SESSION['usoyad']=$row['soyad'];
		$_SESSION['uemail']=$row['email'];
		$_SESSION['ip1']=$row['ip1'];
		$_SESSION['login']=TRUE;
		$_SESSION['login_yetki']=$row['yetki_id'];
		logall("Login Başarılı","YOK","0");
		header('Location: ../');
		include '../db/mysql_baglanma.php';
		ob_end_flush();
		
	}
	else{
		?>
		<script type="text/javascript" >
		alert("Şifre Hatalı");
		window.location.href = "../";
	</script>
		
		<?php 
	}
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
	
}
else{
	
		
		
		logall("Login Başarısız","YOK", "0");
		include '../db/mysql_baglanma.php';
		
ob_end_flush();
	?>
	
	<script type="text/javascript" >
		alert("Kullanıcı adı hatalı");
		window.location.href = "../";
	</script>
	<?php 


}



