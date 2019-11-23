<?php
$clients_peak = file_get_contents("max-clients.txt");
?>
                                       <table id="example" class="table datatable display table-hover" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Node ID</th>
                                                <th>Name</th>
                                                <th>Hardware</th>
                                                <th>Clients</th>
                                                <th>Traffic</th>
                                                <th>Uptime</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Node ID</th>
                                                <th>Name</th>
                                                <th>Hardware</th>
                                                <th>Clients</th>
                                                <th>Traffic</th>
                                                <th>Uptime</th>
                                                <th>Status</th>                                               
                                            </tr>
                                            </tr>
                                            </tfoot>
                                            <tbody>

<?php
error_reporting(E_ALL);
$url = "http://hannover.freifunk.net/api/nodes.json";
$result = file_get_contents($url);
$ffhapi = json_decode($result, true);


$clients_stats = 0;
$router_on = 0;
$router_off = 0;
$router_ges = 0;
$traffic_stat = 0;
$geo_fence_high_lat = 52.49114276717071;
$geo_fence_low_lat = 52.3990673029333;
$geo_fence_high_lon = 9.506950378417969;
$geo_fence_low_lon = 9.251518249511719;

$nodes = $ffhapi["nodes"];
rsort($nodes);
foreach ($nodes as $id => $node){

	$nodeid=$node["nodeinfo"]["node_id"]; //Knoten ID
	$hostname = $node["nodeinfo"][hostname]; // Routername
	$loc_lati = $node["nodeinfo"]["location"]["latitude"]; //GEO1
	$loc_long = $node["nodeinfo"]["location"]["longitude"]; //GEO2
	
	if ($loc_lati >= $geo_fence_low_lat && $loc_lati <= $geo_fence_high_lat && $loc_long >= $geo_fence_low_lon && $loc_long <= $geo_fence_high_lon OR strpos($hostname, 'steinhude') OR strpos($hostname, 'Steinhude') OR strpos($hostname, 'Steinhuder')) {	
	
	
	$hardware = $node["nodeinfo"][hardware][model];
	$lastseen = substr($node[lastseen],0,16);
	$status = $node[flags][online];
	$clients = $node[statistics][clients];
	$traffic = $node[statistics][traffic];
	$traffic_ges = round(($traffic[tx][bytes] + $traffic[rx][bytes] + $traffic[forward][bytes]) / 1000000000,2);
	$load = $node[statistics][loadavg];
	$uptime = round(($node[statistics][uptime] / 60 / 60) / 24 , 1);
	$firstseen = substr($node[firstseen],0,16);
	$linktorouter = $node[nodeinfo][network][addresses][1];

	if($status == "1"){
	    $status = "On";
	}else{
	    $status = "Off";
	}

//print_r($node["nodeinfo"]);
////Stats
    
//Clients
    $clients = $ffhapi[nodes][$nodeid][statistics][clients];
    $clients_stats = $clients_stats + $clients;
// Router
    $status = $ffhapi[nodes][$nodeid][flags][online];
    $router_ges = $router_ges + 1;
    $router_on = $router_on + $status;
    $router_off = $router_ges - $router_on;
// Traffic
    $traffic = $ffhapi[nodes][$nodeid][statistics][traffic];
    $traffic_ges = round(($traffic[tx][bytes] + $traffic[rx][bytes] + $traffic[forward][bytes]) / 1000000000,2);
    $traffic_stat = $traffic_stat + $traffic_ges;

// Max Clients
$clients_peak = file_get_contents("max-clients.txt");
if ($clients_stats > $clients_peak){
    //echo $clients_stats;

    $handle = fopen ("max-clients.txt", w);
    fwrite ($handle, $clients_stats);
    fclose ($handle);

    //echo file_get_contents("max-clients.txt");
}

if($status == 1){
	    $status = "On";
	}else{
	    $status = "Off";
	}
 ?>
                                            <tr>
                                                <td><a href="http://hannover.freifunk.net/karte/#!v:m;n:<?php echo $nodeid; ?>"</a><?php echo $nodeid; ?></td>
                                                <td><?php echo $hostname; ?></td>
                                                <td><?php echo $hardware; ?></td>
                                                <td><?php echo $clients; ?></td>
                                                <td><?php echo $traffic_ges." GB"; ?></td>
                                                <td><?php echo $uptime. " T" ?></td>
                                                <td><?php echo $status; ?></td>                                               
                                            </tr>

<?php
	}
                                            }
?>
                                            </tbody>
<ul class="nav navbar-nav navbar-left">
        <li><span>Aktive Router: <?php echo $router_on; ?>/<?php echo $router_ges; ?></span></li>
        <li><span>Aktive Clients: <?php echo $clients_stats; ?></span></li>
        <li><span>Clients Peak: <?php echo $clients_peak; ?></span></li>

        <li><span>Traffic: <?php echo $traffic_stat; ?> GB</span></li>

    </ul>
    