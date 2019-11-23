<script>
  if (window.location.protocol != "https:")
    window.location.href = "https:" + window.location.href.substring(window.location.protocol.length);
</script>
<div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand swiss911head" href="index.php">Freifunk am Steinhuder Meer</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="index.php">Start</a></li>
                <li><a href="das_projekt.php">Das Projekt</a></li>
                <li><a href="news.php">Neuigkeiten</a></li>
                <li><a href="karte.php">Karte</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mitmachen<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="mitmachen.php#router">Router</a></li>
                    <li><a href="mitmachen.php#einrichtung">Einrichtung</a></li>


                  </ul>
                </li>
		<li><a href="downloads.php">Downloads</a></li>
		<li><a href="team.php">Kernteam</a></li>
                <li><a href="supporter.php">Sponsoren</a></li>
		        <li><a href="kontakt.php">Kontakt</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>
<?php
$datei = 'clickcounter';
// Zugriffszahl nur ändern, wenn innerhalb von 2h kein Zugriff dieses Users stattgefunden hat
if(!$_COOKIE[$datei]) {
// Aktuelle Zugriffszahl lesen
    $f = fopen($datei.".txt","r");
    if($f) {
        while(!feof($f)) {
            $count = fgets($f);
        }
    }
    fclose($f);

// Zugriffszahl erhöhen
    $f = fopen($datei.".txt","w");
    if($f) {
        intval($count);
        $count++;
        fputs($f, $count);
        fclose($f);
    }

// Cookie erstellen
    setcookie($datei, "true", time()+7200); // 2h gültig
}
?>