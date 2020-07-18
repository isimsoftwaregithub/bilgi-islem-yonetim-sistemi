<?php
?>
<script>
	 $(document).ready(function(){
			
			$('#login').on('submit', function(e)
				    {
			    		//alert("Alert");
	    				if( $('#uemail').val()=="" ||$('#uemail').val()=="Sicil No")
	    				{
		    				alert("Kullanıcı Adınızı Girmediniz !...");
		    				 return false;
	    				}
	    				if(  $('#upw').val()=="")
	    				{
		    				alert("Şifrenizini Girmediniz !...");
		    				 return false;
	    				}

				       
					});

	
	 		  
});
		
		



		    
		 
</script>
<div id="theForm">
	 	<form id="login" name="form1" method="post" action="login/login.php" >
	 	<table class="login_form"><tr><td class="giris">Giriş / Şifre</td><td><input name="uemail" type="text" id="uemail" maxlength="50" size="15" value="Sicil No" onblur="if (this.value == '') {this.value = 'Sicil No';}" onfocus="javascript:if(this.value=='Sicil No') this.value='';"/></td>
	 	<td><input name="upw" type="password" id="upw" maxlength="8" size="6" placeholder="Şifre" value="1" />
	 	</td>
	 	<td><button type="submit" id="login_button">giriş</button></td>
	 	
	 	</tr></table>
				
			
		
		</form>
		<div id="login_out"></div>
	</div>	


  