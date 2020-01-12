<?php

class db
{
	var $con;

	function __construct($host, $user, $pass)
	{
		$this->con = mysql_connect($host, $user, $pass);
		if (!$this->con) {
			die("can not establish database connection " . mysql_error());
		}
		//printf("connected ".$this->con);
	}

	function __destruct()
	{
		mysql_close($this->con);
	}

	function insert_file($name, $fsize)
	{
		mysql_select_db("test");
		$sql = "INSERT IGNORE INTO `file`(`file`,`size`) VALUES (\"" . mysql_escape_string($name) . "\"," . $fsize . ")";
		mysql_query($sql, $this->con);
		$sql = "SELECT id,file FROM file WHERE file LIKE \"" . mysql_escape_string(mysql_escape_string($name)) . "\"";
		$ret = mysql_query($sql, $this->con);
		$result = mysql_fetch_array($ret, MYSQL_ASSOC);
		return $result["id"];
	}

	function insert_keyword($word)
	{
		mysql_select_db("test");
		$word = strtolower($word);
		$sql = "INSERT IGNORE INTO `keyword`(`word`) VALUES (\"" . mysql_escape_string($word) . "\")";
		mysql_query($sql, $this->con);
		$sql = "SELECT id,word FROM keyword WHERE word LIKE \"" . mysql_escape_string($word) . "\"";
		$ret = mysql_query($sql, $this->con);
		$result = mysql_fetch_array($ret, MYSQL_ASSOC);
		return $result["id"];
	}

	function insert_word_file_relation($wordid, $fileid)
	{
		mysql_select_db("test");
		$sql = "INSERT IGNORE INTO `link`(`keywordid`, `fileid`) VALUES (" . $wordid . "," . $fileid . ")";
		mysql_query($sql, $this->con);
	}

	function get_file_from_word($word)
	{
		mysql_select_db("test");
		$word = strtolower($word);
		$sql = "SELECT DISTINCT file,size FROM file,keyword,link WHERE file.id=link.fileid AND keyword.id=link.keywordid AND keyword.word LIKE \"%" . mysql_escape_string(mysql_escape_string($word)) . "%\"";
		$ret = mysql_query($sql, $this->con);
		$result = array();
		$id = 0;
		while ($row = mysql_fetch_array($ret, MYSQL_ASSOC)) {
			$result[$id++] = array($row["file"], $row["size"]);
		}
		return $result;
	}

	function delete_file($name)
	{
		mysql_select_db("test");
		$sql = "DELETE FROM link WHERE fileid in (SELECT id FROM file WHERE file=\"" . mysql_escape_string($name) . "\")";
		$a = mysql_query($sql, $this->con);
		$sql = "DELETE FROM file WHERE file=\"" . mysql_escape_string($name) . "\"";
		$b = mysql_query($sql, $this->con);
		return array($a, $b);
	}

	function delete_keyword($word)
	{
		mysql_select_db("test");
		$word = strtolower($word);
		$sql = "DELETE FROM link WHERE keywordid in (SELECT id FROM keyword WHERE word=\"" . mysql_escape_string($word) . "\")";
		$a = mysql_query($sql, $this->con);
		$sql = "DELETE FROM keyword WHERE word=\"" . mysql_escape_string($word) . "\"";
		$b = mysql_query($sql, $this->con);
		return array($a, $b);
	}

	function renameFile($old, $new)
	{
		mysql_select_db("test");
		$sql = "UPDATE file SET file=\"" . mysql_escape_string($new) . "\" WHERE file=\"" . mysql_escape_string($old) . "\"";
		$a = mysql_query($sql, $this->con);
		return $a;
	}

	function run_query($sql)
	{
		mysql_select_db("test");
		$ret = mysql_query($sql, $this->con);
		return $ret;
	}
}

$database = new db("127.0.0.1:3306", "root", "roothellFA");
?>