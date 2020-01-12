<?php

function html2text($file_name)
{
	//return "htmlfile";
	$f = fopen($file_name, 'r');
	$f_text = fread($f, filesize($file_name));
	fclose($f);

	//$f_text=preg_replace("/(<!--[\s\S]{1,}-->)/"," ",$f_text);
	$f_text = preg_replace("/(<head[\s\S]{1,}?head>)/", " ", $f_text);
	$f_text = preg_replace("/<script[\s\S]{1,}?script>/", " ", $f_text);
	$f_text = preg_replace("/<style[\s\S]{1,}?style>/", " ", $f_text);
	//$f_text=preg_replace("/(<[^\/][^>]{1,}>)|(<\/.{1,}>)/"," ",$f_text);

	return strip_tags($f_text);
}
?>