<?php
@session_start();
require_once("../class/safer.class.php");
$id = $_POST['id'];
$edo= $_POST['est'];
$user = $_SESSION["usuario"];

$obj=new Safer();

if($obj->conecta())
{	
	$a = $obj->autorizaObservacion($id, $user);
	$b = $obj->estadoObservacion($id, $edo);
	
	if($a && $b)
		echo 1;
	else
		echo 0;
}
//botosn de estado 		