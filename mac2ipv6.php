<!doctype html>
<html lang="de">
 <head>
  <meta charset="ISO-8859-1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ffhgw | MAC to IPv6</title>
 </head>
<body>

<p><b>Ermittlung der &ouml;ffentlichen IPv6-Adresse eines<br />Greifswalder Freifunk-Knotens aus seiner MAC-Adresse</b></p>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
 <p><label>MAC-Adresse&nbsp;</label><input type="text" name="mac" size="15" maxlength="17" placeholder="00:00:00:00:00:00"/><input type="submit" /></p>
</form>

<?php

// Wurde Variable übergeben?
if (isset($_POST['mac']) && $_POST['mac'] != "") {
 $mac = $_POST['mac'];
 $prefix = "2a01:a380:8408:2000:";

 $mac_array = explode(":", $mac);

 // Format prüfen
 if (strlen($mac) == 17 && preg_match('/([a-fA-F0-9]{2}[:]?){6}/', $mac)) {

  // bit flip
  $mac_array[0] = dechex(hexdec($mac_array[0]) ^ 2);

  // ipv6 zusammensetzen
  $ipv6  = $prefix;
  $ipv6 .= $mac_array[0] . $mac_array[1] . ":" . $mac_array[2] . "ff:fe" . $mac_array[3] . ":" . $mac_array[4] . $mac_array[5];
  $ipv6  = strtolower($ipv6);

  // Link
  echo strtoupper($mac) ." &rarr; <a href='http://[".$ipv6."]' target='_blank'>[".$ipv6."]</a>";

 } else {

  // Fehler
  echo "Was soll das denn sein?<br />Eine MAC-Adresse sieht so aus: <i>C4:6E:1F:B6:94:8A</i>.";

 }
}

?>
</body>
</html>
