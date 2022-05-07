<?php
$c = $_GET['c'];
$url = "https://ustvgo.tv/player.php?stream=$c";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers = array(
   "authority: ustvgo.tv",
   "cache-control: max-age=0",
   "sec-ch-ua-mobile: ?0",
   "upgrade-insecure-requests: 1",
   "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 OPR/82.0.4227.50",
   "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
   "sec-fetch-site: same-origin",
   "sec-fetch-mode: navigate",
   "sec-fetch-user: ?1",
   "sec-fetch-dest: iframe",
   "referer: https://ustvgo.tv/$c/",
   "accept-language: en-US,en;q=0.9",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$html = curl_exec($curl);
curl_close($curl);
$html = str_replace("\n", "", $html);
$html = explode("hls_src='", $html)[1];
$hls = explode("';", $html)[0];
header("Location: /play.php?url=$hls");
?>