<?php
error_reporting(1);

require_once('config.php');
$query = sprintf("
  SELECT b.name, COUNT(*) AS drinks_served, l.number, l.street, l.city, l.state
  FROM bar b
  LEFT JOIN drink d ON d.bar_id = b.id
  LEFT JOIN person p ON p.id = d.person_id
  LEFT JOIN location l ON l.bar_id = b.id
  GROUP BY b.name ORDER BY drinks_served DESC");
$bars = mysql_query($query);

if (!$bars) {
  die('invalid query');
} else {
  $jsonRows = array();
  while ($row = mysql_fetch_assoc($bars)) {
    $jsonRows[] = $row;
  }
  print json_encode($jsonRows);
}

?>
