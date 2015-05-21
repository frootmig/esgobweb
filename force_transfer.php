<?php
/*
Copyright (C) 2015  Volker Janzen

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>
*/

require_once('config.inc.php');
require_once('proxy.inc.php');

include('header.inc.php');

$domain = '';
if (isset($_GET['domain'])) {
	$domain = $_GET['domain'];
}

if ($domain != '') {
        $data = simple_get('domains.slaves.forcetransfer', $domain);
}

if ($domain == '') {
        echo('<div class="alert alert-danger" role="alert">No domain name set</div>');
} else if (!is_object($data)) {
        echo('<div class="alert alert-danger" role="alert">Webservice call did not return response</div>');
} else {
        echo('<h1>');
        echo(htmlentities($domain));
        echo('</h1>');
        echo('<div class="well">');
	echo(htmlentities($data->action));
	echo('</div>');
}

include('footer.inc.php');
?>
