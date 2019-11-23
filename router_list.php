<html>
<head>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
    <meta charset=utf-8 />
    <title>Freifunk Steinhuder Meer</title>
</head>
<body>
<center>
###################<br>


Freifunk Steinhude
<br>
###################
</center>
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

?>
    <ul class="nav navbar-nav navbar-left">
        <li><span>Aktive Router: <?php echo $router_on; ?>/<?php echo $router_ges; ?></span></li>
        <li><span>Aktive Clients: <?php echo $clients_stats; ?></span></li>
        <li><span>Clients Peak: <?php echo $clients_peak; ?></span></li>

        <li><span>Traffic: <?php echo $traffic_stat; ?> GB</span></li>

    </ul>
    
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
                                            require_once 'inc/mysql_config.php';
                                            mysql_connect ($sqlhost,$username,$passwort);
                                            mysql_select_db ($database);
                                            $abfrage = "SELECT * FROM ffv.router WHERE active != 0 ORDER BY joinedby ASC;;";
                                            $ergebnis = mysql_query($abfrage) or die( mysql_error() );
                                            while($row = mysql_fetch_array($ergebnis))
                                            {
                                            $nodeid = $row["nodeid"];
                                            //$nodeid = "0023cd1a49c0";
                                            $hardware = $ffhapi[nodes][$nodeid][nodeinfo][hardware][model];
                                            $hostname = $ffhapi[nodes][$nodeid][nodeinfo][hostname];
                                            $lastseen = substr($ffhapi[nodes][$nodeid][lastseen],0,16);
                                            $status = $ffhapi[nodes][$nodeid][flags][online];
                                            $clients = $ffhapi[nodes][$nodeid][statistics][clients];
                                            $traffic = $ffhapi[nodes][$nodeid][statistics][traffic];
                                            $traffic_ges = round(($traffic[tx][bytes] + $traffic[rx][bytes] + $traffic[forward][bytes]) / 1000000000,2);
                                            $load = $ffhapi[nodes][$nodeid][statistics][loadavg];
                                            $uptime = round(($ffhapi[nodes][$nodeid][statistics][uptime] / 60 / 60) / 24 , 1);
                                            $firstseen = substr($ffhapi[nodes][$nodeid][firstseen],0,16);
                                            $linktorouter = $ffhapi[nodes][$nodeid][nodeinfo][network][addresses][1];

                                            if($status == "1"){
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
?>
                                            </tbody>
 