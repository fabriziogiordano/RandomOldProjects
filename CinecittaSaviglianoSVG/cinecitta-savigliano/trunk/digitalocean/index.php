<?php
$url = $_SERVER['QUERY_STRING'];
$cmd = 'youtube-dl -f 36 --id ' . $url;
echo $cmd;

$output = shell_exec($cmd);
echo "<pre>$output</pre>";