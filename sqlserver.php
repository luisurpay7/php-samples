<?php

class Cconexion{

    public static function ConexionBD(){

        $host='10.1.2.39';
        $dbname='PE_WINET_CRM_PROD_20240105_081647';
        $username='PE_OPTICAL_ERP';
        $pasword ='Optical123+';
        $puerto=1433;


        try{
            $conn = new PDO ("sqlsrv:Server=$host,$puerto;Database=$dbname",$username,$pasword);
            echo "Se conectó correctamen a la base de datos";
        }
        catch(PDOException $exp){
            echo ("No se logró conectar correctamente con la base de datos: $dbname, error: $exp");
        }

        return $conn;
    }

}

Cconexion::ConexionBD();

?>