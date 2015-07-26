<?php
require_once('config.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {

  $bar = mysql_real_escape_string($_POST["bar"]);

  $query = sprintf(
    "DELETE FROM bar WHERE bar.name='$bar'"
  );
  $retval = mysql_query($query);
  if (!$retval) {
    header('HTTP', true, 500);
    die('fail'. mysql_error());
  }
  var_dump("success");
}

?>
