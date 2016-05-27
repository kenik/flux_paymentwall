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
return array(
    // Common settings for addon
    'PWallPublicKey'    => '',       // PaymentWall public (project) key
    'PWallPrivateKey'   => '',       // PaymentWall private (secret) key
    'PWallSignVersion'  => 1,        // PaymentWall sign version.

    // Widget display settings
    'PWallWidgetType'   => 'p10',    // Widget type
    'PWallWidgetWidth'  => 910,      // Widget width
    'PWallWidgetHeight' => 400,      // Widget height

    // Currency exchange rate. Like in paymentwall project settings
    'PWallDonationRate'    =>  1,
    'PWallCurrency'        =>  'USD',

    // Tables
    'FluxTables' => array(
        'PWallLogTable' => 'cp_pwall_log', // Table with donations log
    ),
    // Transactions log file
    'PWallLogFile' => FLUX_DATA_DIR.'/logs/paymentwall.log',

    // PaymentWall library (https://github.com/paymentwall/paymentwall-php).
    'PWallLibrary' => dirname(dirname(__FILE__)).'/lib/pwall/paymentwall.php',

    'SubMenuItems' => array(
        'pwall' => array(
            'index' => 'Donate',
            'log'   => 'Donations log'
        ),
    )
)
?>