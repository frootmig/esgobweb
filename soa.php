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
	$data = simple_get('domains.tools.soacheck', $domain);
}

if ($domain == '') {
	echo('<div class="alert alert-danger" role="alert">No domain name set</div>');
} else if (!is_object($data)) {
	echo('<div class="alert alert-danger" role="alert">Webservice call did not return response</div>');
} else {
	echo('<h1>');
	echo(htmlentities($data->domain));
	echo('</h1>');
	echo('<div class="well">Information was ');
	if ($data->cached) {
		echo('cached');
		echo(' for ');
		echo(htmlentities($data->cachefor));
		echo(' seconds on ');
		echo(htmlentities(date(DATE_RFC822, $data->timestamp)));
	} else {
		echo('not cached');
	}
	echo('</div>');
	echo('<h2>Analysis</h2>');
	if (is_object($data->analysis) && $data->analysis->mastersok && $data->analysis->consistent && $data->analysis->nodesok) {
		echo('<div class="alert alert-success" role="alert">');
	} else {
		echo('<div class="alert alert-danger" role="alert">');
	}
	echo('&nbsp;');
	if (is_object($data->analysis)) {
		if ($data->analysis->mastersok) {
			echo('Master OK.');
		} else {
			echo('<strong>Master error.</strong>');
		}
		echo(' ');
		if ($data->analysis->nodesok) {
			echo('Nodes OK.');
		} else {
			echo('<strong>Nodes error.</strong>');
		}
		echo(' ');
		if ($data->analysis->consistent) {
			echo('Data is consistent.');
		} else {
			echo('<strong>Data is not consistent.</strong>');
		}
	} else {
		echo('<strong>Analysis data format error.</strong>');
	}
	echo('&nbsp;');
	echo('</div>');
	echo('<h2>Masters</h2>');
	echo('<table class="table table-striped">');
	echo('<thead>');
	echo('<tr>');
	echo('<th>IP</th>');
	echo('<th>SOA</th>');
	echo('<th>Response</th>');
	echo('</tr>');
	echo('</thead>');
	foreach ($data->responses->masters as $m) {
		echo('<tr>');
		echo('<td>');
		echo htmlentities($m->ip);
		echo('</td>');
		echo('<td>');
		echo htmlentities($m->soa);
		echo('</td>');
		echo('<td>');
		echo htmlentities($m->response);
		echo('</td>');
		echo('</tr>');
	}
	echo('</table>');
	echo('<h2>AXFR nodes</h2>');
	echo('<table class="table table-striped">');
	echo('<thead>');
	echo('<tr>');
	echo('<th>SOA</th>');
	echo('<th>Response</th>');
	echo('</tr>');
	echo('</thead>');
	foreach ($data->responses->axfrnodes as $m) {
		echo('<tr>');
		echo('<td>');
		echo htmlentities($m->soa);
		echo('</td>');
		echo('<td>');
		echo htmlentities($m->response);
		echo('</td>');
		echo('</tr>');
	}
	echo('</table>');
	echo('<h2>Anycast node status</h2>');
	echo('<table class="table table-striped">');
	echo('<thead>');
	echo('<tr>');
	echo('<th>Country</th>');
	echo('<th>Location</th>');
	echo('<th>SOA</th>');
	echo('<th>Response</th>');
	echo('</tr>');
	echo('</thead>');
	foreach ($data->responses->anycastnodes as $a) {
		echo('<tr>');
		echo('<td>');
		$country = strtoupper($a->country);
		$flag_file = 'flags_iso/24/'.$a->country.'.png';
		if (file_exists($flag_file)) {
			echo('<img src="'.$flag_file.'" alt="'.htmlentities($country).'" />');
		} else {
			echo htmlentities($country);
		}
		echo('</td>');
		echo('<td>');
		echo htmlentities($a->location);
		echo('</td>');
		echo('<td>');
		echo htmlentities($a->soa);
		echo('</td>');
		echo('<td>');
		echo htmlentities($a->response);
		echo('</td>');
		echo('</tr>');
	}
	echo('</table>');
}

include('footer.inc.php');
?>
