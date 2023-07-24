<?php
	require("class/safer.class.php");
	$obj = new Safer();
	if ($obj->conecta()){
		echo "conecta";
	}else{
		echo "error";
	}
?>