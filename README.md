Bloody BonkersFX: The truth revealed
====================================

### Proof of concept that the BankersFX Core Volume indicator for MetaTrader 4 does not receice data from a proprietary data feed.

A purely educational test case. It simulates a BankersFX license server and shows that the claim the indicator is feeded by
institutional order flow does not hold true.


Requirements
------------
 * [PHP 5.6](http://php.net/)
 * a web server, e.g. [Apache](https://httpd.apache.org/)


Setup
-----
* Clone the project or download and extract the ZIP archive:
  ```bash
  git clone https://github.com/rosasurfer/bfx-core-volume.git
  ```

* Use [Composer](http://getcomposer.org) to install the dependencies:
  ```bash
  $ cd bfx-core-volume
  $ php composer.phar install
  ```

* Configure a web server for the project. For Apache adjust one of the predefined templates in ```etc/httpd/apache*.conf```.
  The templates define the web domains for the project. If you want to use SSL adjust the paths to your server's SSL certificates
  (SSL is **not** required to run the project).

* Edit your system's network configuration and point the defined domains to your local machine instead of the internet. To do 
  this open the file ```C:\Windows\System32\drivers\etc\hosts``` in a **plain-text editor**, e.g. Notepad. You may need admin
  rights to edit the file (see [Edit The Hosts File in Windows 7/8/10](https://www.thewindowsclub.com/hosts-file-in-windows)).
  Add the following line exactly as typed anywhere in the file and save it:
  ```
  127.0.0.1   local.bfx.rosasurfer.com  www.bankersfx.com
  ```

* Restart the web server and test the setup. If everything works correctly both links
  [http://local.bfx.rosasurfer.com/](http://local.bfx.rosasurfer.com/) and 
  [http://www.bankersfx.com/](http://www.bankersfx.com/) must display the same following message in your web browser:
  ```
  Educational test case to proof that the BankersFX Core Volume indicator is not based
  on a BankersFX data feed.
  ```


Usage
-----
Use the provided indicator as usual. As license code (aka the unique user id) enter **BANKERSSCAM** (11 capital letters)
regardless of the MetaTrader account type (demo or real).


Demonstration
-------------
The project is hosted on a [demo server](http://bfx.rosasurfer.com/). To test with the demo server modify the line added to
```C:\Windows\System32\drivers\etc\hosts``` (read the network configuration section above under **Setup**) and replace
**in the added line only** ```127.0.0.1``` by ```89.163.167.173```.
