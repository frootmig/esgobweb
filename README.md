# esgobweb

Web client for the DNS API of [Esgob Ltd.](https://www.esgob.com/). The company provides a [Free Secondary DNS](https://noc.esgob.com/secondary_dns) service. esgobweg can be used as a web interface for their API. You need an account with Esgob in order to use esgobweb.

## System requirements

esgobweb requires a webserver with capability of running PHP 5.4 (or later) and curl. For Debian based Linux distributions make sure the php5-curl package is installed.

## Installation

Please follow these steps to get a working installation of esgobweb.

### Extract archive

Extract the esgobweb archive into a folder of your web server where you want to access it.

### Security considerations

I recommend allowing access to esgobweb only via SSL, but this is not mandatory. There is currently no authentication mechanism in esgobweb, so please make sure you use your webservers password authentication or IP restrictions to prevent unauthorized access to your zones.

### Install Bootstrap

esgobweb requires Bootstrap. Download [the latest version of Bootstrap 3](http://getbootstrap.com/getting-started/#download) into the folder you extracted esgobweb. Then extract it and create a symlink to make it usable for esgobweb:

`unzip bootstrap-3.XXX-dist.zip`
`ln -s bootstrap-3.XXX-dist dist`

### Configure API key and user name

Copy config.dist.php to config.inc.php and set all configuration variables, especially the Esgob API user and key.

### Install flag package (optional)

esgobweb can display flags for the country of the anycast nodes. You need to install a flag package and set the option FLAG_FOLDER in config.inc.php to the relative path of the flags that should be used.

You can download e.g. [243 Country Flag Icons](http://365icon.com/icon-styles/ethnic/classic2/) and extract the content into the esgob folder. Set the config.inc.php apropriate:

`define('FLAG_FOLDER', 'flags/flags_iso/24/');`
