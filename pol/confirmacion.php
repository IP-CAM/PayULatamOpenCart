<?php
require_once('../config.php');
$mensajeLog = "\n\n";
$debug_mode = false;

if($debug_mode) $mensajeLog.="debug:[".date("Y-m-d H:i:s")."] Iniciando debug_mode\n";
if (!$link = @mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD)) {
	$mensajeLog .= "[".date("Y-m-d H:i:s")."] Error al conectar la base de datos - ".mysql_error()."\n";
} else {
	if (!@mysql_select_db(DB_DATABASE, $link)) {
		$mensajeLog .= "[".date("Y-m-d H:i:s")."] Error al conectar la base de datos - ".mysql_error()."\n";
	}
}

if($link){
    if($debug_mode) $mensajeLog.="debug:[".date("Y-m-d H:i:s")."] Conectado a la base de datos\n";

foreach ($_REQUEST as $key => $value) {
    $mensajeLog.= "\n".$key."\t".' => '."\t" .$value."\n".'-------------------------';
}


$usuarioId = $_REQUEST['merchant_id']; 
$fecha = date("d.m.Y-H:i:s"); 
$refVenta = $_REQUEST['extra2']; 
$refPol = $_REQUEST['ref_pol']; 
$estadoPol = $_REQUEST['state_pol']; 
$formaPago = $_REQUEST['payment_method_id']; 
$banco = $_REQUEST['bank_id']; 
$codigo = $_REQUEST['response_code_pol']; 
$valor = $_REQUEST['value'];


    $sql_query ='SELECT order_status_id FROM '.DB_PREFIX.'order_status os WHERE LCASE(os.name) IN ("canceled","rejected","approved") ORDER BY os.name limit 3';
    $consulta_order_status = mysql_query($sql_query, $link);
    $order_status = array();
    //orden A, C, R
    if($consulta_order_status){
        $i = 0;
        while($Tab = mysql_fetch_assoc($consulta_order_status)){
            $order_status[$i]= $Tab["order_status_id"];
            $i++;
        }
        $order_status_id;
        switch($estadoPol){
            case 4: //Aprobada
                $order_status_id = $order_status[0];
            break;
            case 5: //Cancelada
                $order_status_id = $order_status[1];
            break;
            case 6: //Rechazada
                $order_status_id = $order_status[2];
            break;
        }
        $sql_query = 'UPDATE '.DB_DATABASE.'.'.DB_PREFIX.'order SET order_status_id = '.$order_status_id.' WHERE order_id ='.$refVenta;

        $mensajeLog.=$sql_query;

        if(mysql_query($sql_query,$link)){           
            if($estadoPol!=4){
                //descuento del inventario
                $sql_query ='SELECT product_id, quantity FROM '.DB_PREFIX.'order_product op WHERE order_id='.$refVenta;
                $consulta_order_product = mysql_query($sql_query,$link);
                if($consulta_order_product){
                    $i = 0;
                    $sql_update_pro = array();
                    while($Tab = mysql_fetch_assoc($consulta_order_product)){
                        $sql_query = 'UPDATE '.DB_PREFIX.'product SET quantity=quantity+'.$Tab["quantity"].' WHERE product_id = '.$Tab["product_id"];
                        $sql_update_pro[$i]=$sql_query;
                        $i++;
                    }
                    echo count($sql_update_pro);
                    for($i = 0 ; $i<count($sql_update_pro);$i++){
                        if(!mysql_query($sql_update_pro[$i],$link)){
                            $mensajeLog.="[".date("Y-m-d H:i:s")."] Error al ejecutar el query (".$sql_query.") la base de datos - ".mysql_error()."\n";
                            break;
                        }
                    }
                }else{                    
                    $mensajeLog.="[".date("Y-m-d H:i:s")."] Error al ejecutar el query (".$sql_query.") la base de datos - ".mysql_error()."\n";
                }
            }
        }else{
            $mensajeLog.="[".date("Y-m-d H:i:s")."] Error al ejecutar el query (".$sql_query.") la base de datos - ".mysql_error()."\n";
        }
    }else{
        $mensajeLog.="[".date("Y-m-d H:i:s")."] Error al ejecutar el query (".$sql_query.") la base de datos - ".mysql_error()."\n";
    }
    

	
if(strlen($mensajeLog)>0){     
    $server_root =  str_replace("catalog", "pol", DIR_APPLICATION);

$filename = $server_root."/confirmacion.txt";
$fp = fopen($filename, "a"); 
if($fp) { fwrite($fp, $mensajeLog, strlen($mensajeLog)); 
fclose($fp); 
} 
}

}//$link
?> 