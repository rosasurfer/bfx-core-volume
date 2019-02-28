Bloody BankersFX Core Volume: The truth revealed
================================================

[![Build Status](https://scrutinizer-ci.com/g/rosasurfer/bfx-core-volume/badges/build.png?b=master)](https://scrutinizer-ci.com/g/rosasurfer/bfx-core-volume/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rosasurfer/bfx-core-volume/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rosasurfer/bfx-core-volume/?branch=master)


### Proof of concept that the BankersFX Core Volume indicator for MetaTrader 4 does not receice data from a proprietary data feed.

A purely educational test case. It simulates a BankersFX license server and shows that the claim the indicator is feeded by
institutional order flow does not hold true. Actually BankersFX charges for a modified MACD feeded by the user's broker.


Demonstration
-------------
The project is hosted on a [demo server](http://bfx.rosasurfer.com/). The indicator is included and can be downloaded
[here](etc/mql). It consists of an MQL indicator and an MQL library. To use the indicator with the demo server as license
server (and spare project installation) change the line in  
```C:\Windows\System32\drivers\etc\hosts``` (read about the network configuration below) into
```
89.163.167.173  www.bankersfx.com
```


Support
-------
[https://www.forexfactory.com/showthread.php?p=11845781](https://www.forexfactory.com/showthread.php?p=11845781)


Requirements
------------
 * [PHP 5.6](http://php.net/)
 * a web server, e.g. [Apache](https://httpd.apache.org/)


Setup
-----
* Clone the project or download and extract the ZIP archive. To enable Git support for symbolic links on Windows set the config
  option ```core.symlinks = true``` before cloning:
```bash
git config --global core.symlinks true
git clone https://github.com/rosasurfer/bfx-core-volume.git
```

* Use [Composer](http://getcomposer.org) to install the dependencies:
```bash
cd bfx-core-volume
php composer.phar install
```

* Configure a web server for the project. For Apache adjust one of the predefined templates in ```etc/httpd/apache*.conf```.
  The templates define the web domains for the project. If you want to use SSL adjust the paths to your server's SSL certificates
  (SSL is **not** required to run the project).

* Edit your system's network configuration and point the defined domains instead of the internet to your local machine. To do
  this open the file ```C:\Windows\System32\drivers\etc\hosts``` in a **plain-text editor**, e.g. Notepad. You may need admin
  rights to edit the file (see [Edit The Hosts File in Windows 7/8/10](https://www.thewindowsclub.com/hosts-file-in-windows)).
  Add the following line exactly as shown anywhere in the file and save it:
```
127.0.0.1   local.bfx.rosasurfer.com  www.bankersfx.com
```

* Restart the web server and test the setup. If everything works correctly both links
  [http://local.bfx.rosasurfer.com/](http://local.bfx.rosasurfer.com/) and
  [http://www.bankersfx.com/](http://www.bankersfx.com/) must display the same following message in your web browser:
```
Test case to prove that the data displayed by the BankersFX Core Volume indicator is not based on a data feed.
```


Usage
-----
Use the provided indicator as usual. See the downloads in [```etc/mql/```](etc/mql). The indicator consists of an indicator
which goes into ```{terminal-data-directory}/mql4/indicators/``` and a library which goes into ```{terminal-data-directory}/mql4/libraries/```.

As license code (aka the unique user id) enter **BANKERSSCAM** (11 capital letters) regardless of the MetaTrader account type
(demo or real).
