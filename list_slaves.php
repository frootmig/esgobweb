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

$data = simple_get('domains.slaves.list');

if (!is_object($data)) {
	echo('<div class="alert alert-danger" role="alert">Webservice call did not return response</div>');
} else if (!$data->domains || count($data->domains) < 1) {
	echo('<div class="alert alert-warning" role="alert">No slave zones found</div>');
} else {
	echo('<table class="table table-striped">');
	echo('<thead>');
	echo('<tr>');
	echo('<th>Domain</th>');
	echo('<th>Type</th>');
	echo('<th>Master IP</th>');
	echo('<th>Action</th>');
	echo('</tr>');
	echo('</thead>');
	foreach ($data->domains as $domain) {
		echo('<tr>');
		echo('<td>');
		echo htmlentities($domain->domain);
		echo('</td>');
		echo('<td>');
		echo htmlentities($domain->type);
		echo('</td>');
		echo('<td>');
		echo htmlentities($domain->masterip);
		echo('</td>');
		echo('<td><a href="soa.php?domain=');
		echo urlencode($domain->domain);
		echo('"><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span></a>&nbsp;<a href="force_transfer.php?domain=');
		echo urlencode($domain->domain);
		echo('"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></a></span>&nbsp;<a href="update_master.php?domain=');
		echo urlencode($domain->domain);
		echo('&masterip=');
		echo urlencode($domain->masterip);
		echo('"<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;<a href="del_slave.php?domain=');
		echo urlencode($domain->domain);
		echo('"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>');
		echo('</tr>');
	}
	echo('</table>');
}

include('footer.inc.php');
?>
