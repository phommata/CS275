<?php
error_reporting(1);

require_once('config.php');
$query = sprintf(
  "SELECT p.fname, p.lname, COUNT(*)
  FROM person p
  LEFT JOIN drink d ON p.id = d.person_id
  GROUP BY p.fname;"
);
$people = mysql_query($query);

if (!$people) {
  die('invalid query');
} else {
  $jsonRows = array();
  while ($row = mysql_fetch_assoc($people)) {
    $jsonRows[] = $row;
  }
  print json_encode($jsonRows);
}

?>
