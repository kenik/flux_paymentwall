<?php
/*-------------------------------------
// PaymentWall addon created by kenik
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
Paymentwall_Config::getInstance()->set(array(
    'api_type' => Paymentwall_Config::API_VC,
    'public_key' => Flux::config('PWallPublicKey'),
    'private_key' => Flux::config('PWallPrivateKey')
));
$widget = new Paymentwall_Widget(
    $session->account->account_id,
    Flux::config('PWallWidgetType'),
    array(),
    array('email' => $session->account->email, 'sign_version' => Flux::config('PWallSignVersion'), 'action' => 'notify', 'module' => 'pwall')
);
?>