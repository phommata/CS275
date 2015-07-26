<?php
error_reporting(1);

require_once('config.php');
$query = sprintf(
  "SELECT d.name
  FROM drinkType d"
);
$drinkTypes = mysql_query($query);

if (!$drinkTypes) {
  die('invalid query');
} else {
  $jsonRows = array();
  while ($row = mysql_fetch_assoc($drinkTypes)) {
    $jsonRows[] = $row;
  }
  print json_encode($jsonRows);
}

?>
