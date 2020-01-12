<?php


?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Control Panel</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.31" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="script.js"></script>
</head>

<body>

	<table height="100%" width="100%">
		<tr>
			<td width="50%">
				<div class="cmd">

					<button class="card" onclick="run_cmd_u('http://127.0.0.1/PhpProject1-test/function/update_db.php?')">Update Database</button></br></br>
					<button class="card" onclick="run_cmd('http://127.0.0.1/PhpProject1-test/function/clear_db.php?')">Clear DataBase</button></br></br>
					<div class="card">Delete File from Database</br>
						<input type="textarea" id="file">
						<input type="button" value="Delete" onclick="file_key_clr('file')">
					</div></br>
					<div class="card">Delete Keyword from Database</br>
						<input type="textarea" id="key">
						<input type="button" value="Delete" onclick="file_key_clr('key')">
					</div></br>

					<div class="card">Rename File,please give the names.</br>
						<input type="textarea" id="old">-Old
						<input type="textarea" id="new">-New
						<input type="button" value="Rename" onclick="rnmFile()">

					</div>

				</div>
			</td>

			<td width="50%">
				<div class="scard">
					<h1>Notification</h1>
					<div id="notice">Notification of actions will be showen here.</div>
				</div>
			</td>
		</tr>

	</table>

	<div id="run"></div>
</body>

</html>