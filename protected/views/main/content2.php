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
$guild_name = "ЕКАТЕРИНБУРГ";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://eu.api.battle.net/wow/character/Голдринн/Алефейя?fields=talents&locale=ru_RU&apikey=f2ppxyc6frxaqhw7eg298hh5gb6za92j");
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
$data = curl_exec($curl);
curl_close($curl);
$data_info = json_decode($data);


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