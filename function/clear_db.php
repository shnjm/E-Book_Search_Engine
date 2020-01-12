<?php
include('../lib/db.php');
include('../lib/getmtime.php');

$st = getmtime();
$a = $database->run_query("DELETE FROM link");
$b = $database->run_query("DELETE FROM file");
$c = $database->run_query("DELETE FROM keyword");
$et = getmtime();

$ts = ($et - $st);
print("notice_clear({");
print("\"link\":" . ($a ? 1 : 0));
print(",\"file\":" . ($b ? 1 : 0));
print(",\"keyword\":" . ($c ? 1 : 0));
print(",\"time\":" . $ts . "});");
?>