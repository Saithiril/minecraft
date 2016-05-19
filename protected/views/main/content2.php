<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type"/>
</head>
<?php
include_once "Permission.php";
include_once "User.php";

$users = User::model()->find_all();
$user = $users[0];
$user->permissions;
var_dump($user->permissions->name);
echo $user->permissions->name . " - группа";

//$perms = Permission::model()->find_by_pk(1);
//var_dump($perms->name);

//$args['tyres'] = new CurlFile('kolesamira_ufa.yml');
//
//$curl = curl_init();
////curl_setopt($curl, CURLOPT_URL, 'http://kolesamira.ru/upload.php');
//curl_setopt($curl, CURLOPT_URL, 'https://market.yandex.ru/shop/39988/reviews');
//curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
////curl_setopt($curl, CURLOPT_POST, true);
////curl_setopt($curl, CURLOPT_POSTFIELDS, $args);
//$out = curl_exec($curl);
//echo $out;
//curl_close($curl);


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