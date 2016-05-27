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
	'modules' => array(
		'pwall' => array(
			'index' 	=> AccountLevel::NORMAL,
			'notify'   	=> AccountLevel::ANYONE,
			'log'   	=> AccountLevel::ADMIN
		)
	),
	'features' => array(
		// None.
	)
)
?>