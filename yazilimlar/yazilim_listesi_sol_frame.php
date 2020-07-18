<div id="sol_frame">
<p class="baslik_blue">Yazılım Türleri</p>

<table class="sol_frame"  summary="Sunucu Detay Bilgileri">

 <tbody>
 <?php if(isset($_GET['t']) and $_GET['t']==7){
 ?>
 <tr class="odd selected"><td class="odd selected"><a href="#" id="index2.php?s=y_l&t=7">Paket Yazılımlar</a></td></tr>
 <?php  }
 else{?>
 <tr class="odd"><td class="odd"><a href="#" id="index2.php?s=y_l&t=7">Paket Yazılımlar</a></td></tr>
 <?php }
 ?>
 
  <?php if(isset($_GET['t']) and $_GET['t']==6){
 ?>
 <tr class="even selected"><td class="even selected"><a href="#" id="index2.php?s=y_l&t=6">Kurumsal Yazılımlar</a></td></tr>
 <?php  }
 else{?>
 <tr class="even"><td class="even"><a href="#" id="index2.php?s=y_l&t=6">Kurumsal Yazılımlar</a></td></tr>
 <?php }
 ?>
 
  <?php if(isset($_GET['t']) and $_GET['t']==1){
 ?>
 <tr class="odd selected"><td class="odd selected"><a href="#" id="index2.php?s=s_l&t=5">Firma Yazılımlar</a></td></tr>
 <?php  }
 else{?>
  <tr class="odd"><td class="odd"><a href="#" id="index2.php?s=y_l&t=5">Firma Yazılımlar</a></td></tr>
 <?php }
 ?>
 <tr class="even"><td class="even"><a href="#" id="index2.php?s=y_l">Tüm Yazılımlar</a></td></tr>
</tbody></table>

</div>
