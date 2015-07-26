<?php
require_once('config.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {

  $bar = mysql_real_escape_string($_POST["bar"]);
  $state = mysql_real_escape_string($_POST["state"]);
  $city = mysql_real_escape_string($_POST["city"]);
  $street = mysql_real_escape_string($_POST["street"]);
  $number = (int)mysql_real_escape_string($_POST["number"]);

  $query = sprintf(
    "INSERT INTO location(bar_id, state, city, street, number)
     VALUES ((SELECT id FROM bar WHERE bar.name='$bar'), '$state', '$city',
     '$street', '$number') ON DUPLICATE KEY UPDATE
     bar_id = VALUES(bar_id),
     state = VALUES(state),
     city = VALUES(city),
     street = VALUES(street),
     number = VALUES(number)"
  );
  $retval = mysql_query($query);
  if (!$retval) {
    header('HTTP', true, 500);
    die('fail'. mysql_error());
  }
  var_dump("success");
}

?>
