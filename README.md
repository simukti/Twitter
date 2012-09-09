README
------------

Simple Twitter client via Zend Service Twitter (Twitter API 1)

REQUIREMENTS
------------

 - PHP >= 5.2.10
 - Apache

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

    `/path/to/php5_4_directory/php -S 127.0.0.1:20001`
