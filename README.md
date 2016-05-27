#!!!Attention!!!
This addon was tested only on Test projects. Contact me, when you will test it with approved projects for better testing and bugfixing (if needed)

## Payment Wall
You can accept donations through [Payment Wall system](https://www.paymentwall.com/) with this addon for FluxCP.

## Installation

1. Register account at [Payment Wall](https://www.paymentwall.com/)
2. Create new project
3. Set project up. Important notes:
  * API => Virtual Currency
  * Pingback Type => Url
  * When you type pingback url - make sure to place '/' at the end of url
  * Pingback signature version => 1
  * Add 2 custom pingback parameters: module and action. [Screenshot](http://i.imgur.com/T4FHoyo.png)
4. Upload 'pwall' folder into your addons folder.
5. Edit 'pwall/config/addon.php' with your settings.
  * Place your Public key
  * Place your Secret key
  * Input width and height for widget
  * Edit donation rate and currency
6. Add link to page your.site.com/?module=pwall wherever you want.
7. Test it!

## Note
While your project in Test status - you can test it only while you logged in at [Payment Wall](https://www.paymentwall.com/). 

## Page example
[See link](http://i.imgur.com/IceFUJA.png)

## Bug reports

Report bugs on GitHub, so they can be fixed ASAP. Or you can contact me at Hercules forum: [kenik](http://herc.ws/board/user/9024-kenik/)

## Links

* FluxCP: https://github.com/HerculesWS/FluxCP
* Payment Wall: https://www.paymentwall.com/
