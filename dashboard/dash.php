<?php 
error_reporting(E_ALL);
ob_start();
include 'db/mysql_baglan.php';
include 'db/ase_baglan.php';
$sql_sunucular="SELECT  e.t,a.s,b.f,c.sa FROM 
(SELECT  count(*) as t FROM sunucular where aktif=1)e
JOIN
(SELECT  count(*) as s FROM sunucular where sunucu_tur_id=2 and aktif=1)a
JOIN
(SELECT  count(*) as f FROM sunucular where sunucu_tur_id=3 and aktif=1)b
JOIN
(SELECT  count(*) as sa FROM sunucular where sunucu_tur_id=1 and aktif=1)c"
;
$result=mysql_query($sql_sunucular,$link);
$row_sunucular=mysql_fetch_array($result,MYSQL_BOTH);
$catagories="";
$catagories_vt="";
$sql_veritabanlari="SELECT distinct veritabani from veritabanlari";
$result_vt=mysql_query($sql_veritabanlari,$link);
$sql_select="SELECT ";
$sql_outer="";
$sql_join="";
$data1="";
$data2="";
$data3="";
$data4="";
while($row_veritabani=mysql_fetch_array($result_vt,MYSQL_BOTH))
{	
	$sql_outer.="".str_replace(' ', '_', $row_veritabani["veritabani"]).".".str_replace(' ', '_', $row_veritabani["veritabani"])."_total,";
	$sql_join.="(SELECT count(*) as ".str_replace(' ', '_', $row_veritabani["veritabani"])."_total FROM veritabani_sunucu where vertab_id in (
			   SELECT vertab_id from veritabanlari v where v.veritabani_ver like '%".$row_veritabani["veritabani"]."%') )".str_replace(' ', '_', $row_veritabani["veritabani"])." JOIN
			   ";
	$catagories.="'".$row_veritabani["veritabani"]."',";
}

$sql_join=substr($sql_join, 0,-12);
$sql_outer=substr($sql_outer,0,-1);
$sql_veritabani=$sql_select." ".$sql_outer." FROM ".$sql_join;
$result2=mysql_query($sql_veritabani,$link);
$row_veritabani=mysql_fetch_array($result2,MYSQL_BOTH);
$data_veritabani="";
for($i=0;$i<mysql_num_fields($result2);$i++)
{
	$data_veritabani.=$row_veritabani[$i].",";
}


