<?php
$hls000 = $_GET['url'];
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $hls000);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
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
   "referer: https://ustvgo.tv/",
   "accept-language: en-US,en;q=0.9",
);
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
$url3 = curl_exec($ch2);
curl_close($ch2);
$url3 = explode("\n", $url3);
$hls000 = explode("playlist.m3u8", $hls000);
$url4 = "$hls000[0]$url3[3]";
$ch = curl_init($url4);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$url5 = curl_exec($ch);
curl_close($ch);
$url5 = explode("\n", $url5);
for ($i = 0; $i < count($url5); $i++) {
    if (substr($url5[$i], 0, 1) == "l") {
        $url5 = str_replace("&", "-", $url5);
        $url5[$i] = "/ts.php?url=" . $hls000[0] . $url5[$i];
    }
}
$url5 = implode("\n", $url5);
header('Content-Disposition: attachment; filename="playlist.m3u8"');
echo $url5;
?>