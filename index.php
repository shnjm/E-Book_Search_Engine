<?php
include('\lib\db.php');
include('\lib\pdf2text.php');
include('/lib/getmtime.php');

function cmp($a, $b)
{
	return strcasecmp($a[0], $b[0]);
}

?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="script.js"></script>
	<title>Search PDF,HTML,TXT Files</title>
</head>

<body>
	<div id="norm_src">
		<form method="GET" action="<?php $_PHP_SELF ?>" onsubmit="return chkSubmit()">
			<input type="textbox" name="key" id="query" value="<?php if (isset($_GET['key'])) echo $_GET['key'] ?>">
			<input type="submit" id="button" value="GO">
		</form>
	</div>

	<div id="result">
		<?php
		if (isset($_GET["key"])) {
			$st = getmtime();
			$q_words = explode(" ", $_GET["key"]);
			$q_words_len = sizeof($q_words);
			$ret = $database->get_file_from_word($q_words[0]);
			for ($i = 1; $i < $q_words_len; $i++) {
				$tem = $database->get_file_from_word($q_words[$i]);
				$ret = array_uintersect($ret, $tem, 'cmp');
			}
			$ret = array_values($ret);
			$et = getmtime();
			$ts = intval(($et - $st));
			$len = sizeof($ret);
			if ($len == 0) {
				print("</br></br><b>No file found!</b>");
			} else {
				print("</br></br><b>Total file found $len for query \"" . $_GET["key"] . "\"");
				print(" Time required $ts seconds</b>");
				for ($i = 0; $i < $len; $i++) {
					$name = explode("\\", $ret[$i][0]);
					$typ = explode(".", $ret[$i][0]);
					print("<div class='card' onclick=\"window.open('" . mysql_escape_string(preg_replace("/(C:[^?]{1,}1-test)/", '\PhpProject1-test', $ret[$i][0])) . "')\" ");
					print("onMouseOver=\"fileOver({'type':'" . $typ[sizeof($typ) - 1] . "','name':'" . $name[sizeof($name) - 1] . "','link':'" . mysql_escape_string($ret[$i][0]) . "','size':'" . $ret[$i][1] . " bytes'})\"");
					print(">");
					print("<div class='card_norm'>");
					print($name[sizeof($name) - 1]);
					print("</div><hr>");
					print("<div class='card_grey'>");
					print($ret[$i][0]);
					print("</div></div></br>");
				}
			}
		}
		?>
	</div>

	<div id="settings" style="position:fixed;right:10px;bottom:10px;">
		<a href="settings.php">Settings</a>
	</div>
	<div class="scard" style="position:fixed;right:10px;bottom:40px;height:80%;width:40%;">
		<h1>File Info.</h1>
		<div id="info" style="text-align:left;"></div>
	</div>



	<?php
	/*
        $a = new PDF2Text();
		$a->setFilename('C:\wamp\www\PhpProject1-test\files\test.pdf');
		$a->decodePDF();
		echo $a->output();
		echo 'ttt';
        */
	?>

</body>

</html>