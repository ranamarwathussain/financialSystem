<?php
if (!isset($_SESSION["empcode"]))
{
  echo "<script type = \"text/javascript\">
  window.location = (\"../index.php\");
  </script>";

}
?>