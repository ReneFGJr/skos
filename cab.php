<?php
require("db.php");
require("_class/_class_header.php");
$hd = new header;

$title = 'Thesaurus - Skos Tools';
$tile = '<IMG SRC="img/logo_thesaurus_tools.png" align="left" height="50">';
$tile .= $title;
$hd->title = $title;
$hd->cab_info = '<div id="cab"><h1>'.$tile.'</h1></div>';

echo $hd->head();
echo $hd->cab();
echo '<div id="content">';
require("_class/_class_login.php");
$us = new login;

$sc = round($us->security());

$page = page();
if ($sc != 1)
	{
		if (!($page == '_login.php'))
			{
				redirecina($http."_login.php");
			}
	}
?>

