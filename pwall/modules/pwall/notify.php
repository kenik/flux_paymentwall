<?php
/*-------------------------------------
// PaymentWall addon Created by kenik
// This addon allows you to get
// donations for your server through
// PaymentWall system:
//     https://www.paymentwall.com/
---------------------------------------
// Contact:
// Email: kenik2006@gmail.com
// Hercules: http://herc.ws/board/user/9024-kenik/
// Skype: kenik2006
-------------------------------------*/
if (!defined('FLUX_ROOT')) exit;

require_once(Flux::config('PWallLibrary'));

$tablename = Flux::config('FluxTables.PWallLogTable');
$rate = Flux::config('PWallDonationRate');
$pwlog= new Flux_LogFile(Flux::config('PWallLogFile'));
Paymentwall_Config::getInstance()->set(array(
    'api_type' => Paymentwall_Config::API_VC,
    'public_key' => Flux::config('PWallPublicKey'),
    'private_key' => Flux::config('PWallPrivateKey')
));
$func = array($pwlog, 'puts');
call_user_func_array($func, array("Transaction Start"));
$pingback = new Paymentwall_Pingback($_GET, $_SERVER['REMOTE_ADDR']);
if ($pingback->validate()) {
    $credits = $pingback->getVirtualCurrencyAmount();
    if ($pingback->isDeliverable()) {
        call_user_func_array($func, array("Transaction type: Deliverable"));
        foreach($_GET as $key => $val)
            call_user_func_array($func, array('['.$key.'] => '.$val));
        $server->loginServer->depositCredits($pingback->getUserId(), $credits, $credits / $rate);
    } else if ($pingback->isCancelable()) {
        // Withdraw the virual currency
        call_user_func_array($func, array("Transaction type: Cancelable"));
        foreach($_GET as $key => $val)
            call_user_func_array($func, array('['.$key.'] => '.$val));
        $server->loginServer->depositCredits($pingback->getUserId(), $credits, $credits / $rate);
    }
    // Log donation to MySQL Table
    $sql = "INSERT INTO {$server->loginDatabase}.$tablename ";
    $sql .= "( `account_id`, `order`, `amount`, `credits`, `type`, `date` ) ";
    $sql .= "VALUES( ".$pingback->getUserId().", '".$pingback->getReferenceId()."', ".($credits / $rate).", ".$credits.", ".$pingback->getType().", NOW() ) ";
    $sth = $server->connection->getStatement( $sql );
    $sth->execute();
    echo 'OK';
} else {
    $error = $pingback->getErrorSummary();
    echo $error;
    call_user_func_array($func, array($error));
}
call_user_func_array($func, array("Transaction End"));
exit;
?>