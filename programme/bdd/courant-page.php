<?php
$load_text = $_GET["txt"];

$handle = fopen(load_text.'.txt', "r");
$info_read = fgets($handle, 4096);
//$info_read = str_replace("</br>","\r\n",$info_read);
 echo $info_read;

fclose($handle);
?>
