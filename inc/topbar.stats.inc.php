<?php
$url = "http://hannover.freifunk.net/api/nodes.json";
$result = file_get_contents($url);
$ffhapi = json_decode($result, true);

$clients_stats = 0;
$router_on = 0;
$router_off = 0;
$router_ges = 0;
$traffic_stat = 0;

require_once 'inc/mysql_config.php';
mysql_connect ($sqlhost,$username,$passwort);
mysql_select_db ($database);
$abfrage = "SELECT * FROM ffv.router;";
$ergebnis = mysql_query($abfrage) or die( mysql_error() );
while($row = mysql_fetch_array($ergebnis))
{
$nodeid = $row["nodeid"];
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
}
// Max Clients
$clients_peak = file_get_contents("max-clients.txt");
if ($clients_stats > $clients_peak){
    //echo $clients_stats;

    $handle = fopen ("max-clients.txt", w);
    fwrite ($handle, $clients_stats);
    fclose ($handle);

    //echo file_get_contents("max-clients.txt");
}

?>
<div class="topnavbar">
    <ul class="nav navbar-nav navbar-left">
        <li><a href="#"><span>Aktive Router: <?php echo $router_on; ?>/<?php echo $router_ges; ?></span></a></li>
        <li><a href="#"><span>Aktive Clients: <?php echo $clients_stats; ?></span></a></li>

        <li><a href="#"><span>Traffic: <?php echo $traffic_stat; ?> GB</span></a> </li>

    </ul>
    <ul class="userbar nav navbar-nav">
        <li class="dropdown"><a href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="userbar__settings dropdown-toggle"><i class="fa fa-power-off"></i></a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#">Log Out</a></li>
            </ul>
        </li>
    </ul>
</div>