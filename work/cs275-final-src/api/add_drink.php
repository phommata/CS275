<?php
require_once('config.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {

  $fname = mysql_real_escape_string($_POST["fname"]);
  $lname = mysql_real_escape_string($_POST["lname"]);
  $bar = mysql_real_escape_string($_POST["bar"]);
  $drinkType = mysql_real_escape_string($_POST["drinkType"]);
  $price = mysql_real_escape_string($_POST["price"]);
  $time = mysql_real_escape_string($_POST["time"]);

  $query = sprintf(
    "INSERT INTO drink(person_id, bar_id, type_id, price, time)
    VALUES ((SELECT id FROM person WHERE person.fname = '$fname' AND 
    person.lname = '$lname'), (SELECT id FROM bar WHERE bar.name = '$bar'),
    (SELECT id FROM drinkType WHERE drinkType.name = '$drinkType'), '$price', '$time')"
  );
  $retval = mysql_query($query);
  if (!$retval) {
    header('HTTP', true, 500);
    die('fail'. mysql_error());
  }
  var_dump("success");
}

?>
