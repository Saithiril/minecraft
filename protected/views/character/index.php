<h3><?=$character->name?></h3>
<p>Уровень: <?=$character->level?></p>
<p>Класс: <?=$character->className->name?></p>
<p>Раса: <?=$character->_race ?$character->_race->name : '-'?></p>

<?// print_r($character)?>