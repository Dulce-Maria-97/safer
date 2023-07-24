<?php
require_once("../class/safer.class.php");
$id = $_POST['id'];
$edo= $_POST['est'];
$obj=new Safer();

if($obj->conecta())
{
	if($obj->estadoUsuario($id, $edo))
		echo 1;
	else
		echo 0;
}
//botosn de estado 		