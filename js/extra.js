		function highLight(){
				document.getElementById('login').style.background ='#fff';
				document.getElementById('login').style.border ='1px solid #a30b1a';
				document.getElementById('login').style.color="#a30b1a"
					document.getElementById('button').style.color="#a30b1a"
				self.scrollTo(0,1);
				}
		
		

		function toggle(obj) {

			var el = document.getElementById(obj);


			if ( el.style.display != 'none' ) {

				el.style.display = 'none';

			}

			else {

				el.style.display = '';

			}

		}
		
		function isnumber()	
		{		
			if(!(event.keyCode==45||event.keyCode==48||event.keyCode==49||
			event.keyCode==50||event.keyCode==51||event.keyCode==52||event.keyCode==53||
			event.keyCode==54||event.keyCode==55||event.keyCode==56||event.keyCode==57))		
			{			event.returnValue=false;		}	
			}