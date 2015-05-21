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
?>
	<div class="jumbotron">
		<h1>Welcome to the Esgob webservice client</h1>
		<p>This software provides a client for the Esgob webservice and is not afiliated with Esgob Ltd.</p>
	</div>
<?php
$data = simple_get('accounts.get');
if (is_object($data)) {
	echo('<div class="well">Account ');
	echo(htmlentities($data->name));
	echo(' (');
	echo(htmlentities($data->id));
	echo(') has ');
	echo(htmlentities($data->credits));
	echo(' credits.');
	echo('</div>');
} else {
	echo('<div class="alert alert-danger" role="alert">Webservice call did not return response</div>');
}

include('footer.inc.php');
?>
