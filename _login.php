<?php
require("cab.php");
$l = new login;

require($include.'_class_form.php');
echo '<link rel="STYLESHEET" type="text/css" href="css/sisdoc_login.css">';

require($include.'sisdoc_debug.php');

echo '<center>';
echo '<table class="tabela00">';
echo '<TR valign="top">';
/* Logo */
echo '<TD width="150">';
echo '<BR><BR><BR>';
echo '<img src="img/logo_mini.png">';
echo '<TD>';
echo '<h1>Login</h1>';
echo $l->login_form();
echo '</table>';
?>
