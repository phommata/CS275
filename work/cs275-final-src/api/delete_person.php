<?php
require_once('config.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {

  $fname = mysql_real_escape_string($_POST["fname"]);
  $lname = mysql_real_escape_string($_POST["lname"]);

  $query = sprintf(
    "DELETE FROM person WHERE person.fname='$fname' AND person.lname='$lname'"
  );
  $retval = mysql_query($query);
  if (!$retval) {
    header('HTTP', true, 500);
    die('fail'. mysql_error());
  }
  var_dump("success");
}

?>
