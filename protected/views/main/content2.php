<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type"/>
</head>
<?php
include_once "Guild.php";
include_once "Spec.php";

//var_dump($user->permissions->name);
//echo $user->permissions->name . " - группа";

//$perms = Permission::model()->find_by_pk(1);
//var_dump($perms->name);

//$args['tyres'] = new CurlFile('kolesamira_ufa.yml');
//
$url = "https://api.content.market.yandex.ru/v1/model/5070894/opinion.json?sort=rank&count=1";
$headers = array(
    "Host: api.content.market.yandex.ru",
    "Accept: */*",
    "Authorization: DKHIvilkQGY9DQ3zMFea9F70ByFFpr"
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $data = curl_exec($ch);
  var_dump($data);
curl_close($ch);
// kolesamira

//$file_path = "kolesamira_ufa.yml";
////$file_path = "temp.xml";
//$xml = simplexml_load_file($file_path);
//
//$offers = $xml->shop->offers;
//$repetitions = array();
//foreach ($offers->offer as $offer) {
//    $repetitions[] = (string)$offer->url;
//}
//
//function repetition($var) {
//    return $var >= 2;
//}
//$repetitions = array_filter(array_count_values($repetitions), "repetition");
//var_dump($repetitions);
////return;
//foreach ($offers->offer as $offer) {
//    $url = (string)$offer->url;
//    if(array_key_exists($url, $repetitions)) {
//        $offer->url = $offer->url . "&" . $repetitions[$url] . "\r\n";
//        $repetitions[$url] -= 1;
//    }
//}

//$xml->asXML("temp.xml");