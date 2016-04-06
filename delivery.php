<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type"/>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
</head>
<body>

</body>
</html>
<?php
    $dsn = "mysql:host=localhost;dbname=delivery";
    $db = new PDO($dsn, "root", "Saithiril");
    $db->exec('SET NAMES utf8');

    $query = "SELECT lt.address, lt.email, lt.schedule, lt.GPS, lc.name as city_name FROM list_cities as lc JOIN list_terminals as lt ON lc.code=lt.code WHERE name='Мариинск';";
    $result = $db->query($query);
    $terminal = $result->fetch(PDO::FETCH_ASSOC);
?>
<?php if($terminal): ?>
<div id="map" style="width: 800px; height: 600px"></div>
<script type="text/javascript">
    ymaps.ready(init);
    var myMap,
        myPlacemark;

    function init(){
        myMap = new ymaps.Map("map", {
            center: [<?php echo $terminal["GPS"]?>],
            zoom: 15
        });

        myPlacemark = new ymaps.Placemark([<?php echo $terminal["GPS"]?>], {
            hintContent: '<?php echo $terminal["city_name"]?>',
            balloonContent: '<?php echo $terminal["address"]?>'
        });

        myMap.geoObjects.add(myPlacemark);
    }
</script>
<?php else: ?>
    <div>Пункты доставки не найдены</div>
<?php endif?>
<?php
return;
    $links = array(
        'status' => 'http://www.rateksib.ru/api/api_csv.php?method=Status&token=h1gd6d70sx',
        'ListCountries' => 'http://www.rateksib.ru/api/api_csv.php?method=ListCountries&token=h1gd6d70sx',
        'ListRegions' => 'http://www.rateksib.ru/api/api_csv.php?method=ListRegions&token=h1gd6d70sx',
        'ListCities' => 'http://www.rateksib.ru/api/api_csv.php?method=ListCities&token=h1gd6d70sx',
        'ListTerminals' => 'http://www.rateksib.ru/api/api_csv.php?method=ListTerminals&token=h1gd6d70sx',
        'Tariffs' => 'http://www.rateksib.ru/api/api_csv.php?method=Tariffs&token=h1gd6d70sx',
        'Tariffbounds' => 'http://www.rateksib.ru/api/api_csv.php?method=Tariffbounds&token=h1gd6d70sx',
    );

$create_list_statuses = "CREATE TABLE IF NOT EXISTS list_statuses(
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  last_date TIMESTAMP ,
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;";

$create_list_countries = "CREATE TABLE IF NOT EXISTS list_countries(
  id INT(11) NOT NULL,
  name VARCHAR(255) NOT NULL,
  ISO3 VARCHAR(3),
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;";

$create_list_regions = "CREATE TABLE IF NOT EXISTS list_regions(
  id INT(11) NOT NULL AUTO_INCREMENT,
  code VARCHAR(7) DEFAULT '',
  out_code VARCHAR(7) DEFAULT '',
  name VARCHAR(255) NOT NULL,
  country_id INT(11),
  CLADR VARCHAR(255),
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;";

$create_list_cities = "CREATE TABLE IF NOT EXISTS list_cities(
  id INT(11) NOT NULL AUTO_INCREMENT,
  code VARCHAR(7) DEFAULT '',
  name VARCHAR(255) NOT NULL,
  district VARCHAR(255) NOT NULL,
  region_code VARCHAR(7),
  country_code VARCHAR(7),
  type VARCHAR(10),
  CLADR VARCHAR(255),
  full_name VARCHAR(255),
  no_payment VARCHAR(255),
  has_terminal INT(2),
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;";

$create_list_terminals = "CREATE TABLE IF NOT EXISTS list_terminals(
  id INT(11) NOT NULL AUTO_INCREMENT,
  office_name VARCHAR(255) NOT NULL,
  code VARCHAR(7),
  type VARCHAR(255),
  office_code VARCHAR(255),
  address VARCHAR(255),
  phone VARCHAR(15),
  schedule VARCHAR(255),
  path VARCHAR(255),
  reception VARCHAR(255),
  delivery VARCHAR(255),
  GPS VARCHAR(255),
  metro VARCHAR(255),
  metro_distance VARCHAR(255),
  link VARCHAR(255),
  email VARCHAR(255),
  status VARCHAR(255),
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;";

$dsn = "mysql:host=localhost;dbname=delivery";
$db = new PDO($dsn, "root", "Saithiril");
$db->exec('SET NAMES utf8');

