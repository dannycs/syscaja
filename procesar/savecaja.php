<?php

include("../model/config.php");

//*RECIBIR DATOS
$codigo=$_POST["codigo"];
$descripcion=$_POST["vdescripcion"];
$banco=$_POST["vbanco"];
$cuenta=$_POST["vcuenta"];
$tipo=$_POST["vtipo"];
$saldo=$_POST["vsaldo"];
$capital=$_POST["vcapital"];

//!VALIDANDO SI ES GUARDAR O ACTUALIZAR
$sql="";
if($codigo>0){
    $sql="UPDATE caja SET descripcion='$descripcion',
                           banco='$banco',
                           ceunta='$cuenta',
                           tipomoneda='$tipo',
                           saldo_anterior=$saldo,
                           inicio_capital=$capital
                    WHERE idcaja=$codigo";
}
else{
    $sql="INSERT INTO caja(descripcion, banco, cuenta, tipomoneda, saldo_anterior, inicio_capital)";
}
?>