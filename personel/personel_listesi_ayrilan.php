<script type="text/javascript">

function open_popup(href) {

	var url=href;
	//window.showModalDialog(href, "","toolbar=no;location=no;directories=no;status=no;menubar=no;scrollbars=yes;resizable=no;copyhistory=no;dialogHeight=300px;dialogWidth=650px;dialogLeft=550px;dialogTop=300px;");
	window.open(url, "_blank", 'width=650,height=550,location=no,menubar=no,titlebar=no,status=no,scrollbars=yes,resizable=no,screenX=500,screenY=220,centerscreen=yes');
	//window.showModalDialog(url, "","toolbar=no;location=no;directories=no;status=no;menubar=no;scrollbars=yes;resizable=no;copyhistory=no;dialogHeight=570px;dialogWidth=490px;dialogLeft=400px;dialogTop=200px;");
}

</script>

<?php
ob_start();
include 'db/mysql_baglan.php';
$sql_personel_listesi="SELECT sicilno,ad,soyad,email,ip1,ip2,aktif,gorev,tel,resim_link,resim_ad,aktif,ayrilma_sebebi FROM uyeler ORDER BY uye_id;";
$result=mysql_query($sql_personel_listesi,$link);



?>



			<div id="personel_listesi">
			<p class="baslik_blue">Personel Listesi</p>
            <div style="width:100%;height:673px;border:0px;overflow:auto;">
            <table class="personel_listesi" id="per_list">
            <thead>
            <tr>
            <th>~</th>
            <th>Ad Soyad</th>
            <th>Görev</th>
            <th>E-Posta</th>
            <th>Tel</th>
            <th>IP</th>
            </tr>
            </thead>
            
            <tbody>

            <?php 
            $class="odd";
            $class2="eski";
            while ($row=mysql_fetch_array($result,MYSQL_BOTH))
			{
					if($row['aktif']!=1){
						echo    '
						<tr class="'.$class.'"><td class="'.$class.' img"><img width="50" height="60" src="'.$row['resim_link'].$row['resim_ad'].'" border="0"/></td>
						<td class="'.$class.' ad">'.$row['ad'].' '.$row['soyad'].'</td>
						<td class="'.$class.' gorev" >'.$row['gorev'].'</td>
						<td class="'.$class.' email">'.$row['email'].'</td>
						<td class="'.$class.' tel">'.$row['tel'].'</td>
						<td class="'.$class.' ip">'.$row['ip1'].'<br/>'.$row['ip2'].'</td>
						<td class="'.$class.'"><p   style="cursor:hand;cursor:pointer;" onclick="open_popup(\'personel/personel_guncelle_form.php?uid='.$row['sicilno'].'\')">
					';
				if( isset($_SESSION['login']))	{
				if($_SESSION['sicilno']==$row["sicilno"]||$_SESSION['login_yetki']=="1")
				{  
					
					echo '<img title="Güncelle" src="images/update.png"/>';
				}
				}
					echo'</p></td>
						</tr>
						';
				
	
						if($class=="odd")
						{
							$class="even";
						}
						else{
							$class="odd";
						}
					}
//					else{
//						echo    '
//						<tr class="'.$class2.'"><td class="'.$class2.' img"><img width="50" height="60" src="'.$row['resim_link'].$row['resim_ad'].'" border="0"/></td>
//						<td class="'.$class2.' ad">'.$row['ad'].' '.$row['soyad'].'</td>
//						<td class="'.$class2.' gorev" >'.$row['gorev'].'</td>
//						<td class="'.$class2.' email">'.$row['email'].'</td>
//						<td class="'.$class2.' tel">'.$row['tel'].'</td>
//						<td class="'.$class2.' ip">'.$row['ip1'].' '.$row['ip2'].'</td>
//						</tr>
//						';
//					}
			}
            
            ?>

            
            </tbody>
            
            
            </table> 
            </div>
            </div>
            
            
             <script type="text/javascript" >
	
		$("#per_list").find('a').click(function(){
			 
				$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
				$(".cnt").load(id);
			});
		
		

</script>
<?php 
include 'db/mysql_baglanma.php';
ob_end_flush();

?>