$sql_ase = "select db_name(d.dbid) as db_name,
str(ceiling(sum(case when u.segmap != 4 then u.size/1048576.*@@maxpagesize end ))/1000, 20,3) as data_size,
str(ceiling(sum(case when u.segmap != 4 then size - curunreservedpgs(u.dbid, u.lstart, u.unreservedpgs) end)/1048576.*@@maxpagesize)/1000,20,3) as data_used,ceiling(100 * (1 - 1.0 * sum(case when u.segmap != 4 then curunreservedpgs(u.dbid, u.lstart, u.unreservedpgs) end) / sum(case when u.segmap != 4 then u.size end))) as data_used_pct,
str(ceiling(sum(case when u.segmap = 4 then u.size/1048576.*@@maxpagesize end))/1000,20,3) as log_size,
str(ceiling(sum(case when u.segmap = 4 then u.size/1048576.*@@maxpagesize end) - lct_admin('logsegment_freepages',d.dbid)/1048576.*@@maxpagesize)/10,20,1) as log_used
from master..sysdatabases d, master..sysusages u
where u.dbid = d.dbid  and d.status != 256
and (db_name(d.dbid) like '%AERO%'
or db_name(d.dbid) like '%CLIMATE%'
or db_name(d.dbid) like '%INFORMIX%'
or db_name(d.dbid) like '%INSANKAYNAKLARI%'
or db_name(d.dbid) like '%SYNOP%')
group by d.dbid
order by db_name(d.dbid)"; 
/*$result_1 = odbc_exec($link_ase, $sql_ase) ; 
$satir = odbc_fetch_row($result_1); 
    if ( $satir == true ) { 
        $result_1 = odbc_exec($link_ase, $sql_ase) ; 
        while ( $row = odbc_fetch_array($result_1) ) { 
            $catagories_vt.="'".$row["db_name"]."',";
        	 $data1.="".$row["data_size"].",";
        	 $data2.= "".$row["data_used"].",";
        	 $data3.= "".$row["log_size"].",";
        	  $data4.= "".$row["log_used"].",";
        }  
    }
    
$data1=substr($data1,0,-1);
$data2=substr($data2,0,-1);
$data3=substr($data3,0,-1);
$data4=substr($data4,0,-1);*/
?>
<script type="text/javascript">
$(function () {




	
//	 $('#container3').highcharts({
//		
//         chart: {
//				 type: 'column',
//	             margin: [ 50, 50, 70, 20],
//	     		width:980,
//	     		height:350,
//	     		marginLeft:55,
//	     		color:'#EBEFF5',
//	             borderColor: '#EBEFF5',
//	             borderWidth: 3,
//         },
// 
//         title: {
//             text: 'Sybase Veritabanı Boyutları'
//         },
// 
//         xAxis: {
//        	 categories: [
//  	                    <?php echo $catagories_vt;?>
//                  ],  
//            
//         },
// 
//         yAxis: {
//             allowDecimals: false,
//             min: 0,
//             title: {
//             text: 'Gigabytes'
//             }
//         },
// 
//         tooltip: {
//             formatter: function() {
//                 return '<b>'+ this.x +'</b><br/>'+
//                     this.series.name +': '+ this.y +' GB<br/>'+
//                     'Toplam: '+ this.point.stackTotal+' GB ';
//             },
//             
//         },
// 
//         plotOptions: {
//             column: {
//                 stacking: 'normal'
//             }
//         },
// 
//         series: [{
//             name: 'Data',
//             data: [<?php echo $data1;?>],
//          
//             stack: 'Data'
//         }, {
//             name: 'Data Kullanılan',
//             data: [<?php echo $data2;?>],
//             stack: 'Log'
//         }, {
//             name: 'Log',
//             data: [<?php echo $data3;?>],
//             stack: 'Data'
//         }, {
//             name: 'Log Kullanılan',
//             data: [<?php echo $data4;?>],
//             stack: 'Log'
//         }]
//     });

	
        $('#container').highcharts({
            chart: {
                type: 'column',
                margin: [ 50, 50, 100, 80],
        		width:500,
        		height:350,
        		marginLeft:26,
                borderColor: '#EBEFF5',
                borderWidth: 3,
            },
            title: {
                text: 'Sunucu Sayıları'
            },
            xAxis: {
                categories: [
                    '<a href="index.php?s=s_l">Toplam Sunucu</a>',
                    'Fiziksel Sunucu',
                    'Sanal Sunucu',
                    'Sanallaştırma Sunucusu',
                   
                ],
                labels: {
                    rotation: 0,
                    align: 'center',
                    style: {
                        fontSize: '11px',
                        fontFamily: 'Arial,Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b> :'+
                        Highcharts.numberFormat(this.y, 0)
                        ;
                }
            },
            series: [{
                name: '',
                data: [<?php echo $row_sunucular[0];?>, <?php echo $row_sunucular[2];?>,<?php echo $row_sunucular[1];?>, <?php echo $row_sunucular[3];?>],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 2,
                    y: 5,
   					 style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                      
                    }
                }
            }]
        });
		
		$('#container2').highcharts({
            chart: {
                type: 'column',
                margin: [ 50, 50, 100, 80],
        		width:480,
        		height:350,
        		marginLeft:30,
        		color:'#EBEFF5',
                borderColor: '#EBEFF5',
                borderWidth: 3,
            },
            title: {
                text: 'Veritabanları'
            },
            xAxis: {
                categories: [
	                    <?php echo $catagories;?>
                ],
                labels: {
                    rotation: 0,
                    align: 'center',
                    style: {
                        fontSize: '11px',
                        fontFamily: 'Arial,Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        Highcharts.numberFormat(this.y,0)+' Sunucu Üzerinde'
                        ;
                }
            },
            series: [{
                name: '',
                data: [<?php echo $data_veritabani?>],
                color: '#EBBA95',
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 2,
                    y: 5,
   					 style: {
                        fontSize: '11px',
                        fontFamily: 'Arial,Verdana, sans-serif'
                      
                    }
                }
            }]
        });

		
			
	    
        
        
    });
//var interval1=900000;
//var auto_refresh = setInterval(
//		function()
//		{
//			 $(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
//			 $(".cnt").load("index2.php?s=i");
//		}, interval1);
</script>

<!--<fieldset id="fieldset_index" >
<legend id="legend_blue"> Bilgi İşlem Şube Müdürlüğü</legend>
Şube Müdürümüz   &nbsp;&nbsp;: Mehmet YILMAZ<br/>
Birim Sorumlumuz : Mustafa SERT<br/> 
<?php 
//$sql_uyeler="SELECT  count(*) as s FROM uyeler ";
//$result_u=mysql_query($sql_uyeler,$link);
//$row_u=mysql_fetch_array($result_u,MYSQL_BOTH);
//	echo "Personel Sayımız &nbsp;&nbsp;:<b> ".$row_u[0]."</b>";
?>
</fieldset>

<fieldset id="fieldset_index" >
<legend id="legend_index"> Bilgi İşlem Şube Müdürlüğü Görev, Yetki ve Sorumluluklar</legend>
a)  Firma bilgi bankası oluşturmak ve işletmek,<br/> 
b) Toplanan firma verilerin elektronik ortamda güvenli bir biçimde arşivlenmesini sağlamak,<br/> 
c) Sunucu bilgisayar ve depolama sistemi ihtiyaçlarını koordine etmek, bu kapsamda gerekli donanım ve yazılım ihtiyaçlarını belirlemek, yönetim, işletim ve bakımını yapmak veya yaptırmak,<br/> 
ç) Kullanılan sunucu tabanlı otomasyon sistemlerinin yönetim, işletim ve bakımını yapmak veya yaptırmak,<br/> 
d) Bilişim teknolojilerindeki gelişmeleri takip etmek, bilişim hedefleri ve politikalarının oluşturulması çalışmalarına katkı sağlamak,<br/> 
e) Daire başkanı tarafından verilen benzeri görevleri yapmak<br/> 

