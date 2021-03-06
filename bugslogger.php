<?php

$referer   = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : 'Unspecified';
$useragent = getenv('HTTP_USER_AGENT');

if (strstr($useragent, 'Win'))
	$os = 'Windows';
else if ((strstr($useragent, 'Mac')) || (strstr($useragent, 'PPC')))
	$os = 'Mac';
else if (strstr($useragent, 'Linux'))
	$os = 'Linux';
else if (strstr($useragent, 'FreeBSD'))
	$os = 'FreeBSD';
else if (strstr($useragent, 'SunOS'))
	$os = 'SunOS';
else if (strstr($useragent, 'IRIX'))
	$os = 'IRIX';
else if (strstr($useragent, 'BeOS'))
	$os = 'BeOS';
else if (strstr($useragent, 'OS/2'))
	$os = 'OS/2';
else if (strstr($useragent, 'AIX'))
	$os = 'AIX';
else
	$os = 'Unknown';

$fp = fopen('logs.txt', 'a');

fwrite($fp, '+-[' . date('l jS \of F Y h:i:s A') . ']');
fwrite($fp, "\r\n");
fwrite($fp, '|');
fwrite($fp, "\r\n");
fwrite($fp, '|IP.................: ' . htmlentities($_SERVER['REMOTE_ADDR']));
fwrite($fp, "\r\n");
fwrite($fp, '|User-Agent.........: ' . $useragent);
fwrite($fp, "\r\n");
fwrite($fp, '|OS.................: ' . $os);
fwrite($fp, "\r\n");
fwrite($fp, '|URi.Bugged.........: ' . htmlentities($_SERVER['REQUEST_URI']));
fwrite($fp, "\r\n");
fwrite($fp, '|Variable.Bugged....: ' . htmlentities($_SERVER['QUERY_STRING']));
fwrite($fp, "\r\n");
fwrite($fp, '|Accept-Language....: ' . htmlentities($_SERVER['HTTP_ACCEPT_LANGUAGE']));
fwrite($fp, "\r\n");
fwrite($fp, '|Port...............: ' . htmlentities($_SERVER['REMOTE_PORT']));
fwrite($fp, "\r\n");
fwrite($fp, '|Referer............: ' . htmlspecialchars($referer));
fwrite($fp, "\r\n");
fwrite($fp, '+----------------------------------------------------------------------------------');
fwrite($fp, "\r\n");
fclose($fp);

$Redirect = 3;
echo <<< EOT
							<script src="js/jquery.js"></script>
							<script language="javascript">
							var max_time = 5;
							var cinterval;
 
							function countdown_timer(){
							  // decrease timer
							  max_time--;
 							 document.getElementById('countdown').innerHTML = max_time;
 							 if(max_time == 0){
 							   clearInterval(cinterval);
								window.location.assign("index.php")
 							 }
							}
							// 1,000 means 1 second.
							cinterval = setInterval('countdown_timer()', 1000);
							</script>
EOT;

echo ('<p>Terdapat kendala, Anda akan dialihkan ke halaman utama.</p>');
echo ('<p>Kami sudah mencatat IP Anda dan data keterangan di momen Anda mengalami kendala agar dapat mengetahui titik masalahnya.<br />');
echo ('Anda akan otomatis dialihkan ke halaman utama dalam <span id="countdown">5</span> detik.<br />');
echo ('<center>Jika tidak, klik <a href="index.php">di sini</a></p></center><br>');
?>