$db->exec($create_list_statuses);
$db->exec($create_list_countries);
$db->exec($create_list_regions);
$db->exec($create_list_cities);
$db->exec($create_list_terminals);

$statuses = array();
$file = fopen($links['status'], 'r');
while ($a = fgetcsv($file, 0, ";")) {
    $statuses[$a[0]] = $a[1];
//    $db->exec("INSERT INTO list_statuses(name, last_date) VALUES ('{$a[0]}', '{$a[1]}');");
}
//var_dump($statuses);

$query = "SELECT last_date FROM list_statuses WHERE name='ListCountries'";
$result = $db->query($query);
$last_date = $result->fetch(PDO::FETCH_ASSOC)['last_date'];
if(!$last_date == $statuses['ListCountries']) {
    $db->exec("DELETE FROM list_countries;");
    $file = fopen($links['ListCountries'], 'r');
    while ($a = fgetcsv($file, 0, ";")) {
        $country = iconv('cp1251', 'utf8', $a[1]);
        $db->exec("INSERT INTO list_countries VALUES ({$a[0]}, '$country', '{$a[2]}');");
    }
    $db->exec("UPDATE list_statuses SET last_date='$last_date' WHERE name='ListCountries';");
}

$query = "SELECT last_date FROM list_statuses WHERE name='ListRegions'";
$result = $db->query($query);
$last_date = $result->fetch(PDO::FETCH_ASSOC)['last_date'];
if(!$last_date == $statuses['ListRegions']) {
    $db->exec("DELETE FROM list_regions;");
    $file = fopen($links['ListRegions'], 'r');
    while ($a = fgetcsv($file, 0, ";")) {
        $region = iconv('cp1251', 'utf8', $a[1]);
        $db->exec("INSERT INTO list_regions(code, name, country_id, CLADR) VALUES ('{$a[0]}', '$region', {$a[2]}, '{$a[0]}');");
    }
    $db->exec("UPDATE list_statuses SET last_date='$last_date' WHERE name='ListRegions';");
}

$query = "SELECT last_date FROM list_statuses WHERE name='ListCities'";
$result = $db->query($query);
$last_date = $result->fetch(PDO::FETCH_ASSOC)['last_date'];
if(true ||  !$last_date == $statuses['ListCities']) {
    $db->exec("DELETE FROM list_cities;");
    $file = fopen($links['ListCities'], 'r');
    while ($a = fgetcsv($file, 0, ";")) {
        $city = iconv('cp1251', 'utf8', $a[2]);
        $district = iconv('cp1251', 'utf8', $a[3]);
        $type = iconv('cp1251', 'utf8', $a[6]);
        $full_name = iconv('cp1251', 'utf8', $a[9]);

        $db->exec("INSERT INTO list_cities(code, name, district, region_code, country_code, type, CLADR, full_name, no_payment, has_terminal) VALUES (
      '{$a[0]}', '$city', '$district', '{$a[4]}', '$a[5]', '$type', '$a[7]', '$full_name', '{$a[12]}', {$a[13]});"
        );
    }
    $db->exec("UPDATE list_statuses SET last_date='$last_date' WHERE name='ListCities';");
}

$query = "SELECT last_date FROM list_statuses WHERE name='ListTerminals'";
$result = $db->query($query);
$last_date = $result->fetch(PDO::FETCH_ASSOC)['last_date'];
if(!$last_date == $statuses['ListTerminals']) {
    $db->exec("DELETE FROM list_terminals;");

    $file = fopen($links['ListTerminals'], 'r');
    while ($a = fgetcsv($file, 0, ";")) {
        foreach($a as &$item) {
            $item = iconv('cp1251', 'utf8', $item);
        }
        $db->exec("INSERT INTO list_terminals(office_name, code, type, office_code, address, phone, schedule, path, reception, delivery, GPS, metro, metro_distance, link, email, status)
      VALUES (
      '{$a[0]}', '{$a[1]}', '{$a[2]}', '{$a[3]}', '{$a[4]}', '{$a[5]}', '{$a[6]}', '{$a[7]}', '{$a[8]}', '{$a[9]}', '{$a[10]}', '{$a[11]}', '{$a[12]}', '{$a[13]}', '{$a[14]}', '{$a[15]}');"
        );
    }
    $db->exec("UPDATE list_statuses SET last_date='$last_date' WHERE name='ListTerminals';");
}