<?php
include('pdf2text.php');
include('txt2text.php');
include('html2text.php');


function maketxt($file_name)
{
	$typ = explode(".", $file_name);
	$typ = $typ[sizeof($typ) - 1];
	switch ($typ) {
		case "txt":
			return txt2text($file_name);
		case "pdf":
			$a = new PDF2Text();
			$a->setFilename($file_name);
			$a->decodePDF();
			return $a->output();
		case "html":
			return html2text($file_name);
		case "htm":
			return html2text($file_name);
	}
}
?>