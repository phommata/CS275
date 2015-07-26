<?php
require_once('config.php');

$method = $_SERVER['REQUEST_METHOD'];
var_dump('hello');

if ($method == 'POST') {

  $name = mysql_real_escape_string($_POST["name"]);
  $quality = mysql_real_escape_string($_POST["drink_quality"]);

  $query = sprintf(
    "INSERT INTO bar(name, drink_quality) VALUES('$name', '$quality')"
  );
  $retval = mysql_query($query);
  if (!$retval) {
    header('HTTP', true, 500);
    die('fail'. mysql_error());
  }
  var_dump('success');
}

?>
