<?php
function txt2text($file_name)
{
	$f = fopen($file_name, 'r');
	$f_text = fread($f, filesize($file_name));
	fclose($f);
	return $f_text;
}
?>