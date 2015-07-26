<?php
error_reporting(1);

require_once('config.php');
$query = sprintf("
  SELECT b.name AS bar_name, l.number, l.street, l.city, l.state, b.drink_quality, dt.name, s.discount
  FROM bar b
  LEFT JOIN location l ON l.bar_id = b.id
  LEFT JOIN bar_special bs ON bs.bar_id = b.id
  LEFT JOIN special s ON s.id = bs.special_id
  LEFT JOIN drinkType dt ON dt.id =  s.type_id
  ORDER BY b.name ASC");
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
