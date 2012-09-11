README
------------

Simple Twitter client via Zend Service Twitter (Twitter API 1)

REQUIREMENTS
------------

 - PHP >= 5.2.10
 - Apache2 (with mod_rewrite)

INSTALLATION
------------

 - Clone this repo `git clone git://github.com/simukti/Twitter.git`
 - Create Apache virtual host and point to /path/to/cloned/Twitter
 - Browse to /path/to/cloned/Twitter and rename `src/configs/twitter.php.dist` to `twitter.php`
 - Fill `app_name`, `consumer_key`, and `consumer_secret`
 - Restart your Apache service

RUN VIA PHP 5.4.* BUILT-IN WEBSERVER
------------

If you have PHP 5.4.*, you can directly run this application with (assuming that you are currently on Twitter dir):

    /path/to/php5_4_directory/php -S 127.0.0.1:20001

SCREENSHOT
------------

![Twitter For Simukti](https://lh5.googleusercontent.com/-FSXcWaSNOU0/UE80ZMVFd3I/AAAAAAAAACA/Oy1gnKD6olk/s800/tfs.jpg)

![Twitter For Simukti Hashtag Search](https://lh5.googleusercontent.com/-SXYue_u5Oag/UE80ZmR_7EI/AAAAAAAAACI/C-rmnll2u5Y/s800/tfs_hashtag.jpg)