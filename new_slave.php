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

if (isset($_GET['submitBtn']) && isset($_GET['domain']) && isset($_GET['masterip'])) {
	$domain = $_GET['domain'];
	$masterip = $_GET['masterip'];

	$data = simple_get('domains.slaves.add', $domain, $masterip);

	if (!is_object($data)) {
		echo('<div class="alert alert-danger" role="alert">Webservice call did not return response</div>');
	} else {
		echo('<h1>');
		echo(htmlentities($domain));
		echo('</h1>');
		echo('<div class="well">');
		echo(htmlentities($data->action));
		echo('</div>');
	}
} else {
?>
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Create new slave zone</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="domain">Domain name</label>  
  <div class="col-md-4">
  <input id="domain" name="domain" placeholder="Enter domain name" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="masterip">Master IP</label>  
  <div class="col-md-4">
  <input id="masterip" name="masterip" placeholder="Enter IP address" class="form-control input-md" required="" type="text">
  <span class="help-block">Enter the IP address of the master DNS server (IPv4 or IPv6)</span>  
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submitBtn"></label>
  <div class="col-md-8">
    <button id="submitBtn" name="submitBtn" class="btn btn-success">Create</button>
  </div>
</div>

</fieldset>
</form>

<?php
}

include('footer.inc.php');

?>
