<?php
$serverName = "DESKTOP-K30L4S0\SQLEXPRESS";
$connectionInfo = array( "Database"=>"SAFERMANY", "UID"=>"safer", "PWD"=>"1234", "CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Conexión establecida.<br/>";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>