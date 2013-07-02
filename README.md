API Cacher
===============

Caches API's for offline use or speed improvements.

##Host entry
Create a hostentry in your **vagrant** box containing your host


    72.84.98.1   cacher.lo


##Create a vhost entry

    <VirtualHost *:80>
        DocumentRoot /Users/nicam/www/cacher
        ServerName cacher.lo
            <Directory "/Users/nicam/www/cacher">
               Options All
               AllowOverride All
               Order allow,deny
               Allow from all
            </Directory>
    </VirtualHost>


##Setup the auth

Edit index.php and setup your HTTP Basic auth


	$url = "http://dev.liip.ch";
	$username = "foo";
	$password = "bar";
