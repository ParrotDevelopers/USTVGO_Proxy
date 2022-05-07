<?php
$url = $_GET['url'];
$url = str_replace("-", "&", $url);
$name = explode("/myStream/", $url);
$name = explode("?", $name[1]);
$name = $name[0];
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$url2 = curl_exec($ch);
curl_close($ch);
header('Content-Disposition: attachment; filename="' . $name . '"');
echo $url2;
?>