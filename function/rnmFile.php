<?php
include('../lib/db.php');

if (isset($_GET["old"]) && isset($_GET["new"])) {
	$ens = $database->run_query("SELECT file FROM file WHERE file=\"" . mysql_escape_string($_GET["old"]) . "\"");
	$ens = mysql_fetch_array($ens, MYSQL_ASSOC);
	$ens = $ens["file"];

	if ($ens == $_GET["old"]) {
		$ret = $database->renameFile($_GET["old"], $_GET["new"]);
		if ($ret == 1) {
			print("notice_rnmFile({\"old\":\"" . mysql_escape_string($_GET["old"]) . "\",");
			print("\"new\":\"" . mysql_escape_string($_GET["new"]) . "\",");
			print("\"value\":1})");
			return 0;
		}
	}
}
print("notice_rnmFile({\"old\":\"" . mysql_escape_string($_GET["old"]) . "\",");
print("\"new\":\"" . mysql_escape_string($_GET["new"]) . "\",");
print("\"value\":0})");

?>