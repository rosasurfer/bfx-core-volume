Bloody BankersFX Core Volume: The truth revealed
================================================

[![Build Status](https://scrutinizer-ci.com/g/rosasurfer/bfx-core-volume/badges/build.png?b=master)](https://scrutinizer-ci.com/g/rosasurfer/bfx-core-volume/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rosasurfer/bfx-core-volume/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rosasurfer/bfx-core-volume/?branch=master)


### Proof that the BankersFX Core Volume indicator for MetaTrader4 does not receive any institutional data.

This project simulates a BankersFX license server and shows that the claim the indicator is feeded by institutional order
data is not true. In fact BankersFX charges money for a modified MACD which uses the underlying price data.


Demonstration
-------------
The project is hosted on a [demo server](http://bfx.rosasurfer.com/). The indicator is included and can be downloaded
[here](etc/mql4). It consists of an MQL4 indicator and an MQL4 library. To use the indicator with the demo server
add the line

```138.201.82.87  www.bankersfx.com```

to your system's DNS configuration file ```C:\Windows\System32\drivers\etc\hosts```.

As input parameter "unique user id" (aka the license code) enter **BANKERSSCAM** (11 capital letters). This code works for all
MT4 accounts (demo or real).


Documentation
-------------
[https://www.forexfactory.com/showthread.php?p=11845781](https://www.forexfactory.com/showthread.php?p=11845781)


Requirements
------------
 * [PHP 7.4](http://php.net/) or higher
 * a web server, e.g. [Apache](https://httpd.apache.org/)


Setup
-----
* Clone the project or download and extract the ZIP archive.
```bash
git clone https://github.com/rosasurfer/bfx-core-volume.git
```

* Use [Composer](http://getcomposer.org) to install the dependencies:
```bash
cd bfx-core-volume
php composer.phar install
```

* Configure a web server for the project. For Apache adjust one of the predefined templates in ```etc/httpd/apache*.conf```.
  SSL is not needed.

* Edit your system's DNS configuration and point the domains defined in the templates to your local machine. To do this open
  the file ```C:\Windows\System32\drivers\etc\hosts``` in a **plain-text editor** (e.g. Notepad). You need admin rights to edit 
  the file (see [Edit The Hosts File in Windows 7/8/10](https://www.thewindowsclub.com/hosts-file-in-windows)).
  Add the following line:
```
127.0.0.1   local.bankersfx.com  www.bankersfx.com
```

* Restart the web server and test the setup. If everything works correctly both URLs
  [http://local.bankersfx.com/](http://local.bankersfx.com/) and
  [http://www.bankersfx.com/](http://www.bankersfx.com/) will display the following message:
```
Test case proving that the BankersFX Core Volume indicator does not use institutional data.
```


Usage
-----
Use the BankersFX indicator as usual (see downloads in [```etc/mql4/```](etc/mql)). The BankersFX indicator goes into
```{mt4-data-directory}/mql4/indicators/``` and the BankersFX library goes into ```{mt4-data-directory}/mql4/libraries/```.

As input parameter "unique user id" (aka the license code) enter **BANKERSSCAM** (11 capital letters). This code works for all
MT4 accounts (demo or real).