</fieldset>


-->

<div id="sistem_olaylari">
		<p class="baslik_blue">Sistem Olayları </p>
		<div id="flow_sistemo">
		 <table class="sistem_olaylari"  summary="Son Olaylar">
		 <thead>
		 <tr><th class="islem">İşlem</th>
		  <th class="islemnot">İşlem Not</th>
		   <th class="adsoyad">Ad Soyad</th>
		    <th>Tarih</th></tr>
		 </thead>
		 <tbody>
			<?php 
			$class="odd";
	$sql_sistemevents="SELECT	islem,islem_not,u.ad,u.soyad,tarih,zaman FROM loglar l left join uyeler u on  l.sicil_no=u.sicilno  WHERE oncelik=1 ORDER BY log_id DESC LIMIT 50";
	$result_s=mysql_query($sql_sistemevents,$link);
	while ($row_s=mysql_fetch_array($result_s))
		{

	 		//echo '<tr class="'.$class.'"><td class="'.$class.'"><a href="#" title="'.$row["title"].'" id="index2.php?s=o_d2&oid='.$row["olay_id"].'">'.$row["baslik"].'...</a></td></tr>';
			echo '<tr class="'.$class.'"><td class="'.$class.' islem">'.$row_s["islem"].'</td>
			<td class="'.$class.' islemnot">'.$row_s["islem_not"].'</td>
			<td class="'.$class.' adsoyad">'.$row_s["ad"].' '.$row_s["soyad"].'</td>
			<td class="'.$class.'">'.$row_s["tarih"].' '.$row_s["zaman"].'</td>
			</tr>';
			if($class=="odd"){
				$class="even";
			}
			else{
				$class="odd";
			}
		}
?>
		</tbody>
			   </table>
		</div>
		
	 
	 	
	 
</div>

<!--<fieldset class="fieldset_first" >
<legend class="legend_first" > Bilgi İşlem Şube Müdürlüğü Sunucu ve Veritabanları</legend>
Şubemiz tarafından, toplam <?php echo $row_sunucular[0];?> sunucunun yönetimi yapılmaktadır.<br/> 
Yönetimi yapılan veritabanlari ve bu veritabanlarının kaç farklı sunucu üzerinde çalıştığını aşağıdaki grafikte bulabilirsiniz.
</fieldset>
--><div id="sunucular_index">
<div id="container" ></div>
</div>
<div id="veritabanlari_index">
<div id="container2" ></div>
</div>



<div id="veritabanlari_index">
<div id="container3" ></div>
</div>
<fieldset class="fieldset_first" >
<legend class="legend_first"> Bilgi İşlem Şube Müdürlüğü Yazılımlar</legend>

<fieldset id="fieldset_kurumsal" >
<legend id="legend_index"> Kurumsal Yazılımlar</legend>
<?php 
$sql_kurumsalyaz="SELECT kuryaz_adi,kuryaz_aciklama,programlayan FROM kurumsal_yazilimlar ";
$result_ky=mysql_query($sql_kurumsalyaz,$link);
while($row_ky=mysql_fetch_array($result_ky,MYSQL_BOTH))
{	
	echo "<span title=".$row_ky[1].">".$row_ky[0]."</span><br/>";
	
	
}
?>

</fieldset>


<fieldset id="fieldset_kurumsal2" >
<legend id="legend_index"> Otomasyon Sistemleri</legend>
<?php 
$sql_paketyaz="SELECT pakyaz_adi,pakyaz_aciklama FROM paket_yazilimlar ";
$result_py=mysql_query($sql_paketyaz,$link);
while($row_py=mysql_fetch_array($result_py,MYSQL_BOTH))
{	
	echo "<span title=".$row_py[1].">".$row_py[0]."</span><br/>";
	
}
?>

</fieldset>

<fieldset id="fieldset_kurumsal3" >
<legend id="legend_index">Firma Yazılımlar</legend>
<?php 
$sql_metyaz="SELECT metyaz_adi,metyaz_aciklama FROM firma_yazilimlar ";
$result_my=mysql_query($sql_metyaz,$link);
while($row_my=mysql_fetch_array($result_my,MYSQL_BOTH))
{	
	echo "<span title=".$row_my[1].">".$row_my[0]."</span><br/>";
}
?>

</fieldset>

</fieldset>
<?php 

include 'db/mysql_baglanma.php';
include 'db/ase_baglanma.php';
ob_end_flush();
?>