

				 <div class="login" id="login">
							 <?php
						        session_start();
						        $yetki=999;
								if( isset($_SESSION['login']) ) 
								{
									$login=true;
									$yetki=$_SESSION['login_yetki'];
									$sicilid=$_SESSION['sicilno'];
									include 'login/logout_form.php';
								}
								else
								{		
									$login=false;
						        	include 'login/login_form.php';
								}
						     ?>
				</div>
			
			 <div class="logo">
    		 	<img src="images/met.png" style="width:400px; height: 65px;" />
    		 	
    		 </div>
    		 
    		 <div class="sube">Firma Veri İşlem Dairesi Başkanlığı<br/>
    		 	Bilgi İşlem Şube Müdürlüğü</div>
		
			 
<script type="text/javascript" >
$(document).ready(function(){
	
	$(".cnt").load("index2.php?s=i");
	
	 $("#menu").find('a').click(function(){
		 var id = $(this).attr("id");
		 $(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
		 $(".cnt").load(id);
		});
		 

});
</script>



<ul id="menu">
    <li><a href="javascript:void(0)" id="index2.php?s=i" class="drop">Ana Sayfa</a><!-- Begin Home Item --><!--
        <div class="dropdown_2columns"> Begin 2 columns container 
    
            <div class="col_2">
                <h2>Bilgi İşlem Şube Müdürlüğü</h2>
            </div>
    
            <div class="col_2">
                <p>Bilgi Yönetim Portalı</p>             
            <?php if (!$login)
            {
    			echo "<p>Detaylı Bilgiye Erişmek İçin Giriş Yapınız.</p>";
    		}
    		
    		?></div>
            <div class="col_2">
                <h2>Cross Browser Support</h2>
            </div>
            
            <div class="col_1">
                <img src="img/browsers.png" style="width: 125px; height: 48px;" alt="" />
            </div>
            
            <div class="col_1">
                <p>This mega menu has been tested in all major browsers.</p>
            </div>
          
        </div> End 2 columns container 
    --></li>
    
<?php   if( $login ) 
   {?>
   	
       <li><span  class="drop">Raporlar</span><!-- Begin 4 columns Item -->
        <div class="dropdown_2columns"><!-- Begin 4 columns container -->
        
        	
         <div class="col_2">
                <h2></h2>
            </div>
            
            <div class="col_1">
            	 <ul>
            	     <li><a href="#" id="index2.php?s=s_r" title="Tüm Sunucuların Raporu"><img src="images/arr4.png" width="12px" height="12px"/> Tüm Sunucular</a></li>      
            	 	<li><a href="#" id="index2.php?s=s_r&t=3" title="Fiziksel Sunucu Raporu"><img src="images/arr4.png" width="12px" height="12px"/> Fiziksel Sunucular</a></li>
                  	<li><a href="#" id="index2.php?s=s_r&t=2" title="Sanal Sunucu Raporu"><img src="images/arr4.png" width="12px" height="12px"/> Sanal Sunucular</a></li>
                  	<li><a href="#" id="index2.php?s=s_r&t=1" title="Sanallaştırma Sunucusu Raporu"><img src="images/arr4.png" width="12px" height="12px"/> Sanallaştırma Sunucuları</a></li> 
            	 
                  </ul>   
            </div>
      
	    	 <div class="col_1">
            	 <ul>
            	 	
            	 
	               <li><a href="#" id="index2.php?s=vt_r" title="Veritanı Raporu"><img src="images/arr4.png" width="12px" height="12px"/> Veritabanları</a></li>  
	               <li><a href="#" id="index2.php?s=ae_r" title="Ağ Elemanları Raporu"><img src="images/arr4.png" width="12px" height="12px"/> Ağ Elamanları</a></li>
                  </ul>   
            </div>
            
        </div><!-- End 4 columns container -->
    </li><!-- End 4 columns Item -->
   
    <li><span  class="drop">Sunucular</span><!-- Begin 4 columns Item -->
        <div class="dropdown_2columns"><!-- Begin 4 columns container -->
        
        	
         <div class="col_2">
                <h2></h2>
            </div>
            
            <div class="col_1">
            	 <ul>
            	                   	<li><a href="#" id="index2.php?s=s_l" title="Tüm Sunucuları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Tüm Sunucular</a></li>      
            	 
                  	<li><a href="#" id="index2.php?s=s_l&t=3" title="Fiziksel Sunucuları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Fiziksel Sunucular</a></li>
                  	<li><a href="#" id="index2.php?s=s_l&t=2" title="Sanal Sunucuları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Sanal Sunucular</a></li>
                  	<li><a href="#" id="index2.php?s=s_l&t=1" title="Sanallaştırma Sunucularını Listele"><img src="images/arr4.png" width="12px" height="12px"/> Sanallaştırma Sunucuları</a></li> 
                  </ul>   

            </div>
            
               <div class="col_1">
               <?php if($yetki==1){?>
            	 <ul>
                  	<li><a href="#" id="index2.php?s=s_e" title="Yeni Sunucu Ekle"><img src="images/ac.png" width="12px" height="12px"/> Sunucu Ekle</a></li>
                  	<li><a href="#" id="index2.php?s=s_ud" title="Sunucu Erişilebilirliği"><img src="images/arr4.png" width="12px" height="12px"/> Sunucu Erişilebilirliği</a></li>
                  	
                  </ul>   
				<?php }?>
            </div>
     
            
	    	
            
        </div><!-- End 4 columns container -->
    </li><!-- End 4 columns Item -->
    <li><span  class="drop" title="Sunucular Dışındaki Tüm Donanımlar">Donanımlar</span><!-- Begin 4 columns Item -->
        <div class="dropdown_2columns"><!-- Begin 4 columns container -->
          <div class="col_2">
                <h2></h2>
            </div>
        	<div class="col_1">
            	 <ul>
                  	<li><a href="#" id="index2.php?s=d_l" title="Depolama Unitlerini Listele"><img src="images/arr4.png" width="12px" height="12px"/> Depolama Uniteleri</a></li>
                  	<li><a href="#" id="index2.php?s=gd_l" title="Güvenlik Donanımlarını Listele"><img src="images/arr4.png" width="12px" height="12px"/> Güvenlik Donanımı</a></li>
                  	<li><a href="#" id="index2.php?s=a_e" title="Ağ Elemanlarını Listele" ><img src="images/arr4.png" width="12px" height="12px"/> Ağ Elemanları</a></li> 
                  	<li><a href="#" id="index2.php?s=a_ep" title="Ağ Elemanları Port Bilgilerini Listele"><img src="images/arr4.png" width="12px" height="12px"/> Ağ Elemanı Port Bilgileri</a></li> 
                  </ul>   

            </div>
            
               <div class="col_1">
                <?php if($yetki==1){?>
            	 <ul>
                  	<li><a href="#" id="index2.php?s=du_e" title="Depolama Unitesi Ekle"><img src="images/ac.png" width="12px" height="12px"/> Depolama Unitesi Ekle</a></li>
                  	<li><a href="#" id="index2.php?s=gd_e" title="Güvenlik Donanımı Ekle"><img src="images/ac.png" width="12px" height="12px"/> Güvenlik Donanımı Ekle</a></li>
                  	<li><a href="#" id="index2.php?s=ya_e" title="Ağ Elemanı Ekle"><img src="images/ac.png" width="12px" height="12px"/> Ağ Elemanı Ekle</a></li>
                  </ul>   
				<?php }?>
            </div>
                        
	  </div>
    </li>
    
    
     <li><span  class="drop">Veritabanları</span><!-- Begin 3 columns Item -->
        <div class="dropdown_2columns 	"><!-- Begin 3 columns container -->
            
            <div class="col_2">
                <h2></h2>
            </div>
            
            <div class="col_1">
    
                <ul class="">
                    <li><a href="#" id="index2.php?s=vt_l" class="drop" title="Veri Tabanlarını Listele"><img src="images/arr4.png" width="12px" height="12px"/> Veritabanları</a></li>
                   </ul>   
    
            </div>
              
            <div class="col_1">
    			 <?php if($yetki==1){?>
                <ul class="">
       
                    <li><a href="#" id="index2.php?s=vt_e" class="drop" title="Veritabanı Ekle"><img src="images/ac.png" width="12px" height="12px"/> Veritabanı Ekle</a></li>
                   
                   
                </ul>   
    		<?php }?>
            </div>
     
        
        </div><!-- End 3 columns container -->
    </li><!-- End 3 columns Item -->
    
	<li><span  class="drop">Yazılımlar</span><!-- Begin Home Item -->
        <div class="dropdown_2columns">
            <div class="col_2">
                <h2></h2>
            </div> 
            <div class="col_1">
                <ul>
                <li><a href="#" id="index2.php?s=y_l&t=7" class="drop" title="Paket Yazılımları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Paket Yazılımlar</a></li>
                <li><a href="#" id="index2.php?s=y_l&t=6" class="drop" title="Kurumsal Yazılımları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Kurumsal Yazılımlar</a></li>
                <li><a href="#" id="index2.php?s=y_l&t=5" class="drop" title="Firma Yazılımları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Firma Yazılımlar</a></li>
                 <li><a href="#" id="index2.php?s=y_l" class="drop" title="Tüm Yazılımları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Tüm Yazılımlar</a></li>
                </ul>
            </div>
     		<div class="col_1">
     		 <?php if($yetki==1){?>
                <ul>
                <li><a href="#" id="index2.php?s=y_e" class="drop" title="Yazılım Ekle"><img src="images/ac.png" width="12px" height="12px"/> Yazılım Ekle</a></li>
                </ul>
                <?php  }?>
            </div>
        
          
        </div><!-- End 2 columns container -->
    </li>  
    <li><span  class="drop">Olaylar</span><!-- Begin Home Item -->
        <div class="dropdown_2columns"><!-- Begin 2 columns container -->
    		<div class="col_2">
                <h2></h2>
            </div>
    
            <div class="col_1">
            <ul>
               <li><a href="#" id="index2.php?s=o_g" title="Tüm Olayları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Tüm Olaylar</a></li>   
               <li><a href="#" id="index2.php?s=o_g&olay_tip_ara=1" title="Sunucu Olayları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Sunucu Olayları</a></li>
               <li><a href="#" id="index2.php?s=o_g&olay_tip_ara=2" title="Veritabanı Olayları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Veritabanı Olayları</a></li>       
               <li><a href="#" id="index2.php?s=o_g&olay_tip_ara=3" title="Depolama Unitesi Olayları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Depolama Unitesi Olayları</a></li>       
               <li><a href="#" id="index2.php?s=o_g&olay_tip_ara=4" title="Ağ Elemanı Olayları Listele"><img src="images/arr4.png" width="12px" height="12px"/> Ağ Elemanı Olayları</a></li>       
   
                 
                 
			</ul>  
    

            </div>
    
       <div class="col_1">
            <ul>
               <li><a href="#" id="index2.php?s=o_e" title="Olay (event,hata,promlem,çözüm) Ekle"><img src="images/ac.png" width="12px" height="12px"/> Yeni Olay Ekle</a></li>
			</ul>  

            </div>
   
          
        </div><!-- End 2 columns container -->
    </li>  
    


      

      <?php if($yetki==1){?>
         <li><span  class="drop">VCenter Raporlar</span><!-- Begin Home Item -->
        <div class="dropdown_1column"><!-- Begin 2 columns container -->
    		<div class="col_1">
                <h2></h2>
            </div>
    
            <div class="col_1">
            <ul>
          		<li><a href="#" id="index2.php?s=vc_s" title="Sanallaştırma Ortamı"><img src="images/arr4.png" width="12px" height="12px"/> Sanal Sunucular</a></li>
          		  <?php if($sicilid==2171 or $sicilid==3459){?>
          		<li><a href="#" id="index2.php?s=ga_s" title="VCenter Veritabanıyla Senkronize Et."><img src="images/arr4.png" width="12px" height="12px"/> Senkronize</a></li>
          		<?php }?>
			</ul>  
    

            </div>
    	
      
        </div><!-- End 2 columns container -->
    </li> 
      <?php  }?>
           <li><span  class="drop">Diğer</span><!-- Begin Home Item -->
        <div class="dropdown_2columns"><!-- Begin 2 columns container -->
    		<div class="col_2">
                <h2></h2>
            </div>
    
            <div class="col_1">
            <ul>
            <li><a href="#" id="index2.php?s=p_g2&uid=<?php echo $_SESSION['sicilno']?>"><img src="images/arr4.png" width="12px" height="12px"/> Bilgilerim</a></li>      
               <li><a href="#" id="index2.php?s=p_l" title="Çalışan Personel Listesi"><img src="images/arr4.png" width="12px" height="12px"/> Personel Listesi</a></li>     
			</ul>  
    

            </div>
    	<div class="col_1">
    	<ul>
     		 <?php if($yetki==1){?>
                
                <li><a href="#" id="index2.php?s=p_e" class="drop" title="Personel Ekle"><img src="images/user_add2.png" width="9px" height="9px"/> Personel Ekle</a></li>
                 <li><a href="#" id="index2.php?s=f_e" class="drop" title="Firma Ekle"><img src="images/ac.png" width="9px" height="9px"/> Firma Ekle</a></li>
                  <li><a href="#" id="index2.php?s=fc_e" class="drop" title="Firma Çalışanı Ekle"><img src="images/ac.png" width="9px" height="9px"/> Firma Çalışanı Ekle</a></li>
                 
                <?php  }?>
       </ul>
            </div>
      
        </div><!-- End 2 columns container -->
    </li>
    
         <?php if($yetki==1){?>
         <li><span  class="drop">Arşiv</span><!-- Begin Home Item -->
        <div class="dropdown_2columns"><!-- Begin 2 columns container -->
    		<div class="col_2">
                <h2></h2>
            </div>
    
            <div class="col_1">
            <ul>
          
			<li><a href="#" id="index2.php?s=p_la" title="Ayrılan Personel Listesi"><img src="images/arr4.png" width="12px" height="12px"/> Ayrılan Personel Listesi</a></li>
			<li><a href="#" id="index2.php?s=s_la" title="Arşive Gönderilen Sunucular"><img src="images/arr4.png" width="12px" height="12px"/> Sunucular</a></li>
			<li><a href="#" id="index2.php?s=du_la" title="Arşive Gönderilen Depolama Uniteleri"><img src="images/arr4.png" width="12px" height="12px"/> Depolama Uniteleri</a></li>
			
		 
			</ul>  
    

            </div>
    	<div class="col_1">
    	<ul>
     		
                
               
                 
             
       </ul>
            </div>
      
        </div><!-- End 2 columns container -->
    </li> 
      <?php  }?> 
   <?php 

//   	echo '<li class="menu_right"><span class="drop">'.$_SESSION['uad'].' '.$_SESSION['usoyad'].'</span>
//				<div class="dropdown_1column"> <div class="col_1">
//                
//                    <ul >
//                        
//                        ';
//   				            
//                   echo ' </ul>   
//                     
//                </div>
//                
//		</div>
//	</li>';
   	
   }
   ?>
	
        
               
	
	
</ul>

