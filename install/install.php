<?php

@include('../config.php');

if (defined('CONFIG'))
{
?>

<h2><font color="red">Akses dilarang!</font></h2>
<p>Jika Anda andmin dan ingin meinstall ulang XRS, silakan <a href="../acp.php">Control Panel(Staff Only *)</a> lalu klik 'Unsinstall XRS'</p>

<?php
}

if (isset($_POST['team'], $_POST['accro'], $_POST['pass'], $_POST['path'], $_POST['dbhost'], $_POST['dbuser'], $_POST['dbpass'], $_POST['dbname']))
{
	$db_link = null;

	try
	{
		$db_link = new PDO('mysql:host=' . $_POST['dbhost'] . ';dbname=' . $_POST['dbname'], $_POST['dbuser'], $_POST['dbpass']);
	}
	catch (PDOException $e) {
		echo('<font color="red">Informasi Database ERROR! : ' . $e->getMessage() . '</font>');
	}

	if (!is_null($db_link))
	{
		$query = file_get_contents('install.sql');

		$db_link->query($query);

		function set_config($values) {
			$config = file_get_contents('config.tmp');

			foreach ($values as $key => $value)
				$config = str_replace('%' . $key . '%', addslashes($value), $config);

			return $config;
		}

		$config = set_config([
			'TEAM'    => $_POST['team'],
			'ACCRO'   => $_POST['accro'],
			'PASS'    => $_POST['pass'],
			'PATH'    => $_POST['path'],
			'DB_HOST' => $_POST['dbhost'],
			'DB_USER' => $_POST['dbuser'],
			'DB_PASS' => $_POST['dbpass'],
			'DB_NAME' => $_POST['dbname']
		]);

		file_put_contents('../config.php', $config);

		echo('<font color="green">Instalasi sudah selesai dan sukses!<br><a href="../index.php">Klik di sini</a> untuk ke tahap berikutnya.</font>');
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Setup</title>
	<script>
		window.onload = function() {
			var str = window.location.href;
			str = str.replace("install/install.php","");
			document.getElementById('path').value = str;
		}
	</script>
<style type="text/css">
<!--
body {
	background-color: #000000;
}
body,td,th {
	color: #FFFFFF;
}
-->
</style></head>
<body>
<?php $nbimages=7;

$nomimages[1]="xrs1.jpg";
$nomimages[2]="xrs2.jpg";
$nomimages[3]="xrs3.jpg";
$nomimages[4]="xrs4.jpg";
$nomimages[5]="xrs5.jpg";
$nomimages[6]="xrs6.jpg";
$nomimages[7]="xrs7.jpg";
srand((double)microtime()*1000000);
$affimage=rand(1,$nbimages);
?>
<center><form action="install.php" method="post"><table width="697" border="0">
  <tr>
    <td><center><img src="<?php echo $nomimages[$affimage]; ?>" border=0></center>

		<fieldset>
			<legend>Informasi Fansub</legend>
		<table width="450">
<tr>
				<td width="130">Nama Fansub : </td>
			  <td width="308"><input name="team" type="text" id="team" size="50" /></td>
			</tr>
			<tr>
				<td>Akronim Fansub : </td>
				<td><input name="accro" type="text" id="accro" size="50" /></td>
			</tr>
			<tr>
				<td>Password : </td>
				<td><input name="pass" type="password" id="pass" size="50" /></td>
			</tr>
			<tr>
				<td>Portal path : </td>
				<td><input name="path" type="text" id="path" size="50" /></td>
			</tr>
		</table>
		</fieldset>
		<fieldset>
			<legend>DataBase</legend>
		<table width="450">
	    <tr>
				<td width="128">Host </td>
			  <td width="310"><input name="dbhost" type="text" id="dbhost" value="localhost" size="50" /></td>
			</tr>
			<tr>
				<td>User : </td>
				<td><input name="dbuser" type="text" id="dbuser" size="50" /></td>
			</tr>
			<tr>
				<td>Password : </td>
				<td><input name="dbpass" type="password" id="dbpass" value="" size="50" /></td>
			</tr>
			<tr>
				<td>Database's Name : </td>
				<td><input name="dbname" type="text" id="dbname" size="50" /></td>
			</tr>
		</table>
		</fieldset>
		</td>
  </tr>
  <tr>
    <td><center><input value="Lanjut dan gaskan, Bosku!" type="submit" /></center></td>
  </tr>
</table></form>
</center>

</body>
</html>
