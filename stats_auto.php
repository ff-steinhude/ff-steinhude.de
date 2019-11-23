<?php

// Runs every 10 Minutes
require_once 'inc/mysql_config.php';
$url = "http://hannover.freifunk.net/api/nodes.json";
$result = file_get_contents($url);
$ffhapi = json_decode($result, true);
mysql_connect ($sqlhost,$username,$passwort);
mysql_select_db ($database);
$abfrage = "SELECT * FROM ffv.router ORDER BY joinedby DESC; ";
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

    if ($clients_stats != 0 AND $router_on != 0 AND $traffic_stat != 0){
    $sql_insert = "INSERT INTO `ffv`.`stats` (`timestamp`, `anzahl_clients`, `anzahl_router`, `anzahl_traffic`) VALUES ('".time()."', '".$clients_stats."', '".$router_on."', '".$traffic_stat."');";
    mysql_query($sql_insert);
    }
    ?>
