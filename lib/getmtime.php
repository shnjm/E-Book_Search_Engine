<?php
function getmtime()
{
	list($usec, $sec) = explode(" ", microtime());
	return ((float) $usec + (float) $sec);
}
?>