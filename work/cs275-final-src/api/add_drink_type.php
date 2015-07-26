<?php
require_once('config.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {

  $drinkType = mysql_real_escape_string($_POST["drinkType"]);

  $query = sprintf(
    "INSERT INTO drinkType(name) VALUES('$drinkType')"
  );
  $retval = mysql_query($query);
  if (!$retval) {
    header('HTTP', true, 500);
    die('fail'. mysql_error());
  }
  var_dump("success");
}

?>
