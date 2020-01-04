<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
  <head>
  <?php include("inc/meta.inc.php"); ?>   

    <title>Mitmachen - Freifunk am Steinhuder Meer</title>

  </head>

<!-- NAVBAR
================================================== -->
  <body>
    <?php include("inc/nav.inc.php"); ?>



<br>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->


    <div class="container marketing content_part">
      <h2 id="router">Empfohlene Router</h2>
      <div class="row featurette">
     Siehe: <a href="https://hannover.freifunk.net/wiki/Freifunk/Router"> Empholene Router Modelle beim Freifunk Hannover</a>
      </div>

 
      <hr>
      <h2 id="einrichtung">Einrichtung des Routers</h2>
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Schritt 1. <span class="text-muted">Beschaffung der Hardware.</span></h2>
          <p class="lead">Wenn du dich dazu entscheidest beim Freifunk mitzumachen, hast du anfangs die Qual der Wahl beim Aussuchen eines Routers. Als hilfe kannst du dir die Liste des Freifunk Hannovers zur Hilfe nehmen: <a href="https://hannover.freifunk.net/wiki/Freifunk/Router"> Empholene Router Modelle beim Freifunk Hannover</a><br>Dringend abraten müssen wir u.A. vom TP-Link TL-WR841N/ND und anderen Geräten, die nur 4MB Flash und/oder 32MB Ram besitzen. Aufgrund der aktuellen Firmware Entwicklung können diese Geräte aufgrund der knappen Speicher Ressourcen in Zukunft nicht mehr mit einer aktuellen Firmware versorgt werden.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="img/mitmachen_00.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">Schritt 2.<span class="text-muted">Router ist angekommen</span></h2>
          <p class="lead">Nachdem der Router bei dir Zuhause angekommen ist, musst du nun noch die <a href="downloads.php">Freifunk-Software</a> Installieren. Packe Ihn aus und schließe Ihn via LAN (meistens gelb) an deinem Computer oder Laptop an und mit dem schwarzen Netzadapter an den Strom an.</p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" src="img/mitmachen_01.jpg" >
        </div>
      </div>

      <hr class="featurette-divider">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Schritt 3. <span class="text-muted">Installation.</span></h2>
          <p class="lead">Zuvor musst die dir die passende <a href="downloads.php">Firmware</a> (z.B. <a  data-toggle="tooltip" title="Das wr841 steht für den Router und das v11 für die Version des Routers!">gluon-ffh-0.12d-xx-tp-link-tl-<b>wr841n</b>-nd-v11.bin</a>) runterladen. Wichtig! Schaue unter den Router dort findest du die Version des Routers (z.B. v11).  Danach gehst du in deinem Internet Browser (z.B. Firefox oder Chrome) auf folgende Adresse: <a href="http://192.168.0.1/">http://192.168.0.1/</a> und loggst dich dort mit Benutzer: admin Passwort: admin ein. Nun findest du auf der Rechten Seite in der Navigation den Punkt "System Tools" -> "Firmware Upgrade". Dann wählst du die zuvor runtergeladene Firmware aus. Danach auf "Upgrade" klicken!</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="img/tp-link_original.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">Schritt 4. <span class="text-muted">Daten einstellen.</span></h2>
          <p class="lead">Wenn der Router neugestartet ist, öffne <a href="http://192.168.1.1/">http://192.168.1.1/</a> in deinem Browser (z.B. Firefox/Chrome/Internet Explorer). Trage oben den Namen deines Knoten ein (z.B. Musterstraße21a-Knoten1). Wenn du dein Internet teilen möchtest, dann musst du den Haken bei "Mesh-VPN" setzen. Dieser Haken wird zwangsweise benötigt, <strong>wenn kein weiterer Freifunk-Router mit Internetzugang</strong> im Umfeld ist. </p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" src="img/auf_dem_router.jpg" >
        </div>
      </div>

      <hr class="featurette-divider">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Schritt 5. <span class="text-muted">Fertigstellen.</span></h2>
          <p class="lead">Wenn du alles eingetragen hast, klicke unten auf "Speichern und Neustart". Dann wird dir dein VPN-Schlüssel und der Namen deines Knoten angezeigt. Schicke diese beiden Daten dann per E-Mail an <a href="mailto:keys@hannover.freifunk.net">keys@hannover.freifunk.net</a> und schlie&szlig;e deinen Freifunk-Router an deinen Router (Speedport/FritzBox) an.</p>

          <br>
          <p class="lead">Das war es schon. Nun solltest du ein WLAN Namens "hannover.freifunk.net" sehen. Wenn kein Router in der nähe ist, der bereits schon Internet teilt, dauert es ein paar Stunden bis dein Knoten eingetragen ist und Internet teilt.</p>

          <p class="lead"> Happy Freifunken!</p>
          <p>* Freifunk in Steinhude und Umgebung ist Teilnehmer des Partnerprogramms von Amazon Europe S.à.r.l. und Partner des Werbeprogramms, das zur Bereitstellung eines Mediums für Websites konzipiert wurde, mittels dessen durch die Platzierung von Werbeanzeigen und Links zu amazon.de Werbekostenerstattung verdient werden können. Amazon setzt Cookies ein, um die Herkunft der Bestellungen nachvollziehen zu können. Unter anderem kann Amazon erkennen, dass Sie den Partnerlink auf dieser Website geklickt haben. Weitere Informationen zur Datennutzung durch Amazon erhalten Sie in der Datenschutzerklärung des Unternehmens: www.amazon.de/gp/help/customer/display.html/ref=footer_privacy?ie=UTF8&nodeId=3312401</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="img/key.jpg" alt="Generic placeholder image">
        </div>
      </div>
      <!-- FOOTER -->
      <?php include("inc/footer.inc.php"); ?>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

