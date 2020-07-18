
<div id="sol_frame">
<p class="baslik_blue">Sunucu Türleri</p>

<table class="sol_frame"  summary="Sunucu Detay Bilgileri">

 <tbody>
 <?php if(isset($_GET['t']) and $_GET['t']==3){
 ?>
 <tr class="odd selected"><td class="odd selected"><a href="#" id="index2.php?s=s_l&t=3">Fiziksel Sunucular</a></td></tr>
 <?php  }
 else{?>
 <tr class="odd"><td class="odd"><a href="#" id="index2.php?s=s_l&t=3">Fiziksel Sunucular</a></td></tr>
 <?php }
 ?>
 
  <?php if(isset($_GET['t']) and $_GET['t']==2){
 ?>
 <tr class="even selected"><td class="even selected"><a href="#" id="index2.php?s=s_l&t=2">Sanal Sunucular</a></td></tr>
 <?php  }
 else{?>
 <tr class="even"><td class="even"><a href="#" id="index2.php?s=s_l&t=2">Sanal Sunucular</a></td></tr>
 <?php }
 ?>
 
  <?php if(isset($_GET['t']) and $_GET['t']==1){
 ?>
 <tr class="odd selected"><td class="odd selected"><a href="#" id="index2.php?s=s_l&t=1">Sanallaştırma Sunucuları</a></td></tr>
 <?php  }
 else{?>
  <tr class="odd"><td class="odd"><a href="#" id="index2.php?s=s_l&t=1">Sanallaştırma Sunucuları</a></td></tr>
 <?php }
 ?>
 <tr class="even"><td class="even"><a href="#" id="index2.php?s=s_l">Tüm Sunucular</a></td></tr>
</tbody></table>

</div>

