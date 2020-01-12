<?php
include('../lib/db.php');

if (isset($_GET["file"])) {
	$link = $database->run_query("SELECT count(`id`) as num FROM link,file WHERE link.fileid=file.id AND file.file=\"" . mysql_escape_string($_GET["file"]) . "\"");
	$link = mysql_fetch_array($link, MYSQL_ASSOC);
	$link = $link["num"];
	$ret = $database->delete_file($_GET["file"]);
	$clink = $ret[0];
	$who = mysql_escape_string($_GET["file"]);
	$cwho = $ret[1];
} else if (isset($_GET["key"])) {
	$link = $database->run_query("SELECT count(`id`) as num FROM link,keyword WHERE link.keywordid=keyword.id AND keyword.word='" . $_GET["key"] . "'");
	$link = mysql_fetch_array($link, MYSQL_ASSOC);
	$link = $link["num"];
	$ret = $database->delete_keyword($_GET["key"]);
	$clink = $ret[0];
	$who = $_GET["key"];
	$cwho = $ret[1];
}

print("notice_file_key({\"link\":" . $link . ",");
print("\"clink\":" . $clink . ",");
print("\"who\":\"" . $who . "\",");
print("\"cwho\":" . $cwho . "})");

?>