<?php


					ob_start();
					include '../db/mysql_baglan.php';
					$olay_id=$_GET["oid"];
					$sql_olay_ek="SELECT olay_dokuman_id,ek_adi,ek_link FROM olay_dokumanlar WHERE olay_id=".$olay_id;
					$result_ek=mysql_query($sql_olay_ek,$link);
					
					while($row_ek=mysql_fetch_array($result_ek,MYSQL_BOTH)){
					echo '<a href="bys/'.$row_ek["ek_link"].$row_ek["ek_adi"].'" target="_blank"  title="Tıklayınız...">'.$row_ek["ek_adi"].' </a>&nbsp;&nbsp;<span id="sil" class="sil" title="Sil" value="'.$row_ek["olay_dokuman_id"].'">Sil</span><br>';
				}
				include '../db/mysql_baglanma.php';
				ob_end_flush()				
?>