<?php
session_start();
if( isset($_SESSION['login']) ) 
{
	
	if($_SESSION['login_yetki']==1)
	{
		ob_start();
		include '../db/mysql_baglan.php';
		
		if(isset($_POST['arsiv_sebebi']))
			{
				if($_POST['arsiv_sebebi']=="" || $_POST['arsiv_sebebi']==null)
				{
					echo "<img src='images/error.png'/> Lütfen Arşiv Sebebi Seçiniz...";
					return 0;
				}
			}
				
			
		
			
		
		
		if(isset($_POST['sunucu_id']))
		{
			
			$sql_arsivle="UPDATE sunucular s SET aktif=0 , arsiv_sebebi='".$_POST['arsiv_sebebi']."'  where s.sunucuID=".$_POST['sunucu_id'];
			$sql_arsivle=iconv('UTF-8', 'ISO-8859-9', $sql_arsivle);
			$sql_donagbildetay="UPDATE	donanim_ag_bilesenleri_detay SET aktif =0 where donanim_tip=1 AND donanim_tip_id=".$_POST['sunucu_id'];
		}
		else{
			echo "<img src='images/error.png'/> Lütfen Sunucu Seçiniz!...";
			return 0;
			
		}
		
		if(!mysql_query($sql_arsivle))
		{
			echo "<img src='images/error.png'/> Sql Hatası Oluştu--".mysql_error();
			return 0;
		}
		if(!mysql_query($sql_donagbildetay))
		{
			echo "<img src='images/error.png'/> Ağ Bileşenleri Güncellenemedi--".mysql_error();
			return 0;
		}
		
		echo "<img src='images/success.png'/> Sunucu Arşivleme Başarılı!...";
		
		include '../db/mysql_baglanma.php';
		ob_end_flush();
	}
}