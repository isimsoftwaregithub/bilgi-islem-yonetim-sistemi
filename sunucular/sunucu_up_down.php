<script type="text/javascript">

$(document).ready(function(){
	
//	$('#refresh').click(function (){
//	
//		$('#table').each(function(index) {
//			//alert("asdsa");
//		    $(this).find('div').each(function() {
//
//			    //alert ($(this).attr("id"));
//			    var id=$(this).attr("id");
//			    var title=$(this).attr("title");
//				$("#"+id).empty().html('<img src="images/16x16.gif" /><br />');
//			    $("#"+id).load('sunucular/sunucu_ping.php?ip='+title)
//			  	
//		    });
//		});
//	});
//
//	
	$('#table').each(function() {
		//alert("asdsa");
	    $(this).find('span').each(function() {

		    //alert ($(this).attr("id"));
		    var id=$(this).attr('id');
		    var ip=$(this).attr('name');
			$("#"+id).empty().html('<img src="images/16x16.gif" /><br />');
		    $("#"+id).load('sunucular/sunucu_ping.php?ip='+ip)
		   
			    
	    });
	});



	
//	var auto_refresh = setInterval(
//			function()
//			{
//				$('#table').each(function(index) {
//					//alert("asdsa");
//				    $(this).find('div').each(function() {
//
//					    //alert ($(this).attr("id"));
//					    var id=$(this).attr("id");
//					    var title=$(this).attr("title");
//						$("#"+id).empty().html('<img src="images/16x16.gif" /><br />');
//					    $("#"+id).load('sunucular/sunucu_ping.php?ip='+title)
//					  	
//				    });
//				});
//			}, interval1);
//	var auto_refresh = setInterval(
//			function()
//			{
//				window.location = "/";
//			}, interval2);



	
});



</script>


<?php
ob_start();
include 'db/mysql_baglan.php';

$sql_sunucu_ip="SELECT sunucuID,sunucu,ip_adresi1 FROM sunucular where aktif=1";

$result=mysql_query($sql_sunucu_ip);

?>
<div id="sunucu_updown">
<p class="baslik_blue">Sunucu Erişilebilirliği <img src="images/green.png" title="on" style="margin-left:3px" width="12px;"><span id="green"> </span> <img title="of" src="images/red.png" style="margin-left:3px" width="12px;"><span id="red"> </span> <img title="IP Bilgisi Eksik" src="images/yellow.png" style="margin-left:3px" width="12px;"><span id="yellow"> </span> <span id="refresh" style="cursor:pointer;text-decoration:underline;margin-left:550px;"><img src="images/refresh.png" title="refresh"/></span>
</p>
<div id="flow98" class="sl">
 

<table class="sunucuupdown" id="table">
<?php 
while($row=mysql_fetch_array($result))
{
	
	echo '<tr> <td class="s">'.$row['sunucu'].'</td><td class="ip">'.$row['ip_adresi1'].'</td><td class="st"><span id="'.$row['sunucuID'].'" name="'.$row['ip_adresi1'].'"></span></td><td class="sp"></td>';
	$row=mysql_fetch_array($result);
	echo '<td class="sp"></td>';
	echo '<td class="s">'.$row['sunucu'].'</td><td class="ip">'.$row['ip_adresi1'].'</td><td class="st"><span id="'.$row['sunucuID'].'" name="'.$row['ip_adresi1'].'"></span></td>';
	
	echo '</tr>';
}

?>
</table>
</div>

</div>

<?php 

include 'db/mysql_baglanma.php';
ob_end_flush();
