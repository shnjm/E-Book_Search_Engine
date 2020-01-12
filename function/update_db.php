<?php
//ini_set('max_execution_time',300);
set_time_limit(0);
include('..\lib\db.php');
include('..\lib\maketxt.php');
include('../lib/getmtime.php');

$st = getmtime();
$num_file = 0;
$wordsAr = array();

function search_file($file_name)
{
	if (is_file($file_name)) {
		global $database;
		global $num_file;
		global $wordsAr;
		$num_file++;

		$str = maketxt($file_name);
		$str = $str . " " . $file_name;
		$str = preg_replace("/[^a-zA-Z0-9]|[0-9]{1,}/", " ", $str);
		$str = preg_replace("/[ ]{1,}/", " ", $str);
		$ary = explode(" ", $str);
		$ary = array_values(array_flip(array_flip($ary)));

		$len = sizeof($ary);
		$fileid = $database->insert_file($file_name, filesize($file_name));
		if ($fileid == null) {
			echo 'null found for: file ' . $file_name . '</br>';
			return 0;
		}

		for ($i = 0; $i < $len; $i++) {
			if (!isset($wordsAr[$ary[$i]])) {
				$wordsAr[$ary[$i]] = $database->insert_keyword($ary[$i]);
			}
			$wordid = $wordsAr[$ary[$i]];
			if ($wordid == null) {
				echo '---------null found for: word ' . $ary[$i] . '</br>';
				continue;
			}
			echo $database->insert_word_file_relation($wordid, $fileid);
		}
	} else {
		$base_dir = $file_name;
		$dh = opendir($base_dir);
		while (($file_name = readdir($dh))) {
			if (($file_name != '.') && ($file_name != '..')) {
				search_file($base_dir . "\\" . $file_name);
			}
		}
		closedir($dh);
	}
}

search_file('C:\wamp\www\PhpProject1-test\files');
//search_file('..\files');
$et = getmtime();
$ts = ($et - $st);

print("notice_updt({");
print("\"files\":" . $num_file);
print(",\"time\":" . $ts);
print("});");

?>