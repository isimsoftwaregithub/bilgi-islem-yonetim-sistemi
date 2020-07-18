<link rel="stylesheet" href="../css/pagination.css" type="text/css"/>
<link rel="stylesheet" href="css/olay_liste.css" type="text/css"/>


<script type="text/javascript">

function open_popup(href) {

	var url=href;
	//window.showModalDialog(href, "","toolbar=no;location=no;directories=no;status=no;menubar=no;scrollbars=yes;resizable=no;copyhistory=no;dialogHeight=300px;dialogWidth=650px;dialogLeft=550px;dialogTop=300px;");
	window.open(url, "_blank", 'width=800,height=605,location=no,menubar=no,titlebar=no,status=no,scrollbars=yes,resizable=no,screenX=500,screenY=220,centerscreen=yes');
	//window.showModalDialog(url, "","toolbar=no;location=no;directories=no;status=no;menubar=no;scrollbars=yes;resizable=no;copyhistory=no;dialogHeight=570px;dialogWidth=490px;dialogLeft=400px;dialogTop=200px;");
}

</script>
<?php

ob_start();
session_start();
include '../db/mysql_baglan.php';
$where="";
$olay_tip_id="0";
$olay_tip="111";
//echo $_GET["olay_tip_ara"]."asdasds--<z<s";
if(isset($_GET["olay_tip_ara"])){
	//echo $_GET["olay_tip_ara"];
	$olay_tip=addslashes($_GET["olay_tip_ara"]);
if($olay_tip!="111")
{
	$where=" AND olay_tip=".$olay_tip;
}
}

if(isset($_GET["olay_tip_id"])){
	//echo $_GET["olay_tip_id2"]."---<br>";
	if($_GET["olay_tip_id"]!="0")
	{
		
		$olay_tip_id=addslashes($_GET["olay_tip_id"]);
		$where=" AND olay_tip_id=".$olay_tip_id.$where;
	}
}

//echo $where;
if(isset($_GET["anahtar_kelime"])){
$anahtar_kelime=addslashes($_GET["anahtar_kelime"]);
if($anahtar_kelime!="")
{
	$where=" AND (anahtar_kelimeler like '%".$anahtar_kelime."%' OR icerik like '%".$anahtar_kelime."%' OR baslik like '%".$anahtar_kelime."%')".$where;
}

}
		$sql_pagination = "SELECT COUNT(*) as `num` FROM olaylar o
	  					   WHERE 1=1 ".$where."";
		//echo $sql_pagination;
    	$row = mysql_fetch_array(mysql_query($sql_pagination));
    	$total = $row['num'];
		if($total>0){
		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit =5;
    	$per_page=5;
    	$startpoint = ($page * $limit) - $limit;
		$url = '?olay_tip='.$olay_tip.'&olay_tip_id='.$olay_tip_id.'&anahtar_kelime=&';
   
            //show records
            $sql_olay="SELECT o.olay_id,o.baslik,  SUBSTRING(o.icerik , 1, 200)  icerik ,o.anahtar_kelimeler,o.eklenme_tarihi,u.ad,u.soyad,u.sicilno
	  				FROM olaylar o LEFT JOIN uyeler u on u.sicilno=o.kisi_id
	  				WHERE 1=1 ".$where." ORDER BY olay_id DESC LIMIT {$startpoint} , {$limit} ";
            $result= mysql_query($sql_olay,$link);
           //echo $sql_olay;
        
            $class="a";
            echo ' <div style="width:100%;height:651px;border:0px;overflow:auto;"> ';
            echo '<table class="olay_listesi"><tbody>';
			$img_guncelle="";
            
        	while ($row = mysql_fetch_assoc($result,MYSQL_BOTH)) {
       		$sql_ekler="SELECT COUNT(*) as `num` FROM olay_dokumanlar where olay_id=".$row['olay_id']."";
       		$row_ek = mysql_fetch_array(mysql_query($sql_ekler));
       		if($row_ek["num"]==0){
       			$ekcount="";
       		}
       		else{
       			$ekcount="</br>Ek Sayısı: ".$row_ek["num"];
       		}
       		
       	
			echo '<tr class="'.$class.' "> <td  title="Detay için tıklayın.." onclick="open_popup(\'olay_detay.php?oid='.$row['olay_id'].'\')" style="cursor:hand;cursor:pointer;" class="'.$class.' baslik">'.$row['baslik'].'</td><td class="'.$class.' eklenmetarihi">'.$row['eklenme_tarihi'].' <span  style="cursor:hand;cursor:pointer;" class="olay_ozet" onclick="open_popup(\'olay_guncelle_form.php?oid='.$row['olay_id'].'\')" >
			';
        	if( isset($_SESSION['login']))
			{
				if($_SESSION['sicilno']==$row["sicilno"]||$_SESSION['login_yetki']=="1")
				{
					$img_guncelle='<img title="Güncelle" src="../images/update.png"/>';
				}
			}			
			echo $img_guncelle.'</span></td></td></tr>
            <tr class="'.$class.' "><td title="Detay için tıklayın.." onclick="open_popup(\'olay_detay.php?oid='.$row['olay_id'].'\')"  class="'.$class.' icerik" style="cursor:hand;cursor:pointer;">'.$row['icerik'].'... </td><td class="'.$class.' icerik"></td></tr>
            <tr class="'.$class.'"><td title="Anahtar Kelimeler ve Ekler" class="'.$class.' anahtarkelime">Anahtar Kelimeler : '.$row['anahtar_kelimeler'].$ekcount.'</td><td class="'.$class.' kisi">'.$row['ad'].' '.$row['soyad'].'</td></tr>';      
//           	if($class=="odd")
//			{
//				$class="even";
//			}
//			else{
//				$class="odd";
//			}
//           	
       }
            echo "</tbody></table></div>";
		
        $adjacents = "4"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination'>";
                    $pagination .= "<li class='details'>Sayfa $page / $lastpage</li>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li><a class='current'>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>...</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>..</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>..</li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}page=$next'>İleri</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>Son</a></li>";
    		}else{
    			$pagination.= "<li><a class='current'>İleri</a></li>";
                $pagination.= "<li><a class='current'>Son</a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    

		echo $pagination;


		}
		else{
			echo "Aranılan Kriterlere Uygun Sonuç Bulunumadı!";
		}











include '../db/mysql_baglanma.php';
ob_end_flush();
?>